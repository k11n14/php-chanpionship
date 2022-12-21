<?php
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

echo ('<pre>');
var_dump($_GET);
echo ('</pre>');

$follow_id = $_SESSION["user_id"];
$followed_id= $_GET["post_id"];

echo ('<pre>');
var_dump($follow_id);
echo ('</pre>');

echo ('<pre>');
var_dump($followed_id);
echo ('</pre>');

include("functions.php");
$pdo = connect_db();

$sql = 'SELECT COUNT(*) FROM follow_table WHERE follower=:follower AND followed=:followed';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follower', $follow_id, PDO::PARAM_STR);
$stmt->bindValue(':followed', $followed_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$T=$stmt->fetchColumn();
echo ($T);

if ($T !== '0') {
  $sql = 'DELETE FROM follow_table WHERE follower=:follower AND followed=:followed';
  echo 'DELETE';
} else {
  $sql = 'INSERT INTO follow_table (id, follower, followed, delete_flg) 
VALUES (NULL,:follower,:followed,NULL)';
  echo 'INSERT';
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':follower', $follow_id, PDO::PARAM_STR);
$stmt->bindValue(':followed', $followed_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
header("Location:main.php");
exit();