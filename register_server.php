<?php
// array(3) {
//   ["register_id"]=>
//   string(2) "AA"
//   ["register_password"]=>
//   string(2) "SS"
//   ["register_user_name"]=>
//   string(2) "DD"
// }
echo('<pre>');
var_dump ($_POST);
echo('</pre>');
$userid = $_POST["register_id"];
$userpassword = $_POST["register_password"];
$username = $_POST["register_user_name"];

include("functions.php");
$pdo =connect_db();

$sql = 'SELECT COUNT(*) FROM Users_table WHERE users_login_id=:userid||users_name=:username';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);



try {
  $status = $stmt->execute();
  echo 'SQLok';
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// $val = $stmt->fetch(PDO::FETCH_ASSOC);
// echo('<pre>');
// echo ("val");
// echo('<br>');
// var_dump($val );
// echo('</pre>');
// $T=$stmt->fetchColumn();
// echo ($T);

if ($stmt->fetchColumn() > 0) {
    $alert = "<script>alert('既に登録されています。')</script>";
    echo $alert;
    echo '<script>location.href = "register.php" </script>';
  exit();
}

$sql = 'INSERT INTO Users_table
(users_id, users_login_id, users_login_password, users_name, users_login_at, users_created_at, users_delete)
VALUES
(NULL,:id, :password,:name, NULL, now(),NULL)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $userid, PDO::PARAM_STR);
$stmt->bindValue(':password', $userpassword, PDO::PARAM_STR);$stmt->bindValue(':name', $username, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

?>