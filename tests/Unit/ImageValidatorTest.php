<?php


namespace Tests\Unit;


use HustleWorks\Chute\ImageValidator;
use Tests\Helpers\FakeImageConfigurations;
use Tests\Helpers\FakeImageFiles;
use Tests\TestCase;

class ImageValidatorTest extends TestCase
{
    use FakeImageFiles, FakeImageConfigurations;

    /** @test */
    public function can_validate_a_valid_file()
    {
        $validator = new ImageValidator;

        $response = $validator->validate($this->fakeImageFile(), $this->fakeImageRuleConfig());

        $this->assertTrue($response->success());
    }

    /** @test */
    public function can_invalidate_invalid_file()
    {
        $validator = new ImageValidator;

        $response = $validator->validate(
            $this->fakeImageFile(['width' => 50, 'height' => 40]),
            $this->fakeImageRuleConfig([
                'min_width'  => 60,
                'min_height' => 45,
            ])
        );

        $this->assertFalse($response->success());
    }
}