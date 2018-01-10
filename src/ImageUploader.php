<?php

namespace HustleWorks\Chute;

use HustleWorks\Chute\DTO\ImageConfiguration;
use HustleWorks\Chute\Contracts\ImageValidatorInterface;
use HustleWorks\Chute\Contracts\ImageRepositoryInterface;
use HustleWorks\Chute\Contracts\StorageInterface;
use HustleWorks\Chute\DTO\ImageFile;
use HustleWorks\Chute\ServiceResponse;
use HustleWorks\Chute\StandardServiceResponse;

abstract class ImageUploader
{
    /**
     * @var ImageValidatorInterface
     */
    protected $validator;

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var ImageRepositoryInterface
     */
    protected $image_repo;

    /**
     * ImageUploader constructor.
     *
     * @param ImageValidatorInterface  $validator
     * @param StorageInterface         $storage
     * @param ImageRepositoryInterface $image_repo
     */
    public function __construct(
        ImageValidatorInterface $validator,
        StorageInterface $storage,
        ImageRepositoryInterface $image_repo
    )
    {
        $this->validator  = $validator;
        $this->storage    = $storage;
        $this->image_repo = $image_repo;
    }

    /**
     * Handle Image Upload
     *
     * @param mixed              $framework_file
     * @param ImageConfiguration $config
     * @param array              $optional_data
     * @return ServiceResponse
     */
    public function handle($framework_file, ImageConfiguration $config, array $optional_data = [])
    {
        /* Create ImageFile object for processing */
        $image_file = $this->prepareImageFile($framework_file);

        /* run validation on upload */
        $response = $this->validator->validate($image_file, $config->rules);

        /* if valid create database entry, store image to disk and generate response */
        if ($response->success()) {

            if ($record = $this->image_repo->findExistingImageable($config->optional_data)) {
                $this->image_repo->delete($record);
            }

            $record = $model->storeImageRecord([
                'name'        => $name,
                'disk'        => $config->temp_disk,
                'filename'    => $image_file->filename,
                'path'        => $config->directory,
                'status'      => 'pending',
                'width'       => $image_file->width,
                'height'      => $image_file->height,
                'mime_type'   => $image_file->mime_type,
                'extension'   => $image_file->extension,
                'size'        => $image_file->size,
                'alt'         => $optional_data['alt'] ?? null,
                'title'       => $optional_data['title'] ?? null,
                'description' => $optional_data['description'] ?? null,
            ]);

            $this->storage->put($image_file->stream, $record->disk, "$record->path/$record->uuid", $record->filename);
            $response = new StandardServiceResponse(true, [
                'image' => $record,
            ], 'File successfully uploaded');
        }

        return $response;
    }


    /**
     * Prepare Image File
     *
     * Take raw upload and convert it to an image file
     *
     * @param $framework_file
     * @return ImageFile
     */
    abstract protected function prepareImageFile($framework_file): ImageFile;
}