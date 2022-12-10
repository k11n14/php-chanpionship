<?php

function connect_db()
{
$dbn ='mysql:dbname=データベース名;charset=utf8mb4;port=3306;
host=localhost';
$user = 'root';
$pwd = '';


try{
  // echo '<bre>';
  echo ('<bre>');
  echo 'DBok';
  return new PDO ($dbn,$user,$pwd);
} catch (PDOException $e){
echo json_encode(['db error'=>'{$e->getMessage()}']);
exit();
}
}
?>