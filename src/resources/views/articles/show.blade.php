<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
<h3>{{ $article->id }}</h3>
<p>書いた人: {{ $article->user->name }}</p>
<h3>{{ $article->title }}</h3>
<h3>{{ $article->body }}</h3>

<a href="/articles/{{ $article->id }}/edit">Edit</a>
<form action="/articles/{{ $article->id }}" method="post">
    @csrf
    <button type="submit">Delete</button>
</form>
</body>
</html>
