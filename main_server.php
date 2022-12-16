<?php
include("functions.php");

session_start();
// echo('<pre>');
// var_dump ($_SESSION);
// echo('</pre>');

check_session_id();

// echo ('<pre>');
// var_dump($_SESSION);
// echo ('</pre>');
$user_id = $_SESSION["user_id"];

$pdo = connect_db();

$output = "";

// $sql = 'SELECT * 
// FROM Post_table 
// ORDER BY post_created_at DESC';

// $sql = 'SELECT * 
// FROM Post_table 
// LEFT OUTER JOIN (
// SELECT post_id as add_id, 
// COUNT(post_id) 
// AS like_count 
// FROM Like_table 
// GROUP BY post_id) 
// AS result_table 
// ON Post_table.post_id = result_table.post_id';

// 
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
  echo 'SQLok';
  echo '<br>';
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo ('<pre>');
// var_dump($result);
// echo ('</pre>');

foreach ($result as $record) {
  $output .= "
  <fieldset>
  <legend>{$record["post_user_name"]}</legend>
  <div class='display_post'>
  <div id='output' class='output_No{$record["post_id"]}'>
  <div>{$record["post"]}</div>
  <div><a href='like_server.php?user_id={$user_id}&post_id={$record["post_id"]}'>Good</a></div>
  <div id='Like_count' class='like_count'>{$record["like_count"]}</div>
  <div><a href='delete_server.php?post_id={$record["post_id"]}'>削除</a></div>
  <div>{$record["post_created_at"]}</div>
  </div>
  </div>
  <div class='display_canvas'>
  <canvas id='Post_canvas' class='post_canvas'></canvas>
  </div>
  </fieldset>
";
}
