<?php
//1.GETでid値を取得

$id = $_GET["id"];


//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM gs_an_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
  //$row["name"], ,,,

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート結果</legend>
     <label>名前：<input type="text" name="name" value="<?= $row["name"]?>" ></label><br>
     <label>性別：<input type="text" name="sex" value="<?=$row["sex"]?>"></label><br>
     <label>症状：<input type="text" name="naiyou" value="<?= $row["naiyou"]?>" size="60px"></label><br>
     <label>アレルギー：<input type="text" name="arg_ex" value="<?= $row["arg_ex"]?>"></label><br>


    <input type="hidden" name="id" value="<?=$row["id"]?>">

     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
Main[End]


</body>
</html>
