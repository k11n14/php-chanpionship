<?php
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

$user_login_id= $_SESSION["user_id"];
echo $user_login_id;

include("functions.php");

$pdo = connect_db();

// $sql = "SELECT * 
// FROM Post_table 
// LEFT OUTER JOIN ( SELECT post_id AS add_id, COUNT(post_id) AS like_count FROM Like_table GROUP BY post_id) AS result_table 
// ON Post_table.post_id = result_table.add_id
// INNER JOIN (SELECT post_id AS CCC FROM Like_table WHERE users_id = 4) AS TTT
// ON  Post_table.post_id= TTT.CCC;";

// $stmt = $pdo->prepare($sql);

// try {
//   $status = $stmt->execute();
// } catch (PDOException $e) {
//   echo json_encode(["sql error" => "{$e->getMessage()}"]);
//   exit();
// }

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo ('<pre>');
// var_dump($result);
// echo ('</pre>');

// foreach ($result as $record)

// $like = $pdo->prepare('SELECT post_id FROM like_table WHERE users_id=?');
// $like->execute(array($_SESSION['user_id']));
// while ($like_record = $like->fetch()) {
//   $my_like[] = $like_record;
// }

$sql= 'SELECT post_id FROM like_table WHERE users_id=:user_login_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_login_id', $user_login_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$my_like = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo ('<pre>');
var_dump($my_like);
echo ('</pre>');

$my_like_cnt = 0;
foreach ($my_like as $record) {
  echo ('<br>');
  echo $record["post_id"];
  if($record["post_id"]>17){
    $my_like_cnt = 1;
  } else{
    echo "NO";
  }
}

echo ('<pre>');
var_dump($my_like_cnt);
echo ('</pre>');



// $output = "";
// foreach ($my_like as $record) {
//   $output .= $record["post_id"];
//   echo ('<br>');
//   var_dump($output);
// }

// $output2 = [];
// foreach ($my_like as $record) {
//   $output2 .= $record["post_id"];
//   echo ('<br>');
//   var_dump($output2);
// }


// $my_like_cnt = 0;
// if (!empty($my_like)) {
// $my_like_cnt = 0;
// if ($like_post_id == $post['post_id']) {
// $my_like_cnt = 1;
// }
// }

// $my_like_cnt = 0;
// if (!empty($my_like)) {
//   foreach ($my_like as $like_post) {
//     foreach ($like_post as $like_post_id) {
//       if ($like_post_id == $post['post_id']) {
//         $my_like_cnt = 1;
//       }
//     }
//   }


foreach ($result as $record) {
  echo ('BBBB');
  echo ($record["post_id"]);
  foreach ($my_like as $record2) {
    echo ('<br>');
    echo $record2["post_id"];
    if ($record["post_id"] == $record2["post_id"]) {
      echo ('OK');
    }
  }
  echo ('<br>');
}



foreach ($result as $record) {
  foreach ($my_like as $record2) {
    if ($record["post_id"] == $record2["post_id"]) {
      $output .= "<div>GGGGG</div>";;
    }
  }
}

     let todos = [];
            response.data.forEach(todo => {
              todos.push(`
            <fieldset>
            <div>${todo.post_user_name}</div>
            <div>${todo.post}<div>
            </fieldset>
            `)
            });
?>