<?php
	session_start();
    define('my_shop',true);
    include('include/db_connect.php');
    include('include/functions.php');
    
    if($_POST["submit-enter"]){
        $login=clear_string($_POST["login"]);
        $pass=clear_string($_POST["pass"]);
        
        if($login && $pass){//если не пусты
            $pass=md5($pass);
            $result=mysql_query("CALL auth('$login', '$pass')",$link);
            
            if(mysql_num_rows($result)>0){
                $row=mysql_fetch_array($result);
                $_SESSION['auth_login']='yes_auth';
                $_SESSION['username']=$row['login'];
                header("Location: index.php");
                
            }
            else{
                $msgerror="Неверный логин и(или) пароль.";
            }
        }
        else{
            $msgerror="Заполните все поля!";
        }
        
    }
    
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="cp1251_general_ci" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style_reg.css" rel="stylesheet" type="text/css" />    
	<title>Интернет-магазин WG</title>
</head>

<body>

<div id="body">
    <div class="top">
        <a href="index.php" class="glavn">Вернуться на главную</a>
    </div>
<div id="block-pass-login">
<?php
	if($msgerror){
	   echo'<p id="msgerror">'.$msgerror.'</p>';
	}
?>
<form method="post">
<ul id="pass-login">
<li><label>Логин</label>
<input type="text" name="login"/></li>
<li><label>Пароль</label>
<input type="password" name="pass"/></li>
</ul>
<p><input type="submit" name="submit-enter" id="submit-enter" value="Вход"/></p>
</form>
</div>



</body>
</html>


