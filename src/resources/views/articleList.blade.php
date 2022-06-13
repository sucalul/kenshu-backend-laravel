<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
@foreach ($articles as $article)
    <h3><?= htmlspecialchars($article['id'], ENT_QUOTES, "UTF-8") ?></h3>
    <img src="/img/<?= htmlspecialchars($article['thumbnail_image_id'], ENT_QUOTES, "UTF-8") ?>.png" alt="" style="width:200px; height:200px">
    <h3><?= htmlspecialchars($article['title'], ENT_QUOTES, "UTF-8") ?></h3>
    <p>書いた人: <?= htmlspecialchars($article['name'], ENT_QUOTES, "UTF-8") ?></p>
    <button type="button" class="btn btn-info" onclick="location.href='/articles/<?= htmlspecialchars($article['id'], ENT_QUOTES, "UTF-8") ?>'">More</button>
    <form action="/articles/<?= htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8') ?>/delete" method="post">
        <button type="submit">Delete</button>
    </form>
    <p>-------------------------</p>
@endforeach
<button type="button" onclick="location.href='/articles/create'">新規作成</button>
</body>
</html>
