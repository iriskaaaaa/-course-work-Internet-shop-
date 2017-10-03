<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="windows-1251" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />    
	<title>Интернет-магазин WG</title>
</head>

<body>

<div id="body">
<div id="content">
<div id="content-in">


<?php
	include("include/footer.php");
    
    if($_COOKIE["pass"]!=="password"){ 
  sleep(1);
  if(isset($_POST["pass"])){
    setcookie("pass",$_POST["pass"], time()+3600*24*14);
    die("Обновите страницу");
  }
?>
<html><head><title>Админка</title></head><body>
<form method="post">
<input type="password" name="pass" value=""/>
<input type="submit" name="submit" value="Пароль"/>
</form></body></html>
<?php
  exit();
}
?>
</div>
</div>



</body>
</html>