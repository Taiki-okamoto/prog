<?php
//XSS対応関数

function h($val){
  return htmlspecialchars($val,ENT_QUOTES);
}

//LOGIN認証チェック関数
function loginCheck(){
  if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
      echo "LOGIN ERROR!";
      exit();
    }else{
      session_regenerate_id(true);
      $_SESSION["chk_ssid"] = session_id();
      echo $_SESSION["chk_ssid"];
    }
  }
    //1.  DB接続します

  function db_connect (){
try {
  $pdo = new PDO('mysql:dbname=purpleyak32_gs_db;charset=utf8;host=mysql57.purpleyak32.sakura.ne.jp','purpleyak32','yvtOCjWqwcr8vXXtc1');//(注意)データベース名である。テーブル名ではない
  // $pdo = new PDO('mysql:dbname=gs_db2;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}
return $pdo;
  }



?>
