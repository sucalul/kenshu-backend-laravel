<?php

namespace Tests\Unit\Services;

use App\Services\ThumbnailService;
use App\Http\Requests\CreateArticleRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;

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
}
