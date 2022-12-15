<?php
echo('<pre>');
var_dump ($_POST);
echo('</pre>');

$Post=$_POST["Post"];

echo('<br>');
echo ($Post);

session_start();

echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

$username=$_SESSION["user_name"];

include("functions.php");

$pdo =connect_db();

$sql = 'INSERT INTO Post_table 
(post_id,post_user_name,post, post_created_at) 
VALUES 
(NULL,:username,:post, now())';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':post', $Post, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
// exit();
// $stmt->bindValue(
//   ':username', $username, PDO::PARAM_STR
// );
try {
  $status = $stmt->execute();
  echo 'SQLok';
} 
catch (PDOException $e)
 {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

  header("Location:main.php");	
?>