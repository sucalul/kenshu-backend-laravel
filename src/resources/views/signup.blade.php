<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
<h1>Signup</h1>
@if($errors)
    <ul class="error_list">
        @foreach ($errors->all() as $error)
            <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="/auth/signup" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">名前</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label for="email">メールアドレス</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label for="password">パスワード</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label for="profile_image">プロフィール画像</label>
        <input type="file" name="profile_image">
    </div>
    <input type="submit" name="submit" value="Sign Up" >
</form>
</body>
</html>
