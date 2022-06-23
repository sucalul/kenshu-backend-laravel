<?php

namespace Tests\Unit\Services;

use App\Services\ThumbnailService;
use App\Http\Requests\CreateArticleRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ThumbnailServiceTest extends TestCase
{
    use WithFaker;

    private ThumbnailService $thumbnailService;
    private CreateArticleRequest $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->thumbnailService = app(ThumbnailService::class);
        $this->request = new CreateArticleRequest();
    }

    public function testThumbnail()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->image('/tests/Files/test.jpeg');
        $this->request->merge([
            'id' => NULL,
            'file' => ['upload_image' => $file]
        ]);

        $this->thumbnailService->execute(request: $this->request);
    }
}
