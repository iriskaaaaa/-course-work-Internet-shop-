<?php
// Вывод заголовка с данными о кодировке страницы
header('Content-Type: text/html; charset=utf-8');
// Настройка локали
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
// Настройка подключения к базе данных
//mysql_query('SET names "utf8"');

	session_start();
    define('tourist_stories_db',true);
    include ("include/db_connect.php");
    include ("include/functions.php");
     
    
    if($_POST["submit-enter"]){
       if(!empty($_POST['username']) && !empty($_POST['pass'])) {
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $pass=md5($pass);

    $query =mysql_query("SELECT * FROM user WHERE username='".$username."' AND pass='".$pass."'");

    $numrows=mysql_num_rows($query);
    if($numrows!=0)

    {
    while($row=mysql_fetch_assoc($query))
    {
    $dbusername=$row['username'];
    $dbpass=$row['pass'];
    $id=$row['id_user'];
    $block=$row['block'];
    }
    if($block==1){
        $msgerror="Ваш профиль заблокирован администратором";
        }else{
    if($username == $dbusername && $pass == $dbpass )

    { 

    $_SESSION['session_id_user']=$id;
    $_SESSION['session_username']=$username;
    
    /* Redirect browser */
    header("Location: index.php");
    
    }
    }}
            else{
                $msgerror="Неверный логин и(или) пароль.";
            }
        }
        else{
            $msgerror="Заполните все поля!";
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
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

 <form method="post" class="form-horizontal">
  <?php
	if($msgerror){
	   echo'<p id="msgerror">'.$msgerror.'</p>';
	}
?>
 <span class="heading">АВТОРИЗАЦИЯ</span>
 <div class="form-group">
 <input type="text" class="form-control" id="username"  name="username" placeholder="Введите свой логин"/>
 <i class="fa fa-user"></i>
 </div>
 <div class="form-group help">
 <input type="password" class="form-control" id="pass" name="pass" placeholder="Введите пароль"/>
 <i class="fa fa-lock"></i>
 </div>
 <div class="form-group">
<p><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Войти"/></p>
 <span class="text">Нет аккаунта?<a href="Reg3.php"> Зарегестрируйтесь</a></span>
 <span class="text">Забыли пароль?<a href="Pass.php"> Восстановите пароль</a></span>

 </div>
 </form>
 </div>

 </div><!-- /.row -->
</div><!-- /.container -->

</body>
</html>