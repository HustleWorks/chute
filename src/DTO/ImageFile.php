<?php

namespace HustleWorks\Chute\DTO;

/**
 * ImageFile
 *
 * This transfer object give details for an Image File
 *
 * @category TransferObject
 * @package  HustleWorks\Chute\DTO
 * @author   Don Herre <don@hustleworks.com>
 * @license  Proprietary and confidential
 * @link     http://hustleworks.com
 *
 * @property string $stream;
 * @property string $filename
 * @property int    $size
 * @property int    $width
 * @property int    $height
 * @property string $mime_type
 * @property string $extension
 */
class ImageFile extends TransferObject
{
    protected $stream, $filename, $extension, $mime_type, $size, $width, $height;
}