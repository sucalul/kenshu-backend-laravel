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

    <p>登録しているタグ</p>
    <ul>
        @foreach($article->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>
    <div>
        <p>タグを変更する</p>
        @foreach( $tags as $tag )
            <input type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->id }}">
                <label for="{{ $tag->id }}">{{ $tag->name }}</label>
            </input>
        @endforeach
    </div>
    <!-- サムネイル画像 -->
    <img src="/img/{{ $article->thumbnail_image_name }}" alt="" style="width:200px; height:200px">
    <input type="radio" id="{{ $article->thumbnail_image_name }}" name="is-thumbnail" value="{{ $article->thumbnail_image_name }}" checked>
    <label for="{{ $article->thumbnail_image_name }}">この画像をサムネイルにする！</label>
    <!-- サムネイル以外の画像 -->
    @foreach($article->article_image as $image)
        <div class="{{ $image->image_name }}">
            <img src="/img/{{ $image->image_name }}" alt="" style="width:200px; height:200px">
            <input type="radio" id="{{ $image->image_name }}" name="is-thumbnail" value="{{ $image->image_name }}">
            <label for="{{ $image->image_name }}">この画像をサムネイルにする！</label>
        </div>
    @endforeach
    <input type="file" id="images" name="upload_image[]" multiple>
    <div id="preview"></div>
    <input type="submit" value="Update">
</form>
<script src="{{ asset('/js/preview.js') }}"></script>
</body>
</html>
