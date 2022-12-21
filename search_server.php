<?php
include("functions.php");

echo ('<pre>');
var_dump($_POST);
echo ('</pre>');

echo ('<pre>');
echo ($_POST["search_word"]);
echo ('</pre>');

$search_word = $_POST["search_word"];

$pdo = connect_db();


if (
  isset($_POST["search_word"])
) {

  $sql = 'SELECT * FROM post_table WHERE post_user_name LIKE :word ||post LIKE :word ORDER BY post_created_at DESC LIMIT 10';


  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':word', "%$search_word%", PDO::PARAM_STR);

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

  $search_result = "";
  foreach ($result as $record) {
    $search_result .= "
    <fieldset>
  <legend>{$record["post_user_name"]}</legend>
  <div class='display_post'>
  <div id='output' class='output_No{$record["post_id"]}'>
  <div>{$record["post"]}</div>
  <div>{$record["post_created_at"]}</div>
  </div>
  </div>
  <div class='display_canvas'>
  <canvas id='Post_canvas_No{$record["post_id"]}' width='120' height='120'></canvas>
  </div>
  </fieldset>
  ";
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索ページ</title>
</head>

<body>
  <div class="search_result"><?= $search_result ?></div>
</body>