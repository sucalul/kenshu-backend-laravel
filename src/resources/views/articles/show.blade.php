<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
<h3>{{ $article->id }}</h3>
<img src="/img/{{ $article->thumbnail_image_id }}" alt="" style="width:200px; height:200px">
<?php foreach($article->article_image as $image) : ?>
    <img src="/img/{{ $image->resource_id }}" alt="" style="width:200px; height:200px">
<?php endforeach;?>
<p>書いた人: {{ $article->user->name }}</p>
<h3>{{ $article->title }}</h3>
<h3>{{ $article->body }}</h3>

<a href="/articles/{{ $article->id }}/edit">Edit</a>
<form action="/articles/{{ $article->id }}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit">Delete</button>
</form>
</body>
</html>
