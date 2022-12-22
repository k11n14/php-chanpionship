<style>
  element.style {}

  body {
    background: #76b852;
    background: rgb(141, 194, 111);
    background: linear-gradient(90deg, rgba(141, 194, 111, 1) 0%, rgba(118, 184, 82, 1) 50%);
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
</style>
<?php
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

echo ('<pre>');
var_dump($_POST);
echo ('</pre>');

$opponent_name = $_POST["opponent_name"];
$user = $_SESSION["user_name"];


include('functions.php');

$pdo = connect_db();

$sql = 'SELECT post_user_name,
SUM(like_count) AS like_count_sum
FROM Post_table
LEFT OUTER JOIN (
SELECT post_id
AS add_id,
COUNT(post_id)
AS like_count
FROM Like_table
GROUP BY post_id)
AS result_table
ON Post_table.post_id = result_table.add_id
WHERE post_user_name=:user
GROUP BY post_user_name';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user', $user, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo ('<pre>');
var_dump($result);
echo ('</pre>');

echo ('<pre>');
echo ($result[0]["like_count_sum"]);
echo ('</pre>');

$sql = 'SELECT post_user_name,
SUM(like_count) AS like_count_sum
FROM Post_table
LEFT OUTER JOIN (
SELECT post_id
AS add_id,
COUNT(post_id)
AS like_count
FROM Like_table
GROUP BY post_id)
AS result_table
ON Post_table.post_id = result_table.add_id
WHERE post_user_name=:opponent
GROUP BY post_user_name';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':opponent', $opponent_name, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo ('<pre>');
var_dump($result2);
echo ('</pre>');

echo ('<pre>');
echo ($result2[0]["like_count_sum"]);
echo ('</pre>');

if ($result[0]["like_count_sum"] > $result2[0]["like_count_sum"]) {
  $alert1 = "<script type='text/javascript'>alert('勝ち')</script>";
  echo $alert1;
  echo '<script>location.href = "main.php" </script>';
} else if ($result[0]["like_count_sum"] == $result2[0]["like_count_sum"]) {

  $alert2 = "<script type='text/javascript'>alert('引き分け');</script>";
  echo $alert2;
  echo '<script>location.href = "main.php" </script>';
} else {
  $alert3 = "<script type='text/javascript'>alert('負け')</script>";
  echo $alert3;
  $sql = 'DELETE provisional_table
  FROM like_table 
  AS provisional_table
  LEFT OUTER JOIN post_table
  ON  provisional_table.post_id =Post_table.post_id
  WHERE post_user_name=:user
  ';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user', $user, PDO::PARAM_STR);
  try {
    $status = $stmt->execute();
  } catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    echo ('222');
    exit();
  }
  echo '<script>location.href = "main.php" </script>';
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

</body>

</html>