<?php

namespace HustleWorks\Chute\DTO;

/**
 * ImageRecord
 *
 * This transfer object give details fo an Image Original
 *
 * @category TransferObject
 * @package  HustleWorks\Chute\DTO
 * @author   Don Herre <don@hustleworks.com>
 * @license  Proprietary and confidential
 * @link     http://hustleworks.com
 *
 * @property string $name;
 * @property string $disk;
 * @property string $filename
 * @property string $path
 * @property string $status
 * @property int    $size
 * @property int    $width
 * @property int    $height
 * @property string $mime_type
 * @property string $extension
 * @property string $uuid
 * @property string $alt
 * @property string $title
 * @property string $description
 * @property string $updated_at
 * @property string $created_at
 * @property string $id
 */
class ImageRecord extends TransferObject
{
    protected $id;
    protected $name;
    protected $disk;
    protected $filename;
    protected $path;
    protected $status;
    protected $size;
    protected $width;
    protected $height;
    protected $mime_type;
    protected $extension;
    protected $uuid;
    protected $alt;
    protected $title;
    protected $description;
    protected $updated_at;
    protected $created_at;

    /**
     * ImageRecord constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();

        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }
}