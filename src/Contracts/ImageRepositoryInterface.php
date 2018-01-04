<?php


namespace HustleWorks\Chute\Contracts;

use HustleWorks\Chute\DTO\ImageRecord;

interface ImageRepositoryInterface
{
    /**
     * Create
     *
     * @param array $attributes
     * @return ImageRecord
     */
    public function create(array $attributes): ImageRecord;

    /**
     * Find By Id
     *
     * @param $id
     * @return ImageRecord
     */
    public function findById($id): ImageRecord;

    /**
     * Find Existing Relation
     *
     * Search for existing image, by the existing polymorphic identifiers
     *
     * @param array $identifiers for polymorphic relationship
     * @return ImageRecord|null
     */
    public function findExistingImageable(array $identifiers);

    /**
     * Update
     *
     * @param int|ImageRecord $model
     * @param array           $attributes
     * @return mixed
     */
    public function update($model, array $attributes);

    /**
     * Delete
     *
     * @param int|ImageRecord $model
     * @return bool
     */
    public function delete($model);
}