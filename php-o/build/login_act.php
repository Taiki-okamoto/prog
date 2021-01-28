<?php
session_start();
include("funcs.php");


$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

//1. 接続します
$pdo = db_connect();


//２．データ登録SQL作成
$sql = "SELECT * FROM gs_user_table WHERE lid=:lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //fetch関数で、1レコードだけ取得することができる。その方法

//４. 該当レコードがあればSESSIONに値を代入
if( password_verify($lpw, $val["lpw"]) ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["name"]       = $val['name'];//山崎さんようこそを使い歌め
  $_SESSION["kanri_flg"]  = $val['kanri_flg'];

  //Login処理OKの場合select.phpへ遷移
  header("Location: index.html");
}else{
  //Login処理NGの場合login.phpへ遷移
  header("Location: login.php");
}
//処理終了
exit();
?>

