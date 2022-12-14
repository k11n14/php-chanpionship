<?php
// 確認用
// echo('<pre>');
// var_dump ();
// echo('</pre>');

// echo('<pre>');
// echo ();
// echo('</pre>');

// echo('<br>');
// echo ();

// 呼び出し用
// include("functions.php");

function connect_db()
{
$dbn ='mysql:dbname=php_chanpionship;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try{
  echo('<pre>');
  echo ('DBok');
  echo('</pre>');
  return new PDO ($dbn,$user,$pwd);
} 

catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
}


?>
