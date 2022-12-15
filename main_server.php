<?php
include("functions.php");

session_start();
// echo('<pre>');
// var_dump ($_SESSION);
// echo('</pre>');

check_session_id();

echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

$pdo = connect_db();

$output = "";

$sql ='SELECT * FROM Post_table ORDER BY post_created_at DESC';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
  echo 'SQLok';
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo('<pre>');
// var_dump ($result);
// echo('</pre>');

foreach ($result as $record) {
 $output .= "
  <fieldset>
  <legend>{$record ["post_user_name"]}</legend>
 <div id='output' class='output_No{$record["post_id"]}'>
 <div>{$record ["post"]}</div>
 <div>{$record ["post_created_at"]}</div>
 </div>
  </fieldset>
 ";
}
?>