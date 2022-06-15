<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ArticleCreateRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Services\ArticleService;


class ArticleController extends Controller
{
    private ArticleService $ArticleService;

    public function __construct(ArticleService $ArticleService) {
        $this->ArticleService = $ArticleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->get();
        return view('articles/articleList', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('articles/create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
//        $resources = array();
//        $thumbnail_resource = '';
//        for ($i = 0; $i < count($request->get('resources')); $i++) {
//            $resource = uniqid();
//            $resources[] = $resource;
//
//            if ($request->has('is-thumbnail') && $request->get('is-thumbnail') == $request->file('resources')[$i]) {
//                $thumbnail_resource = $resource;
//                $index = array_search($thumbnail_resource, $resources);
//                array_splice($resources, $index, 1);
//            }
//            // upload先指定
//            $uploaded_path = 'img/' . $resource . '.png';
//            // fileの移動
//            move_uploaded_file($request->file('resources')[$i], $uploaded_path);
//        }
//        if (empty($thumbnail_resource)) {
//            $thumbnail_resource = current($resources);
//            $index = array_search($thumbnail_resource, $resources);
//            array_splice($resources, $index, 1);
//        }

        $this->ArticleService->create(
            user_id: $request->user()->id,
            title: $request->get('title'),
            body: $request->get('body'),
//            resources: $resources,
//            thumbnail_resource: $thumbnail_resource,
//            tags: $request->get('tags')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('articles/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
