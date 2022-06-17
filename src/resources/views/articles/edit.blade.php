<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
@include('error')

<form action="/articles/{{ $article->id }}" method="post"
      enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div>
        <label class="title" for="title">タイトル</label>
        <input type="text" name="title" value="{{ $article->title }}"
               required>
    </div>
    <div>
        <label class="body" for="body">本文</label>
        <textarea rows="4" id="body" name="body"
                  required>{{ $article->body }}</textarea>
    </div>
    <input type="submit" value="Update">
</form>
</body>
</html>
