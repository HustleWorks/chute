<?php

namespace HustleWorks\Chute\DTO;

/**
 * ImageSizeConfiguration
 *
 * Configuration settings for image size
 *
 * @category DTO
 * @package  HustleWorks\Chute\DTO
 * @author   Don Herre <don@hustleworks.com>
 * @license  Proprietary and confidential
 * @link     http://hustleworks.com
 *
 * @property string $name            name of the size
 * @property string $prefix          prefix for filename
 * @property string $suffix          suffix for filename
 * @property int    $quality         quality percentage for image
 * @property int    $width           set width for size
 * @property int    $height          set height for size
 */
class ImageSizeConfiguration extends TransferObject
{
    protected $name, $prefix, $suffix, $quality, $width, $height;
}