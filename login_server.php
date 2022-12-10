<?php
session_start();

echo('<pre>');
var_dump($_POST);
echo('</pre>');

echo('<pre>');
var_dump($_SESSION);
echo('</pre>');

if(
  // !isset($_POST["login_id"]||$_POST["login_id"]==""
    !isset($_POST["login_id"])||$_POST["login_id"]==""||!isset($_POST ["login_password"])||$_POST ["login_password"]==""
  ){
  $alert='<script>alert("ログインできません")</script>';
    echo $alert;
    echo '<script>location.href = "login.php"</script>';
    //  login.php
}

?>