<?php


namespace HustleWorks\Chute;

use HustleWorks\Chute\DTO\ImageConfiguration;
use HustleWorks\Chute\DTO\ImageRecord;
use HustleWorks\Chute\Contracts\ImageRepositoryInterface;
use HustleWorks\Chute\Contracts\ImageTransformationRepositoryInterface;
use HustleWorks\Chute\Contracts\StorageInterface;
use HustleWorks\Chute\ImageEditor;

abstract class ImageProcessor
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var ImageRepositoryInterface
     */
    private $image_repo;

    /**
     * @var ImageTransformationRepositoryInterface
     */
    private $image_transformation_repo;

    /**
     * ImageProcessor constructor.
     *
     * @param StorageInterface $storage
     * @param                  $image_repo
     * @param                  $image_transformation_repo
     */
    public function __construct(
        StorageInterface $storage,
        ImageRepositoryInterface $image_repo,
        ImageTransformationRepositoryInterface $image_transformation_repo
    )
    {
        $this->storage                   = $storage;
        $this->image_repo                = $image_repo;
        $this->image_transformation_repo = $image_transformation_repo;
    }

    /**
     * Handle Processing
     *
     * @param ImageRecord        $record
     * @param ImageConfiguration $config
     * @return StandardServiceResponse
     */
    public function handle(ImageRecord $record, ImageConfiguration $config)
    {
        /* build path */
        $path_to_record = "$record->path/$record->uuid/$record->filename";

        /* get file from storage */
        $image = $this->storage->get($record->disk, $path_to_record);

        /* move file to primary storage if not already there */
        if ($record->disk !== $config->primary_disk) {
            $this->storage->move($path_to_record, $path_to_record, $record->disk, $config->primary_disk);
            $this->image_repo->update($record, ['disk' => $config->primary_disk]);
        }

        /* create transformation for each size */
        $transformation_records = $this->_createTransformations($image, $config, $record);

        $this->image_repo->update($record, ['status' => 'complete']);

        return new StandardServiceResponse(
            true,
            ['image' => $record, 'image_transformations' => $transformation_records],
            'Image processing completed successfully'
        );
    }

    /**
     * Create Transformations
     *
     * @param                    $image
     * @param ImageConfiguration $config
     * @param ImageRecord        $image_record
     * @return array
     */
    private function _createTransformations($image, ImageConfiguration $config, ImageRecord $image_record)
    {
        foreach ($config->sizes as $size) {
            /* create filename */
            $fn = $size->prefix .
                str_replace(".$image_record->extension", '', $image_record->filename) .
                "$size->suffix.$image_record->extension";

            /* initialize fluent image editor */
            $editor = new ImageEditor($image);

            /* create transformation */
            $transformed_image = $editor->resize($size->width, $size->height)->setQuality($size->quality)->getStream();

            /* store on disk */
            $size_on_disk = $this->storage->put($transformed_image, $config->primary_disk, "$image_record->path/$image_record->uuid", $fn);

            /* create record */
            $transformation_records[] = $this->image_transformation_repo->create([
                'name'     => $size->name,
                'filename' => $fn,
                'disk'     => $config->primary_disk,
                'width'    => $size->width ?? round($size->height / $image_record->height * $image_record->width),
                'height'   => $size->height ?? round($size->width / $image_record->width * $image_record->height),
                'quality'  => $size->quality,
                'size'     => $size_on_disk,
            ], $image_record);
        }

        return $transformation_records ?? [];
    }
}