<?php
session_start();
// $session_id = session_id();

// echo $session_id;
// // $_SESSION['session_id'] = session_id();
// // session_start();
// // session_id();
// // $session_id = session_id();

// echo ('<pre>');
// var_dump($_SESSION);
// echo ('</pre>');
echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログインページ</title>
</head>

<body>
  <form action="login_server.php" method="POST">
    <fieldset>
      <legend>ログイン</legend>
      <div>
        User Id: <input type="text" name="login_id">
      </div>
      <div>
        Pass Word: <input type="password" name="login_password">
      </div>
      <div>
        <input type="submit" value="ログイン">
      </div>
      <a href="register.php">登録はこちら</a>
    </fieldset>
  </form>

</body>

</html>