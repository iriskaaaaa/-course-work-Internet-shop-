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
       if(!empty($_POST['email'])) {
    $email=$_POST['email'];
    
  
    $query =mysql_query("SELECT * FROM user WHERE email='".$email."'");

    $numrows=mysql_num_rows($query);
    if($numrows!=0)

    {
    while($row=mysql_fetch_assoc($query))
    {
    $dbpass=$row['pass'];
    $to  = $email ; 

    $subject = "Восстановление пароля"; 

    $message = ' 
        <html> 
          <head> 
              <title>Восстановление пароля</title> 
          </head> 
              <body> 
                  <p>Здравствуйте, Ваш пароль '.$dbpass.'</p> 
              </body> 
        </html>'; 

    $headers  = "Content-type: text/html; charset= utf-8 \r\n"; 
    $headers .= "From: Tourist Stories <iklinkova@yandex.ua>\r\n";  

    mail($to, $subject, $message, $headers); 
    }
    }
            else{
                $msgerror="За данным почтовым ящиком не закреплен ни один аккаунт! Введите другой email";
            }     
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

 <form method="post" class="form-horizontal">
  <?php
	if($msgerror){
	   echo'<p id="msgerror">'.$msgerror.'</p>';
	}
?>
 <span class="heading">Восстановление пароля</span>
 <div class="form-group">
 <input type="email" class="form-control" id="email"  name="email" placeholder="Введите свой email"/>
 <i class="fa fa-user"></i>
 </div>
 <div class="form-group">
<p><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Восстановить"/></p>
 <span class="text">На ваш email придет сообщение с паролем </span>

 </div>
 </form>
 </div>

 </div><!-- /.row -->
</div><!-- /.container -->

</body>
</html>