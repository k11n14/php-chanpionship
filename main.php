<?php
include("functions.php");
session_start();
echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

check_session_id();

echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');

$pdo = connect_db();

$sql ='SELECT * FROM Post_table';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
  echo 'SQLok';
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo('<pre>');
var_dump ($result);
echo('</pre>');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メインページ</title>
</head>
<body>

  <a href="post.php">かきこむ</a>
  
</body>
</html>