<?php
define('tourist-stories', true);
session_start();
if($_SESSION['auth_admin']=="yes_auth"){
    

	if(isset($_GET["logout"]))
    {
	   unset($_SESSION['auth_admin']);//уничтожаем сессию
       header("Location:login.php");
	}
    $_SESSION['urlpage']="<a href='index.php'>Главна</a>";
    include("include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
    
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Панель управлени¤</title>
</head>

<body>
<div id="block-body">
<?php
	include("include/block-header.php");
?>
<div id="block-content">
<div id="block-param">
<p id="title-page">Общая статистика</p>
</div>
</div>
</div>

</body>
</html>
<?php
	}else
    {
        header("Location: login.php");
    }
?>
