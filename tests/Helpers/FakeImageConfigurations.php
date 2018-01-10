<?php

namespace Tests\Helpers;

use HustleWorks\Chute\DTO\ImageConfiguration;
use HustleWorks\Chute\DTO\ImageRuleConfiguration;
use HustleWorks\Chute\DTO\ImageSizeConfiguration;

trait FakeImageConfigurations
{
    protected function fakeImageConfig()
    {
        return new ImageConfiguration([
            'sizes'        => [
                new ImageSizeConfiguration([
                    'name'   => 'test',
                    'prefix' => '[t]',
                    'width'  => 20,
                    'height' => null,
                ]),
            ],
            'rules'        => $this->fakeImageRuleConfig(),
            'image_name'   => 'fake',
            'directory'    => 'fake/directory/',
            'temp_disk'    => 'temp',
            'primary_disk' => 'primary',
        ]);
    }

    /**
     * Fake ImageRuleConfiguration DTO
     *
     * @param array $rules
     * @return ImageRuleConfiguration
     */
    protected function fakeImageRuleConfig($rules = [])
    {
        return new ImageRuleConfiguration([
            'mime_types' => ['image/jpeg'],
            'min_width'  => $rules['min_width'] ?? null,
            'max_width'  => $rules['max_width'] ?? null,
            'min_height' => $rules['min_height'] ?? null,
            'max_height' => $rules['max_height'] ?? null,
        ]);
    }
}