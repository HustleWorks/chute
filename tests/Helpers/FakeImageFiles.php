<?php

namespace Tests\Helpers;


use HustleWorks\Chute\DTO\ImageFile;

trait FakeImageFiles
{
    /**
     * Fake an ImageFile DTO
     *
     * @param array $data
     * @return ImageFile
     */
    protected function fakeImageFile($data = [])
    {
        return new ImageFile([
            'stream'    => $data['stream'] ?? file_get_contents(__DIR__ . '/../Assets/test_400w_400h.jpg'),
            'filename'  => $data['filename'] ?? 'test.jpg',
            'extension' => $data['extension'] ?? 'jpg',
            'mime_type' => $data['mime_type'] ?? 'image/jpeg',
            'size'      => $data['size'] ?? 500,
            'width'     => $data['width'] ?? 800,
            'height'    => $data['height'] ?? 600,
        ]);
    }
}