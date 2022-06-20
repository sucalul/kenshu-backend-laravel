<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Exceptions\NotFoundException;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Services\ArticleService;
use App\Services\ThumbnailService;


class ArticleController extends Controller
{
    private ArticleService $articleService;
    private ThumbnailService $thumbnailService;

    public function __construct(ArticleService $articleService, ThumbnailService $thumbnailService)
    {
        $this->articleService = $articleService;
        $this->thumbnailService = $thumbnailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = $this->articleService->findAll();
        return view('articles/articleList', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function new()
    {
        return view('articles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function create(CreateArticleRequest $request)
    {
        list($resources, $thumbnail_resource) = $this->thumbnailService->execute($request);
        $this->articleService->create(
            user_id: $request->user()->id,
            title: $request->get('title'),
            body: $request->get('body'),
            resources: $resources,
            thumbnail_resource: $thumbnail_resource
        );
        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleService->findById($id);
        return view('articles/show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleService->findById($id);
        if (is_null($article)) {
            abort(404);
        }
        return view('articles/edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateArticleRequest $request, int $id)
    {
        // TODO: 記事作成したuserじゃない人を弾く(別PRで対応)
        $this->articleService->update(
            id: $id,
            title: $request->get('title'),
            body: $request->get('body')
        );
        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws NotFoundException
     */
    public function destroy(int $id): RedirectResponse
    {
        // TODO: 記事作成したuserじゃない人を弾く(別PRで対応)
        $this->articleService->destroy($id);
        return redirect('/articles');
    }
}
