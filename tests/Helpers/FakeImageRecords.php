<?php

namespace Tests\Helpers;

use HustleWorks\Chute\DTO\ImageRecord;

trait FakeImageRecords
{
    /**
     * Returns a fake Image Record
     *
     * @return ImageRecord
     */
    protected function fakeImageRecord()
    {
        return new ImageRecord([
            'id'          => 0,
            'name'        => 'test',
            'disk'        => 'temp',
            'filename'    => 'test.jpg',
            'path'        => 'fake/directory/',
            'status'      => 'pending',
            'size'        => '500',
            'width'       => '800',
            'height'      => '600',
            'mime_type'   => 'image/jpeg',
            'extension'   => 'jpg',
            'uuid'        => 'some-uuid',
            'alt'         => 'test alt',
            'title'       => 'test title',
            'description' => 'test description',
            'updated_at'  => '2018-01-01 00:00:00',
            'created_at'  => '2018-01-01 00:00:00',
        ]);
    }
}