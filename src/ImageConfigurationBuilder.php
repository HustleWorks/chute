<?php


namespace HustleWorks\Chute;

use HustleWorks\Chute\DTO\ImageConfiguration;
use HustleWorks\Chute\DTO\ImageRuleConfiguration;
use HustleWorks\Chute\DTO\ImageSizeConfiguration;

class ImageConfigurationBuilder
{
    /**
     * @param string $image_name
     * @param string $rules
     * @param array  $sizes
     * @param array  $optional_data
     * @return ImageConfiguration
     */
    public function getConfig($image_name, $rules, $sizes, $optional_data = []): ImageConfiguration
    {
        $config = new ImageConfiguration;

        $config->image_name    = $image_name;
        $config->sizes         = $this->getSizesConfig($sizes);
        $config->rules         = $this->getRulesConfig($rules);
        $config->directory     = $optional_data['directory'] ?? 'images';
        $config->temp_disk     = config('chute.storage.temp_disk');
        $config->primary_disk  = config('chute.storage.primary_disk');
        $config->optional_data = $optional_data;

        return $config;
    }

    /**
     * @param array $sizes
     * @return ImageSizeConfiguration[]
     */
    public function getSizesConfig($sizes)
    {
        foreach ($sizes ?? config('chute.defaults.sizes') as $size_name) {
            $config          = new ImageSizeConfiguration;
            $config->name    = $size_name;
            $config->quality = config("chute.sizes.$size_name.quality");
            $config->height  = config("chute.sizes.$size_name.height");
            $config->width   = config("chute.sizes.$size_name.width");
            $config->prefix  = config("chute.sizes.$size_name.prefix");
            $config->suffix  = config("chute.sizes.$size_name.suffix");
            $configs[]       = $config;
        }

        return $configs ?? [];
    }

    /**
     * @param string $rules_name
     * @return ImageRuleConfiguration
     */
    public function getRulesConfig($rules_name)
    {
        $config             = new ImageRuleConfiguration;
        $config->mime_types = config("chute.rules.$rules_name.mime_types");
        $config->min_width  = config("chute.rules.$rules_name.min_width");
        $config->min_height = config("chute.rules.$rules_name.min_height");
        $config->max_width  = config("chute.rules.$rules_name.max_width");
        $config->max_height = config("chute.rules.$rules_name.max_height");

        return $config;
    }
}