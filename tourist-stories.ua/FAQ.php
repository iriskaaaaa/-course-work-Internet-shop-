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
    $id = ($_GET["id_user"]);
	if(isset($_GET["logout"]))
    {
       unset($_SESSION['session_username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    }
include ("/include/db_connect.php");
include ("/include/functions.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
$sorting=$_GET["sort"];
switch($sorting){
        case 'popular-acs';
        $sorting='count_like ASC';
        break;
        
        case 'popular-desc';
        $sorting='count_like DESC';
        break;
        
        case 'date-acs';
        $sorting='date ASC';
        break;
        
        case 'date-desc';
        $sorting='date DESC';
        break;
        
        default:
        $sorting='id_story DESC';
        break;
    } 

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />

	<title>Tourist Stories</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css"/>

	<link rel="stylesheet" href="css/style1style.css" />
	<link rel="stylesheet" href="css/media.css" />
	<link rel="stylesheet" href="css/fonts.css" />
    <script type="text/javascript" src="js/shop-script.js"></script>

</head>

<body>

 <?php include ("/include/headerr.php"); ?>

<div class="container-fluid text-center">    
  	<div class="row content">
    	<div class="col-sm-2 sidenav">
</div>
  

    	
        
		
   		 <div class="col-sm-8 contain">
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">Вопрос - ответ</p>
    	    </div>

		<div class="line1"></div>
		<div class="line2"></div>

  		<strong><p>Каким критериям должна соответствовать история, чтоб пройти модерацию?</p></strong>
        <p>Ваша история должна соответствовать:</p>
        <ul>
        <li>История не должна содержать нецензурной лексики</li>
        <li>История должна соответствовать названию истории</li>
        <li>История не должна иметь рекламное содержание</li>
        </ul>
        
        <strong><p>Какие причины блокировки пользователя?</p></strong>
        <p>Если Ваша личный профиль заблокирован, то на Ваши комментарии к историям поступало много жалоб:</p>
        
            <?php

if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="index.php?'.$url.'page='. ($page - 1) .'" />&laquo;</a></li>';

if ($page != $total) $nextpage = '<li><a class="pstr-next" href="index.php?'.$url.'page='. ($page + 1) .'"/>&raquo;</a></li>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="index.php?'.$url.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="index.php?'.$url.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="index.php?'.$url.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="index.php?'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="index.php?'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="index.php?'.$url.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="index.php?'.$url.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="index.php?'.$url.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="index.php?'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="index.php?'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="index.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}

	if ($total > 1)
{
    echo '
    <ul class="pagination">   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='index.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </ul>
    ';
} 
?>

      
   </div>

    <div class="col-sm-2 sidenav">
    </div>
</div>
</div>



<footer class="container-fluid text-center">
<div class="top_line"></div>
<a href="FAQ.php">FAQ</a>
<span class="glyphicon glyphicon-copyright-mark"> Designed by Ira Klinkova</span>
</footer>


<script src="libs/jquery/jquery-2.1.4.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>

<script src="js/common.js"></script>

	
</body>
</html>