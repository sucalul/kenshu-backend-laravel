<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Models\Article;
use App\Services\ArticleService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ArticleServiceTest extends TestCase
{
    use WithFaker;

    private Article $article;
    private ArticleService $articleService;
    private User $user;
    private User $unauthorized_user;

    public function setUp(): void
    {
        parent::setUp();
        $this->articleService = app(ArticleService::class);
        $users = User::factory()->count(2)->create();
        $this->user = $users[0];
        $this->unauthorized_user = $users[1];
    }

    public function test_create_success()
    {
        $title = $this->faker->title();
        $body = $this->faker->text();
        $this->articleService->create(
            user_id: $this->user->id,
            title: $title,
            body: $body,
            resources: [$this->faker->text()],
            thumbnail_resource: $this->faker->randomLetter(),
            tags: [1, 2],
        );
        $this->assertDatabaseHas('articles', [
            'title' => $title,
            'body' => $body,
        ]);
    }
}
