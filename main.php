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
  <style>
    element.style {}

    body {
      background: #76b852;
      background: rgb(141, 194, 111);
      background: linear-gradient(90deg, rgba(141, 194, 111, 1) 0%, rgba(118, 184, 82, 1) 50%);
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
  </style>
  <div>
    <!-- 検索フォーム：<input type="text" id="search"> -->
  </div>
  <div id="todo"></div>
  <div id="Test" class="test">ようこそ <?= $_SESSION["user_name"] ?> さん</div>
 
  <form class="search_form" action="search_server_copy.php" method="post">
    <div>
      <input type="text" name="search_word">
      <input type="submit" value="検索">
    </div>
  </form>

  <div id="logout"><a href="logout_server.php">ログアウト</a></div>
  <div class="sticky">
    <form action="post_server.php" method="POST">
      <div>
        一言: <input type="text" id="postt" name="Post">
      </div>
      <script>
        document.getElementById('postt').focus();
      </script>
    </form>
    <br>
    <form action="battle_server.php" method="POST">
      <div>
        バトル<input type="text" id="Opponent_name" name="opponent_name">
      </div>
    </form>
  </div>
  <div class="output"><?= $output ?></div>

  <script src="./JS/main_php.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <script>
    // $("#search").on("keyup", function(e) {

    //   console.log(e.target.value);
    //   const searchWord = e.target.value;
    //   const requestUrl = "ajax_get.php";
    //   if (e.target.value == '') {
    //     $("#todo").empty();
    //   } else {
    //     axios
    //       .get(`${requestUrl}?searchword=${searchWord}`)

    //       .then(function(response) {

    //         console.log(response);
    //         console.log(response.data);
    //         console.log(response.data[0]);




    // console.log(response.data[0].post);
    // console.log(response.data[0].post_user_name);
    // let todos = [];
    // response.data.forEach(todo => {
    //   todos.push(`
    // <fieldset>
    // <div>${todo.post_user_name}</div>
    // <div>${todo.post}<div>
    // </fieldset>
    // `)
    // });

    // console.log(todos)
    // $('#todo').html(todos)


    //       })
    //       .catch(function(error) {
    //         // 省略
    //       })
    //       .finally(function() {
    //         // 省略
    //       });
    //   }
    // });
  </script>


</body>

</html>