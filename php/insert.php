<?php
//入力チェック(受信確認処理追加)
// if(
//   !isset($_POST["name"]) || $_POST["name"]=="" ||
//   !isset($_POST["birth"]) || $_POST["birth"]=="" ||
//   !isset($_POST["phone_number"]) || $_POST["phone_number"]=="" ||
//   !isset($_POST["sex"]) || $_POST["sex"]=="" ||
//   !isset($_POST["check"]) || $_POST["check"]=="" ||//エラー候補//配列で入ってるから。
//   !isset($_POST["med"]) || $_POST["med"]=="" ||
//   !isset($_POST["kind_of_med"]) || $_POST["kind_of_med"]=="" ||
//   !isset($_POST["arg1"]) || $_POST["arg1"]=="" ||
//   !isset($_POST["arg2"]) || $_POST["arg2"]=="" ||

//   !isset($_POST["arg_ex"]) || $_POST["arg_ex"]=="" ||
//   !isset($_POST["srg"]) || $_POST["srg"]=="" ||
//   !isset($_POST["srg_ex"]) || $_POST["scrg_ex"]=="" 

//   ){
//   exit('ParamError');
// }


//1. POSTデータ取得

$name = $_POST["name"];
$birth = $_POST["birth"];
$phone_number = $_POST["phone_number"];
$sex = $_POST["sex"];
$naiyou = $_POST["check"];
$med = $_POST["med"];
$kind_of_med = $_POST["kind_of_med"];
$arg = $_POST["arg"];
$arg_ex = $_POST["arg_ex"];
$srg = $_POST["srg"];
$srg_ex = $_POST["srg_ex"];

if (isset($_POST['check']) && is_array($_POST['check'])) {
  $naiyou = implode("、", $_POST["check"]); //配列を区切っている
}

if (isset($_POST['med']) && is_array($_POST['med'])) {
  $med = implode("、", $_POST["med"]); //配列を区切っている
}

if (isset($_POST['sex']) && is_array($_POST['sex'])) {
  $sex = implode("、", $_POST["sex"]); //配列を区切っている
}


//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table(id, name, birth, phone_number, sex, naiyou, med, kind_of_med, arg, arg_ex, srg, srg_ex, indate )
VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, :a7, :a8, :a9, :a10, :a11, sysdate())");

$stmt->bindValue(':a1', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $birth, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $phone_number, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $med, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a7', $kind_of_med, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a8', $arg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a9', $arg_ex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a10', $srg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a11', $srg_ex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();//実行する

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");//飛ぶ先
  exit;

}
?>
