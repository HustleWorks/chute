<?php


namespace Tests\Unit;


use HustleWorks\Chute\ImageEditor;
use Intervention\Image\ImageManager;
use Tests\TestCase;

class ImageEditorTest extends TestCase
{
    /** @test */
    public function can_crop_image()
    {
        $input_stream = file_get_contents(__DIR__ . '/../Assets/test_400w_400h.jpg');
        $editor = new ImageEditor($input_stream);

        $output_stream = $editor->crop(40, 40)->getStream();

        $image = (new ImageManager())->make($output_stream);

        $this->assertEquals(40, $image->width());
        $this->assertEquals(40, $image->height());
    }

    /** @test */
    public function can_resize_image()
    {
        $input_stream = file_get_contents(__DIR__ . '/../Assets/test_400w_400h.jpg');
        $editor = new ImageEditor($input_stream);

        $output_stream = $editor->resize(300, 100)->getStream();

        $image = (new ImageManager())->make($output_stream);

        $this->assertEquals(300, $image->width());
        $this->assertEquals(100, $image->height());
    }
}