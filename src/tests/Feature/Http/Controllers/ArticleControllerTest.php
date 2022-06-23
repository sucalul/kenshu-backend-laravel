<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ArticleControllerTest extends TestCase
{
    use WithFaker;

    private Article $article;
    private User $user;
    private User $unauthorized_user;
    private string $uri;
    private string $notExistsUri;
    private string $redirectUri;

    public function setUp(): void
    {
        parent::setUp();
        $users = User::factory()->count(2)->create();
        $this->user = $users[0];
        $this->unauthorized_user = $users[1];
        $this->article = Article::create([
            'user_id' => $this->user->id,
            'title' => $this->faker->title(),
            'body' => $this->faker->text(),
            'thumbnail_image_id' => 1,
        ]);
        $this->uri = route('articles.destroy', ['id' => $this->article->id]);
        $this->notExistsUri = route('articles.destroy', ['id' => $this->faker->randomNumber(4)]);
        $this->redirectUri = '/articles';
    }

    public function test_destroyArticleSuccess(): void
    {
        $response = $this->actingAs($this->user)
            ->delete($this->uri);
        $response->assertRedirect($this->redirectUri);
    }

    public function test_destroyArticleNotFound(): void
    {
        $response = $this->actingAs($this->user)
            ->delete($this->notExistsUri);
        $response->assertStatus(404);
    }

    public function test_destroyArticleByUnauthorizedUser(): void
    {
        $response = $this->actingAs($this->unauthorized_user)
            ->delete($this->uri);
        $response->assertSessionHas('message', '他のユーザーの投稿は、編集、更新、削除できません');
        $response->assertRedirect($this->redirectUri);
    }

    public function test_destroyArticleByGuestUser(): void
    {
        $response = $this->delete($this->uri);
        $response->assertSessionHas('message', 'ログインが必要です');
        $response->assertRedirect($this->redirectUri);
    }
}
