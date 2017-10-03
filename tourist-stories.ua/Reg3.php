<?php
 header("Content-type: text/html; charset=utf-8");

session_start();
    define('tourist_stories_db',true);
      if($_POST["submit-enter"]){
        
             if (!$_POST['email']) { 
                 $error[] = "Укажите свой email";
                 } else{$email = $_POST['email']; }

            if (!$_POST['username']) { 
                 $error[] = "Укажите свой логин";
                 } else{$username = $_POST['username']; }


            if (!$_POST['pass'] || $_POST['pass'] != $_POST['pass_control']){ 
                $error[] = "Укажите одинаковые пароли";
                    } else{$pass = $_POST['pass']; }
                    
if($_POST['check'] == 'YES'){
    $access_to_email = 1;
} else{
    $access_to_email = 0;
}

$username = htmlspecialchars($username);
$email = htmlspecialchars($email);
$pass = htmlspecialchars($pass); 

$username = stripslashes($username); 
$email = stripslashes($email);   
$pass = stripslashes($pass); 

$username = trim($username); 
$email = trim($email); 
$pass = trim($pass); 

//Шифрование пароля 
$pass = md5($pass); 



include ("include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
//mysql_query("/*!40101 SET NAMES 'cp1251' */") or die("Error: " . mysql_error());

$result = mysql_query("SELECT email FROM user WHERE email = '$email'", $link); 
@$myrow = mysql_fetch_array($result); 
if(!empty($myrow['email'])) { 
$error[]="Извините, введённый вами email уже зарегистрирован. Введите другой email."; 
}   


$result = mysql_query("SELECT id_user FROM user WHERE username = '$username'", $link); 
@$myrow = mysql_fetch_array($result); 
if(!empty($myrow['id_user'])) { 
$error[]="Извините, введённый вами логин уже зарегистрирован. Введите другой логин."; 
}   

if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }
else{ mysql_query("INSERT INTO user(username, email, block, access_to_email, pass, image, about_me) VALUES('$username', '$email',0, $access_to_email, '$pass', NULL, 'history')"); 

$_SESSION['message'] = "<p id='form-success'>Вы успешно зарегестрированы!</p>";
      $id = mysql_insert_id();

}
 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />

  <title>Tourist Stories</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css"/>

  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="css/media.css" />
  <link rel="stylesheet" href="css/fonts.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>

      <script src="libs/jquery/jquery-2.1.4.min.js"></script>
      <script src="libs/bootstrap/js/bootstrap.min.js"></script>
      <script src="js/common.js"></script>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


</head>

<body>
<div class="container">
 <div class="row">
<div class="collapse navbar-collapse navbar-right" id="top_menu">
 					<ul class="menu">
 						<li><a href="index.php">Главная</a></li>
 					</ul>

 				</div>
 <div class="col-md-offset-3 col-md-6">

 <form class="form-horizontal" method="post">
  <?php

		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}
  
?>
 <span class="heading">Регистрация</span>
 <div class="form-group">
 <input type="text" class="form-control" id="username" name="username" placeholder="Введите логин"/>
 <i class="fa fa-user"></i>
 </div>
 <div class="form-group">
 <input type="email" class="form-control" id="email" name="email" placeholder="Введите E-mail"/>

 </div>

 <div class="form-group">
 <input type="password" class="form-control" id="pass" name="pass" placeholder="Введите пароль"/>

 </div>
 
 <div class="form-group">
 <input type="password" class="form-control" id="pass_control" name="pass_control" placeholder="Подтвердите пароль"/>
 
 </div>

 <div class="form-group">
<div class="main-checkbox">
 <input type="checkbox" value="YES" id="checkbox1" name="check"/>
 <label for="checkbox1"></label>
 </div>
 <span class="text">Разрешить другим пользователям видеть Ваш email?</span>

<p><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Зарегистрироваться"/></p>


 </div>
 </form>
 </div>

 </div><!-- /.row -->
</div><!-- /.container -->

</body>
</html>