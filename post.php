<?php
include("functions.php");
session_start();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

check_session_id();

echo ('<pre>');
var_dump($_SESSION);
echo ('</pre>');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿ページ</title>
</head>

<body>
  
  <script>
    document.getElementById('post').focus();
  </script>
</body>

</html>