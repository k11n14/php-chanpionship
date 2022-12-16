<?php
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

echo ('<pre>');
var_dump($_GET);
echo ('</pre>');

include('functions.php');
$pdo = connect_db();

$id= $_GET["post_id"];

$sql = 'DELETE FROM Post_table WHERE post_id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:main.php');
exit();
?>