<?php


namespace HustleWorks\Chute\DTO;

/**
 * ImageRuleConfiguration
 *
 * Configuration settings for image upload rules
 *
 * @category DTO
 * @package  HustleWorks\Chute\DTO
 * @author   Don Herre <don@hustleworks.com>
 * @license  Proprietary and confidential
 * @link     http://hustleworks.com
 *
 * @property array $mime_types    parameters for each size needed for image upload
 * @property int   $min_width     minimum width for original uploaded file
 * @property int   $min_height    minimum height for original uploaded file
 * @property int   $max_width     maximum width for original uploaded file
 * @property int   $max_height    maximum height for original uploaded file
 */
class ImageRuleConfiguration extends TransferObject
{
    protected $mime_types = [];
    protected $min_width, $min_height, $max_width, $max_height;
}