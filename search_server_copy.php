<?php
include("functions.php");

echo ('<pre>');
var_dump($_POST);
echo ('</pre>');

session_start();
echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

check_session_id();

// echo ('<pre>');
// var_dump($_SESSION);
// echo ('</pre>');
$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

$search_word = $_POST["search_word"];



$pdo = connect_db();

$sql = 'SELECT post_id FROM like_table WHERE users_id=:user_login_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_login_id', $user_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$my_like = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo ('<pre>');
// var_dump($my_like);
// echo ('</pre>');

// foreach ($my_like as $record2) {
//   echo ('<br>');
//   echo $record2["post_id"];
// }


$sql = 'SELECT * FROM follow_table WHERE follower=:follower';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follower', $user_id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$my_follow = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo ('<pre>');
var_dump($my_follow);
echo ('</pre>');

foreach ($my_follow as $record3) {
  echo ('<br>');
  echo $record3["followed"];
}





$sql = 'SELECT * 
FROM Post_table 
LEFT OUTER JOIN ( 
SELECT post_id 
AS add_id, 
COUNT(post_id) 
AS like_count 
FROM Like_table 
GROUP BY post_id) 
AS result_table 
ON Post_table.post_id = result_table.add_id
LEFT OUTER JOIN (
SELECT users_id,users_name  
FROM Users_table) 
AS TTT
ON Post_table.post_user_name = TTT.users_name
WHERE post_user_name 
LIKE :word 
||post 
LIKE :word
ORDER BY post_created_at DESC
';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':word', "%$search_word%", PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo ('<pre>');
var_dump($result);
echo ('</pre>');

$search_result = "";
foreach ($result as $record) {
  $search_result .= "
  <fieldset>
  <legend>{$record["post_user_name"]}</legend>
  <div class='display_post'>
  <div id='output' class='output_No{$record["post_id"]}'>
  <div>{$record["post"]}</div>
  ";



  $my_like_cnt = 0;
  foreach ($my_like as $record2) {
    if ($record["post_id"] == $record2["post_id"]) {
      $my_like_cnt = 1;
    }
  }
  if ($user_id !== $record["users_id"]) {
    if ($my_like_cnt < 1) {
      $search_result .= "<div><a class='like' href='like_server.php?user_id={$user_id}&post_id={$record["post_id"]}'>確かに<span>☆</span>{$record["like_count"]}</a></div>";
    } else {
      $search_result .= "<div><a class='liked' href='like_server.php?user_id={$user_id}&post_id={$record["post_id"]}'>確かに<span>★</span>{$record["like_count"]}</a></div>";
    }
  }
  if ($user_name == $record["post_user_name"]) {
    $search_result .= "
  <div><a class='A_delete' href='delete_server.php?post_id={$record["post_id"]}'>削除</a></div>
  ";
  } else {
    foreach ($my_follow as $record3) {
      
      if ($record["users_id"] == $record3["followed"]) {
    $search_result .= "
  <div><a class='A_follow' href='follow_server.php?post_id={$record["users_id"]}'>フォロー解除</a></div>
  ";

    }else{
        $search_result .= "
  <div><a class='A_follow' href='follow_server.php?post_id={$record["users_id"]}'>フォロー</a></div>
  ";

    }

  }
}

  $search_result .= "
  <div>{$record["post_created_at"]}</div>
  </div>
  </div>
  <div class='display_canvas'>
  <canvas id='Post_canvas_No{$record["post_id"]}' width='120' height='120'></canvas>
  </div>
  </fieldset>

  <script>
  function canvas_draw() {
	const canvas = document.getElementById('Post_canvas_No{$record["post_id"]}');
	const context = canvas.getContext('2d');
	context.arc(
	canvas.width / 2,
	canvas.height / 2,
  {$record["like_count"]},
	(0 * Math.PI) / 180,
  (360 * Math.PI) / 180,
	false
	);
	context.fillStyle = 'red';
	context.fill();
}
canvas_draw()
</script>
";
}


// echo ('<pre>');
// var_dump($output);
// echo ('</pre>');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索結果ページ</title>
  <link rel="stylesheet" href="./css/php_Championship.css">
</head>

<body>
  <div class="sticky">
    <a href="main.php">戻る</a>
  </div>
  <div class="output"><?= $search_result ?></div>
</body>