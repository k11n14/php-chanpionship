<?php
include("functions.php");
session_start();

echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

check_session_id();

echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿画面</title>
</head>
<body>
  <form action="post_server.php" method="POST">
  <fieldset>
    <legend>投稿</legend>
    <div>
      一言: <input type="text" name="Post">
    </div>
  </fieldset>
</form>
</body>
</html>