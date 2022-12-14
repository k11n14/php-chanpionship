<?php
echo('<pre>');
var_dump ($_POST);
echo('</pre>');

$login_id=$_POST["login_id"];
$login_password=$_POST["login_password"];

echo('<pre>');
echo ($login_id);
echo('<br>');
echo ($login_password);
echo('</pre>');

session_start();

echo('<pre>');
var_dump ($_SESSION);
echo('</pre>');



include('functions.php');
$pdo =connect_db();

$sql = 'SELECT * FROM Users_table
WHERE users_login_id =:id 
AND users_login_password =:password 
AND users_delete IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $login_id, PDO::PARAM_STR);
$stmt->bindValue(':password', $login_password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
  echo 'SQLok';
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);

echo('<pre>');
var_dump($val );
echo('</pre>');


if (!$val) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=todo_login.php>ログイン</a>";
  exit();
} 
else {
  $_SESSION = array();
  $_SESSION['session_id'] = session_id();
  $_SESSION['user_id'] = $val["users_login_id"];
  $_SESSION['user_name'] = $val["users_name"];
  echo('<pre>');
  var_dump ($_SESSION);
  echo('</pre>');
  header("Location:post.php");
  exit();
}

?>