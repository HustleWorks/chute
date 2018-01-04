<?php


namespace HustleWorks\Chute;

use HustleWorks\Chute\Contracts\ImageEditingInterface;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;

class ImageEditor implements ImageEditingInterface
{
    /**
     * @var \Intervention\Image\Image
     */
    private $image;

    /**
     * @var int
     */
    private $quality;

    /**
     * ImageEditor constructor.
     *
     * @param $file
     */
    public function __construct($file)
    {
        $this->image = (new ImageManager())->make($file);
    }

    /**
     * Crop Image
     *
     * @param      $width
     * @param      $height
     * @param null $x_pos
     * @param null $y_pos
     * @return ImageEditingInterface
     */
    public function crop($width, $height, $x_pos = null, $y_pos = null): ImageEditingInterface
    {
        $this->image->crop($width, $height, $x_pos, $y_pos);

        return $this;
    }

    /**
     * @param $width
     * @param $height
     * @return ImageEditingInterface
     */
    public function resize($width, $height): ImageEditingInterface
    {
        $this->image->resize(
            $width,
            $height,
            !($width and $height) ? function (Constraint $constraint) { $constraint->aspectRatio(); } : null
        );

        return $this;
    }

    /**
     * Set Quality
     *
     * @param $quality
     * @return ImageEditingInterface
     */
    public function setQuality($quality): ImageEditingInterface
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get Stream
     *
     * Finalize edits and get the finished product.
     *
     * @return string
     */
    public function getStream(): string
    {
        return $this->image->stream(null, $this->quality);
    }
}