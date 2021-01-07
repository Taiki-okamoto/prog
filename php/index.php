<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title >データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="main2.css" rel="stylesheet">

  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header" style="margin: 0 0 0 30px;"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form  method="post" action="insert.php">
  <div class="jumbotron">
  <div style="margin: 0 0 0 30px;">
  <fieldset>
    <legend><h1 style="font-size: 38px; margin: 0 20px 20px 20px;">オンライン問診票</h1></legend>
    <label class="label1">　名前：　　<input type="text" name="name"></label>
    <label class="label1">　　生年月日：　<input type="text" name="birth"></label>
    <label class="label1">　　電話：　<input type="text" name="phone_number"></label>
  
    <label class="label1">　　性別：　　<input type="checkbox" id="anId00" class="wskCheckbox"  name="sex[]" value="男性" />
    <label class="wskLabel label1 label2" for="anId00">男性　</label>
    <input type="checkbox" id="anId01" class="wskCheckbox" name="sex[]" value="女性"/>
    <label class="wskLabel label1 label2" for="anId01">女性　</label>
    </label>
    
    <?php include("main.html");?>

    <br><input type="submit" value="送信" class="btn-square-shadow" >

    </fieldset>
    </div>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
