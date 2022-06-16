<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;


class ArticleController extends Controller
{
    private ArticleService $ArticleService;

    public function __construct(ArticleService $ArticleService)
    {
        $this->ArticleService = $ArticleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::with('user')->get();
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
        $this->ArticleService->create(
            user_id: $request->user()->id,
            title: $request->get('title'),
            body: $request->get('body'),
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
        $article = $this->ArticleService->findById($id);
        if (is_null($article)) {
            abort(404);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
