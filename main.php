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
  <script>
    window.document.onkeydown = function(event) {
      if (event.key === 'Enter') {
        // alert("やった！！！");
        window.location.href = "post.php"
      }
    }
  </script>
  <div class="Test">確認テスト</div>
  <div class="sticky">
    <a href="post.php">かきこむ</a>
    <br>
    <a href="logout.php">ログアウト</a>
  </div>
  <div class="output"><?= $output ?></div>
</body>

</html>