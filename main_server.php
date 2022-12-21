<?php
include("functions.php");

session_start();
echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

check_session_id();

// echo ('<pre>');
// var_dump($_SESSION);
// echo ('</pre>');
$user_id = $_SESSION["user_id"];

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

foreach ($my_like as $record2) {
  echo ('<br>');
  echo $record2["post_id"];
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
ORDER BY post_created_at DESC
';


$stmt = $pdo->prepare($sql);

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

// if ({$record["post_id"]} =={$record2["post_id"]}) {
//   echo 'OK';
// } else {
//   echo 'NO';
// };


// foreach ($result as $record) {
//   echo ('BBBB');
//   echo ($record["post_id"]);
//   foreach ($my_like as $record2) {
//     echo ('<br>');
//     echo $record2["post_id"];
//     if ($record["post_id"] == $record2["post_id"]) {
//       $output .= "GGGGG";
//     }
//   }
//   echo ('<br>');
// }


foreach ($result as $record) {
  $output .= "
  <fieldset>
  <legend>{$record["post_user_name"]}</legend>
  <div class='display_post'>
  <div id='output' class='output_No{$record["post_id"]}'>
  <div>{$record["post"]}</div>
  <div><a href='like_server.php?user_id={$user_id}&post_id={$record["post_id"]}'>Good</a></div>
  ";
  foreach ($my_like as $record2) {
    if ($record["post_id"] == $record2["post_id"]) {
      $output .= "<div>いいね済</div>";
    }
}
  
  $output .= "
  <div id='Like_count_No{$record["post_id"]}' class='like_count'>{$record["like_count"]}</div>
  <div><a href='delete_server.php?post_id={$record["post_id"]}'>削除</a></div>
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

