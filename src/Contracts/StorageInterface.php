<?php


namespace HustleWorks\Chute\Contracts;


interface StorageInterface
{
    /**
     * Put
     *
     * @param string      $file
     * @param string      $disk
     * @param string      $path
     * @param string|null $filename
     * @return int|false size on disk or false
     */
    public function put($file, $disk, $path, $filename = null);

    /**
     * Get
     *
     * @param string $disk
     * @param string $path
     * @return false|string
     */
    public function get($disk, $path);


    /**
     * Move
     *
     * @param string      $source_path
     * @param string      $destination_path
     * @param string|null $source_disk
     * @param string|null $destination_disk
     * @return mixed
     */
    public function move($source_path, $destination_path, $source_disk = null, $destination_disk = null);

    public function delete($disk, $path);

    /**
     * Size On Disk
     *
     * @param $disk
     * @param $path
     * @return bool|int
     */
    public function sizeOnDisk($disk, $path);
}