<?php


namespace Tests\Unit;


use HustleWorks\Chute\Contracts\ImageRepositoryInterface;
use HustleWorks\Chute\Contracts\ImageValidatorInterface;
use HustleWorks\Chute\Contracts\StorageInterface;
use HustleWorks\Chute\ImageUploader;
use HustleWorks\Chute\ImageValidator;
use HustleWorks\Chute\ServiceResponse;
use Tests\Helpers\FakeImageConfigurations;
use Tests\Helpers\FakeImageFiles;
use Tests\Helpers\FakeImageRecords;
use Tests\TestCase;

class ImageUploaderTest extends TestCase
{
    use FakeImageConfigurations, FakeImageRecords, FakeImageFiles;

    /** @test */
    public function can_handle_upload()
    {
        /* mock dependencies needed for class */
        $validator  = new ImageValidator;
        $storage    = $this->getMockBuilder(StorageInterface::class)->getMockForAbstractClass();
        $image_repo = $this->getMockBuilder(ImageRepositoryInterface::class)->getMockForAbstractClass();

        /* mock abstract class */
        $uploader = $this->getMockBuilder(ImageUploader::class)->setConstructorArgs([
            $validator,
            $storage,
            $image_repo,
        ])->getMockForAbstractClass();

        /* add contract method */
        $uploader->method('prepareImageFile')->willReturn($this->fakeImageFile());

        /** mock @var ImageUploader $uploader class */
        $response = $uploader->handle('file', $this->fakeImageConfig());

        /* assert response is correct */
        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertNotNull($response->data()['image']);
        $this->assertTrue($response->success());
    }
}