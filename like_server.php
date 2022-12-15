<?php
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

echo ('<pre>');
var_dump($_GET);
echo ('</pre>');

include('functions.php');

$user_id = $_GET['user_id'];
$post_id = $_GET["post_id"];

$pdo = connect_db();

$sql = 'INSERT INTO Like_table (like_id, post_id, users_id, like_created_at) 
VALUES (NULL, :user_id, :post_id, now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':post_id', $post_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


?>
