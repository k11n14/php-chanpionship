<?php
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

$user= $_SESSION["user_name"];

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

?>