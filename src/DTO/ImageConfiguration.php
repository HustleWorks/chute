<?php


namespace HustleWorks\Chute\DTO;

/**
 * ImageConfiguration
 *
 * Configuration settings for image upload
 *
 * @category DTO
 * @package  HustleWorks\Chute\DTO
 * @author   Don Herre <don@hustleworks.com>
 * @license  Proprietary and confidential
 * @link     http://hustleworks.com
 *
 * @property ImageSizeConfiguration[] $sizes          parameters for each size needed for image upload
 * @property ImageRuleConfiguration   $rules          rules for upload validation
 * @property string                   $image_name     name of the image
 * @property string                   $directory      full directory name for image storage
 * @property string                   $temp_disk      name of the disk to store file while in temp state
 * @property string                   $primary_disk   name of the dist to store file once in permanent state
 * @property array                    $optional_data  extra parameters for saving to database, to satisfy framework/ORM requirements
 */
class ImageConfiguration extends TransferObject
{
    protected $sizes, $optional_data = [];

    protected $image_name, $rules, $directory, $temp_disk, $primary_disk;
}