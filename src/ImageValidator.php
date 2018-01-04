<?php

namespace HustleWorks\Chute;

use HustleWorks\Chute\DTO\ImageRuleConfiguration;
use HustleWorks\Chute\Contracts\ImageValidatorInterface;
use HustleWorks\Chute\ImageFile;
use HustleWorks\Chute\ServiceResponse;
use HustleWorks\Chute\StandardServiceResponse;

class ImageValidator implements ImageValidatorInterface
{
    private $reasons_to_fail = [];

    /**
     * @param \HustleWorks\Chute\ImageFile $file
     * @param ImageRuleConfiguration       $rules
     * @return \HustleWorks\Chute\ServiceResponse
     */
    public function validate(ImageFile $file, ImageRuleConfiguration $rules): ServiceResponse
    {
        $this->_checkWidth($file, $rules);
        $this->_checkHeight($file, $rules);
        $this->_checkType($file, $rules);

        return new StandardServiceResponse(
            !sizeof($this->reasons_to_fail),
            [],
            sizeof($this->reasons_to_fail) ? "Message was invalid for the following reasons: " . implode(', ', $this->reasons_to_fail) : "Valid image."
        );
    }

    private function _checkWidth(ImageFile $file, ImageRuleConfiguration $rules)
    {
        if ($file->width() < $rules->min_width) {
            $this->reasons_to_fail[] = 'image too narrow';
        } elseif ($file->width() > ($rules->max_width ?? PHP_INT_MAX)) {
            $this->reasons_to_fail[] = 'image too wide';
        }
    }

    private function _checkHeight(ImageFile $file, ImageRuleConfiguration $rules)
    {
        if ($file->height() < $rules->min_height) {
            $this->reasons_to_fail[] = 'image too short';
        } elseif ($file->height() > ($rules->max_height ?? PHP_INT_MAX)) {
            $this->reasons_to_fail[] = 'image too tall';
        }
    }

    private function _checkType(ImageFile $file, ImageRuleConfiguration $rules)
    {
        if ($rules->mime_types and !in_array($file->mimeType(), $rules->mime_types)) {
            $this->reasons_to_fail[] = 'file type not allowed';
        }
    }

}