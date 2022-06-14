<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事</title>
</head>
<body>
<h1>Signin</h1>
@include('error')

<form action="/auth/signin" method="post">
    @csrf
    <div>
        <label for="email">メールアドレス</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label for="password">パスワード</label>
        <input type="password" name="password" required>
    </div>
    <input type="submit" name="submit" value="Sign In" >
</form>
</body>
</html>
