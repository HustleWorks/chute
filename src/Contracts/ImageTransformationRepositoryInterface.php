<?php

namespace HustleWorks\Chute\Contracts;

use HustleWorks\Chute\DTO\ImageRecord;
use HustleWorks\Chute\DTO\ImageTransformationRecord;

interface ImageTransformationRepositoryInterface
{
    /**
     * Create
     *
     * @param array       $attributes
     * @param ImageRecord $image_record
     * @return ImageTransformationRecord
     */
    public function create(array $attributes, ImageRecord $image_record): ImageTransformationRecord;

    /**
     * Find By Id
     *
     * @param $id
     * @return ImageTransformationRecord
     */
    public function findById($id): ImageTransformationRecord;
}