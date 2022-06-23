<?php

namespace Tests\Unit\Services;

use App\Services\ThumbnailService;
use App\Http\Requests\CreateArticleRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Mockery;
use Mockery\MockInterface;
use Illuminate\Support\Facades\Storage;


class ThumbnailServiceTest extends TestCase
{
    use WithFaker;

    private CreateArticleRequest $request;
    private ThumbnailService $thumbnailService;

    public function setUp(): void
    {
        parent::setUp();
        $this->thumbnailService = app(ThumbnailService::class);
        $this->request = new CreateArticleRequest();
    }

    public function testThumbnailSuccess()
    {
        $return_value = [['hoge'], 'fuga'];
        $mock = Mockery::mock(ThumbnailService::class);
        $mock->shouldReceive('execute')->once()->andReturn($return_value);
        $this->assertEquals(
            $return_value,
            $mock->execute($this->request)
        );
    }

    public function testThumbnailExists()
    {
        Storage::fake('design');
        $service = $this->thumbnailService;
        $uploadedFile = UploadedFile::fake()->image('design.jpg');
        $service->execute($uploadedFile);
        Storage::disk('design')->assertExists($uploadedFile->getFilename());
    }
}
