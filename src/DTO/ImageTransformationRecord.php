<?php

namespace HustleWorks\Chute\DTO;

/**
 * ImageTransformationRecord
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
 * @property int    $quality
 * @property string $updated_at
 * @property string $created_at
 * @property int    $id
 * @property int    $image_id
 */
class ImageTransformationRecord extends TransferObject
{
    protected $id;
    protected $image_id;
    protected $name;
    protected $disk;
    protected $filename;
    protected $size;
    protected $width;
    protected $quality;
    protected $height;
    protected $updated_at;
    protected $created_at;
}