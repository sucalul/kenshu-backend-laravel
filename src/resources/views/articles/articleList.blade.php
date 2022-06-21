<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
@if (Auth::user())
    こんにちは、{{Auth::user()->name}}さん
@endif
@foreach ($articles as $article)
    <h3>{{ $article->id}}</h3>
    <img src="/img/{{ $article->thumbnail_image_name }}" alt="" style="width:200px; height:200px">
    <h3>{{ $article->title }}</h3>
    <p>書いた人: {{ $article->user->name }}</p>
    <button type="button" class="btn btn-info" onclick=location.href="/articles/{{ $article->id }}">More</button>
    <form action="/articles/{{ $article->id }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit">Delete</button>
    </form>
    <p>-------------------------</p>
@endforeach
<button type="button" onclick="location.href='/articles/new'">新規作成</button>
</body>
</html>
