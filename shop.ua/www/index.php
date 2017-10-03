<?php
session_start();
if($_SESSION['auth_login']=="yes_auth"){

	if(isset($_GET["logout"]))
    {
	   unset($_SESSION['auth_login']);
       unset($_SESSION['username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    }
?>
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
<?php
	include("include/header.php");
 
?>
<div id="content">
<div id="content-in">
<ul>
<li><a href="air.php"><img src='images/model/air2.png'
    onmouseover="this.src='images/model/air1.png'"
    onmouseout="this.src='images/model/air2.png'"/><p>AIR</p></a></li>
<li><a href="Black-Swan.php"><img src="images/model/black-swan.png" 
    onmouseover="this.src='images/model/black-swan1.png'"
    onmouseout="this.src='images/model/black-swan.png'"/><p>BlACK-SWAN</p></a></li>
<li><a href="chic.php"><img src="images/model/chic.png" 
    onmouseover="this.src='images/model/chic1.png'"
    onmouseout="this.src='images/model/chic.png'"/><p>CHIC</p></a></li>
<li><a href="classic.php"><img src="images/model/classic.png" 
    onmouseover="this.src='images/model/classic1.png'"
    onmouseout="this.src='images/model/classic.png'"/><p>CLASSIC</p></a></li>
<li><a href="Ping-Pong.php"><img src="images/model/ping-pong.png" 
    onmouseover="this.src='images/model/ping-pong1.png'"
    onmouseout="this.src='images/model/ping-pong.png'"/><p>PING PONG</p></a></li>
<li><a href="StyleW.php"><img src="images/model/style-w.png" 
    onmouseover="this.src='images/model/style-w1.png'"
    onmouseout="this.src='images/model/style-w.png'"/><p>STYLE W</p></a></li>
<li><a href="zarubka.php"><img src="images/model/zarubka.png" 
    onmouseover="this.src='images/model/zarubka1.png'"
    onmouseout="this.src='images/model/zarubka.png'"/><p>ZARUBKA</p></a></li>
<li><a href="Zarubka-Light.php"><img src="images/model/zarubka-light.png" 
    onmouseover="this.src='images/model/zarubka-light1.png'"
    onmouseout="this.src='images/model/zarubka-light.png'"/><p>ZARUBKA LIGHT</p></a></li>
<li><a href="venecia.php"><img src="images/model/venecia.png" 
    onmouseover="this.src='images/model/venezia1.png'"
    onmouseout="this.src='images/model/venecia.png'"/><p>VENECIA</p></a></li>
</ul>
</div>
</div>
<?php
	include("include/footer.php");
?>
</div>



</body>
</html>