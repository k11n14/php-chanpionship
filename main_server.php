<?php
include("functions.php");

session_start();
// echo ('<pre>');
// var_dump($_SESSION);
// echo ('</pre>');

check_session_id();

// echo ('<pre>');
// var_dump($_SESSION);
// echo ('</pre>');

$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$pdo = connect_db();

$sql = 'SELECT COUNT(*) FROM follow_table WHERE follower=:follower AND followed=:followed';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follower', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':followed', $user_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$T = $stmt->fetchColumn();
// echo ($T);


if ($T == 0) {
  $sql = 'INSERT INTO follow_table (id, follower, followed, delete_flg) 
VALUES (NULL,:follower,:followed,NULL)';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':follower', $user_id, PDO::PARAM_STR);
  $stmt->bindValue(':followed', $user_id, PDO::PARAM_STR);
  try {
    $status = $stmt->execute();
  } catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
  }
}


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
// echo ('<pre>');
// var_dump($my_follow);
// echo ('</pre>');

// foreach ($my_follow as $record3) {
//   echo ('<br>');
//   echo $record3["followed"];
// }




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
ORDER BY post_created_at DESC
';


$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':username', $user_name, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo ('<pre>');
// var_dump($result);
// echo ('</pre>');

$output = "";
foreach ($result as $record) {
  foreach ($my_follow as $record3) {
    if ($record["users_id"] == $record3["followed"]) {
      $output .= "
  <fieldset id='F_No{$record["post_id"]}'>
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
          $output .= "<div><a class='like' href='like_server.php?user_id={$user_id}&post_id={$record["post_id"]}'>確かに<span>☆</span>{$record["like_count"]}</a></div>
          <div><a class='A_follow' href='follow_server.php?post_id={$record["users_id"]}'>フォロー解除</a></div>
          ";
        } else {
          $output .= "<div><a class='liked' href='like_server.php?user_id={$user_id}&post_id={$record["post_id"]}'>確かに<span>★</span>{$record["like_count"]}</a></div>
          <div><a class='A_follow' href='follow_server.php?post_id={$record["users_id"]}'>フォロー解除</a></div>
          ";
        }
        
      }

      if ($user_name == $record["post_user_name"]) {
        $output .= "
  <div><a class='A_delete' href='delete_server.php?post_id={$record["post_id"]}'>削除</a></div>
  ";
      }
      $output .= "
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
  {$record["like_count"]}*2,
	(0 * Math.PI) / 180,
  (360 * Math.PI) / 180,
	false
	);
	context.fillStyle = 'red';
	context.fill();
}
canvas_draw()
</script>
<script>
window.addEventListener('load',function() {
  const N ='{$record["users_name"]}'
  const n = stringToNumber(N);
  const colorAngle = (n*n) % 360;
  const element = document.getElementById('F_No{$record["post_id"]}'); 
  element.style.backgroundColor = `hsl(\${colorAngle}, 80%, 64%)`;
});

var stringToNumber = (str) => {
  return Array.from(str).map(ch => ch.charCodeAt(0)).reduce((a, b) => a+b);
};



</script>
";
    }
  }
}
// echo ('<pre>');
// var_dump($output);
// echo ('</pre>');
