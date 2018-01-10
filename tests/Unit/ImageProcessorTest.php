<?php

namespace Tests\Unit;

use HustleWorks\Chute\Contracts\ImageRepositoryInterface;
use HustleWorks\Chute\Contracts\ImageTransformationRepositoryInterface;
use HustleWorks\Chute\Contracts\StorageInterface;
use HustleWorks\Chute\ImageProcessor;
use HustleWorks\Chute\ServiceResponse;
use Tests\Helpers\FakeImageConfigurations;
use Tests\Helpers\FakeImageRecords;
use Tests\TestCase;

class ImageProcessorTest extends TestCase
{
    use FakeImageRecords, FakeImageConfigurations;

    /** @test */
    public function can_handle_process()
    {
        /* mock dependencies needed for class */
        $storage             = $this->getMockBuilder(StorageInterface::class)->getMockForAbstractClass();
        $image_repo          = $this->getMockBuilder(ImageRepositoryInterface::class)->getMockForAbstractClass();
        $transformation_repo = $this->getMockBuilder(ImageTransformationRepositoryInterface::class)
            ->getMockForAbstractClass();

        /* mock get method */
        $storage->method('get')->willReturn(file_get_contents(__DIR__ . '/../Assets/test_400w_400h.jpg'));

        /** mock @var ImageProcessor $processor class */
        $processor = $this->getMockBuilder(ImageProcessor::class)->setConstructorArgs([
            $storage,
            $image_repo,
            $transformation_repo,
        ])->getMockForAbstractClass();

        /* call method under test */
        $response = $processor->handle($this->fakeImageRecord(), $this->fakeImageConfig());

        /* assert response is correct */
        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertNotNull($response->data()['image']);
        $this->assertNotNull($response->data()['image_transformations']);
        $this->assertTrue($response->success());
    }

}