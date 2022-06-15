<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
@include('error')

<form action="/articles/create" method="post" enctype="multipart/form-data" name="postForm">
    @csrf
    <div>
        <label class="title" for="title">タイトル</label>
        <input id="title" type="text" name="title" required>
    </div>

    <div>
        <label class="body" for="body">本文</label>
        <textarea rows="4" id="body" name="body" required></textarea>
    </div>
    <input type="submit" name="submit" >
</form>
</body>
</html>
