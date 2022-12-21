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
  <div>
    検索フォーム：<input type="text" id="search">
  </div>
  <a href="./battle.php">出稼ぎ</a>
  <div id="todo"></div>
  <div id="Test" class="test">確認テスト</div>
  <div class="sticky">
    <a href="post.php">かきこむ（Enter押してね。）</a>
    <br>
    <a href="logout_server.php">ログアウト</a>
  </div>
  <div class="output"><?= $output ?></div>

  <script src="./JS/main_php.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    function hoge() {
      処理
      setTimeout(function() {
        hoge()
      }, 1000);
    }
    hoge();
    </script>
  <script>
    $("#search").on("keyup", function(e) {
      
      console.log(e.target.value);
      const searchWord = e.target.value;
      const requestUrl = "ajax_get.php";
      if (e.target.value == '') {
        $("#todo").empty();
      } else {
        axios
        .get(`${requestUrl}?searchword=${searchWord}`)
        
        .then(function(response) {
          
          console.log(response);
          console.log(response.data);
          console.log(response.data[0]);
          console.log(response.data[0].post);
          console.log(response.data[0].post_user_name);
          
          
          
          
          let todos = [];
          response.data.forEach(todo => {
            todos.push(`
            <fieldset>
            <div>${todo.post_user_name}</div>
            <div>${todo.post}<div>
            </fieldset>
            `)
          });
          
          console.log(todos)
          $('#todo').html(todos)
          
          
        })
        .catch(function(error) {
          // 省略
        })
        .finally(function() {
          // 省略
        });
      }
    });
      </script>


</body>

</html>