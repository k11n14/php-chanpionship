<?php
include("main_server.php");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メインページ</title>
  <link rel="stylesheet" href="./css/php_Championship.css">
</head>
<body>
  <a href="post.php">かきこむ</a>
  <div class="output"><?= $output ?></div>
</body>
</html>