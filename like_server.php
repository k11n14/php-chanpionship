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

echo $user_id;
echo('<br>');
echo $post_id;
// ok
// exit();
$pdo = connect_db();

$sql = 'SELECT COUNT(*) FROM Like_table WHERE post_id=:post_id AND users_id=:user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':post_id', $post_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  echo ('111');
  exit();
}

$like_count = $stmt->fetchColumn();

echo ('<pre>');
var_dump($like_count);
echo ('</pre>');
// exit();

if ($like_count !== '0') {
  $sql = 'DELETE FROM Like_table WHERE post_id=:post_id AND users_id=:user_id';
  echo 'DELETE';
}
else {
$sql = 'INSERT INTO Like_table (like_id, post_id, users_id, like_created_at) 
VALUES (NULL,:post_id,:user_id,now())';
echo 'INSERT';
}
  
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->bindValue(':post_id', $post_id, PDO::PARAM_STR);
  
  try {
    $status = $stmt->execute();
  } catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    echo ('222');
    exit();
  }
  
header("Location:main.php");
exit();
?>
