<?php
// Вывод заголовка с данными о кодировке страницы
header('Content-Type: text/html; charset=utf-8');
// Настройка локали
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
// Настройка подключения к базе данных
//mysql_query('SET names "utf8"');

session_start();
define('tourist_stories_db',true);
if($_SESSION['session_username']){

	if(isset($_GET["logout"]))
    {
       unset($_SESSION['session_username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    } 
    
    if($_POST["submit-enter"]){
        
             if (!$_POST['name_city']) { 
                 $error[] = "Укажите название города";
                 } else{$name_city = $_POST['name_city']; }

            if (!$_POST['name_country']) { 
                 $error[] = "Укажите название страны";
                 } else{$name_country = $_POST['name_country']; }
                 

$name_city = htmlspecialchars($name_city);
$name_country = htmlspecialchars($name_country); 

$name_city = stripslashes($name_city); 
$name_country = stripslashes($name_country);   

$name_city = trim($name_city); 
$name_country = trim($name_country); 


include ("/include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");

//mysql_query("/*!40101 SET NAMES 'cp1251' */") or die("Error: " . mysql_error());
$result = mysql_query("SELECT id_city FROM city WHERE name_city = '$name_city'", $link); 
@$myrow = mysql_fetch_array($result); 
if(!empty($myrow['id_city'])) { 
$error[]="Извините, введённый вами город уже существует"; 
}
  
  if (count($error))
        {           
             $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
             
         }
  else{ 
         $result = mysql_query("SELECT * FROM country WHERE name_country = '$name_country'", $link); 
         @$myrow = mysql_fetch_array($result); 
             if(!empty($myrow['id_country'])) { 
                 $id_country=$myrow['id_country']; 
            } else{
                 mysql_query("INSERT INTO `country` ( `name_country`) VALUES ('$name_country')",$link); 
                 $id_country = mysql_insert_id();
                    }
         mysql_query("INSERT INTO `city` (`name_city`, `count_story`, `id_country`) VALUES ('$name_city', '0', '$id_country')",$link); 
         
         $_SESSION['message'] = "<p id='form-success'>Город успешно добавлен!</p>";
         

  }
      
       
 } 

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />

	<title>Tourist Stories</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css"/>
    
<!--<script src="https://yastatic.net/share2/share.js" async="async"></script>
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js" async="async"></script> -->
   
	<link rel="stylesheet" href="/css/style-historyform..css" />
	<link rel="stylesheet" href="/css/media.css" />
	<link rel="stylesheet" href="/css/fonts.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>


</head>

<body>
 <div class="header_history_form">
 	<nav>
 		<div class="container">
 			<div class="row">
 				<div class="navbar-header ">
 					<button class="navbar-toggle collapsed menu_btn" data-toggle="collapse" data-target="#top_menu">
 						<span class="glyphicon glyphicon-menu-hamburger">	</span>	
 					</button>

 					<a href="index.html">
 						<img src="" alt=""/>
 					</a>
 				</div>

        </div>
 				<div class="collapse navbar-collapse navbar-right" id="top_menu">
 				   <ul class="menu">
 						<li><a href="index.php">Главная</a></li>
 						<li><a href="#">Рейтинги</a></li>
 						<li><a href="login.php">Личный кабинет</a></li>
                        <li><a href="?logout">Выйти</a></li>
 				  	</ul>

 				</div>

 			</div>
 			</div>
 		</div>
 	</nav>
   </div>

<div class="container-fluid text-center">    
  	<div class="row content">
    	 <div class="col-sm-2 sidenav">
       </div>

   	 <div class="col-sm-8 contain">
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">Добавление города</p>
    	  </div>

		   <div class="line1"></div>
		   <div class="line2"></div>

<form  enctype="multipart/form-data" method="post" action="city.php">
  <?php

		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}

  
?>
  <div class="form-group">
    <label class="label_history" for="exampleInputEmail1">Название города</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name_city" placeholder="Введите название истории"/>
  </div>
  <div class="form-group">
    <label class="label_history" for="exampleInputEmail1">Название страны</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name_country" placeholder="Введите название страны"/>
  </div>

  <div class="form-group"> 
    <p class="button-create"><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Добавить"/></p>
  </div>
</form>
     </div>
    </div>
</div>

<footer class="container-fluid text-center">
<div class="top_line"></div>

<span class="glyphicon glyphicon-copyright-mark"> Designed by Ira Klinkova</span>
</footer>
      
    <script src="libs/jquery/jquery-2.1.4.min.js"></script>
	<script src="libs/bootstrap/js/bootstrap.min.js"></script>  
	<script src="js/common.js"></script>

	
</body>
</html>