<?php

namespace HustleWorks\Chute;

abstract class ImageFile
{
    protected $stream, $filename, $extension, $mime_type, $size, $width, $height;

    /**
     * ImageFile constructor.
     *
     * This constructor takes one argument. The file object from your framework. The type is not restricted so you can
     * make it specific to your implementation. For example the version shipped with this package is for Laravel, which
     * has it's own instance of UploadFile. The goal is to take the file and use whatever dependencies you like to
     * compile the data about the image file.
     *
     * @param $framework_file
     */
    public final function __construct($framework_file)
    {
        $this->processImageData($framework_file);
        $this->_validateImplementation();
    }

    /**
     * Process Image Data
     *
     * @param $framework_File
     * @return void
     */
    abstract protected function processImageData($framework_File);

    /**
     * Validate Implementation
     *
     * Makes sure all values are set
     */
    private function _validateImplementation()
    {
        $this->height();
        $this->width();
        $this->filename();
        $this->extension();
        $this->size();
        $this->mimeType();
        $this->stream();
    }

    /**
     * File payload as a string
     *
     * @return string
     */
    public function stream(): string
    {
        return $this->stream;
    }

    /**
     * Filename
     *
     * @return mixed
     */
    public function filename()
    {
        return $this->filename;
    }

    /**
     * Image file extension
     *
     * @return string
     */
    public function extension(): string
    {
        return $this->extension;
    }

    /**
     * Mime Type
     *
     * @return string
     */
    public function mimeType(): string
    {
        return $this->mime_type;
    }

    /**
     * Size in kilobytes
     *
     * @return int
     */
    public function size(): int
    {
        return $this->size;
    }

    /**
     * Width in pixels
     *
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Height in pixels
     *
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }
}