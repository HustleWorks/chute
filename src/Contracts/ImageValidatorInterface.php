<?php


namespace HustleWorks\Chute\Contracts;

use HustleWorks\Chute\DTO\ImageRuleConfiguration;
use HustleWorks\Chute\ImageFile;
use HustleWorks\Chute\ServiceResponse;

interface ImageValidatorInterface
{
    public function validate(ImageFile $file, ImageRuleConfiguration $rules) : ServiceResponse;
}