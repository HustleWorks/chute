<?php


namespace HustleWorks\Chute\Contracts;


interface ImageEditingInterface
{
    public function crop($width, $height, $x_pos = null, $y_pos = null): self;

    public function resize($width, $height): self;

    public function setQuality($quality): self;

    public function getStream(): string;
}