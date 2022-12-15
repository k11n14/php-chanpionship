<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録ページ</title>
</head>

<body>
  <form action="register_server.php" method="POST">
    <fieldset>
      <legend>ユーザ登録</legend>
      <div>
        User Id: <input type="text" name="register_id">
      </div>
      <div>
        Pass Word: <input type="text" name="register_password">
      </div>
      <div>
        User Name: <input type="text" name="register_user_name">
      </div>
      <div>
        <button>登録</button>
      </div>
      <a href="login.php">ログインページ</a>
    </fieldset>
  </form>

</body>

</html>