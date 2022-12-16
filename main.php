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
 <!-- <script src="./JS/main.js"></script> -->
</head>

<body>
  <div class="Test">確認テスト</div>
  <div class="sticky">
    <a href="post.php">かきこむ（Enter押してね。）</a>
    <br>
    <a href="logout_server.php">ログアウト</a>
  </div>
  <div class="output"><?= $output ?></div>















  <script>
    console.log("Hello World!");
    // alert("Hello World!");

    window.document.onkeydown = function(event) {
      if (event.key === "Enter") {
        // alert("やった！！！");
        window.location.href = "post.php";
      }
    };
    
    
    // 要素への参照を取得
    var like_count = document.getElementById('Test');
    // コンソールにテキストを表示
    // console.log(like_count.textContent);

    const canvas = document.getElementById("Post_canvas");

    canvas.width = 120;
    canvas.height = 120;

    // if (canvas.getContext) {
      const context = canvas.getContext("2d");
      //左から20上から40の位置に、幅50高さ100の四角形を描く
      context.fillRect(canvas.width / 2, canvas.height / 2, 20, 20);

      context.strokeStyle = "rgb(00,00,255)";
      context.fillStyle = "rgb(255,00,00)";
    // }
  </script>
</body>

</html>