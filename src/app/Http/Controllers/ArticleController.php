<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Services\ArticleService;
use App\Services\TagService;
use App\Services\ThumbnailService;


class ArticleController extends Controller
{
    private ArticleService $articleService;
    private TagService $tagService;
    private ThumbnailService $thumbnailService;


    public function __construct(
        ArticleService   $articleService,
        TagService       $tagService,
        ThumbnailService $thumbnailService,
    )
    {
        $this->articleService = $articleService;
        $this->tagService = $tagService;
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
        $tags = $this->tagService->findAll();
        return view('articles/create', ['tags' => $tags]);
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
        // $this->articleService->create(
        //     user_id: $request->user()->id,
        //     title: $request->get('title'),
        //     body: $request->get('body'),
        //     resources: $resources,
        //     thumbnail_resource: $thumbnail_resource,
        //     tags: $request->get('tags')
        // );
        // return redirect('/articles');
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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id)
    {
        $article = $this->articleService->findById($id);
        if (!$article) {
            throw new NotFoundException();
        }
        if ($request->user()->id !== $article->user->id) {
            throw new ForbiddenException('他のユーザーの投稿は、編集、更新、削除できません');
        }
        $tags = $this->tagService->findAll();
        return view('articles/edit', compact('article', 'tags'));
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
        list($resources, $thumbnail_resource) = $this->thumbnailService->execute($request);
        $this->articleService->update(
            id: $id,
            title: $request->get('title'),
            body: $request->get('body'),
            resources: $resources,
            thumbnail_resource: $thumbnail_resource,
            tags: $request->get('tags'),
            user_id: $request->user()->id
        );
        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws NotFoundException
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        $this->articleService->destroy($id, $request->user()->id);
        return redirect('/articles');
    }
}
