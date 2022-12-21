<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索ページ</title>
</head>

<body>
  <form action="search_server.php" method="post">
    <input type="text" name="search_word">
    <input type="submit" value="送信">
  </form>
  <div class="search_result"><?= $search_result ?></div>
</body>