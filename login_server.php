<?php
// セッションの呼び出し
session_start();
// 関数集の呼び出し
include('functions.php');

// login.phpから送られてきたデータ
echo('<pre>');
var_dump($_POST);
// $_POST["login_id"] $_POST["login_password"]
echo('</pre>');
$username=$_POST["login_id"];
$password = $_POST["login_password"];

// セッションデータ
echo('<pre>');
var_dump($_SESSION);
// $_SESSION["username"] $_SESSION["is_admin"]$_SESSION["user_id"] $_SESSION["session_id"]
echo('</pre>');

// ログインを行う際にIDとPASSが空白なら最初のページに戻す。
if(
    !isset($_POST["login_id"])||$_POST["login_id"]==""||!isset($_POST ["login_password"])||$_POST ["login_password"]==""
  ){
  $alert='<script>alert("ログインできません")</script>';
    echo $alert;
    echo '<script>location.href = "login.php"</script>';
} 

$pdo = connect_db();

$sql = 'SELECT * FROM user WHERE ';


?>