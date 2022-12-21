<?php
// var_dump($_GET);
// include(functions.php);
include("functions.php");

$pdo = connect_db();

$search_word = $_GET["searchword"];
// echo ($search_word);

$sql = "SELECT * FROM users_table  WHERE users_name LIKE :search_word";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search_word', "%{$search_word}%", PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



// echo ('<pre>');
// var_dump ($result);
// echo ('</pre>');

// exit();
// echo json_encode(array_values($result));
// echo json_encode($result,JSON_UNESCAPED_UNICODE);
echo json_encode($result);

exit();


