<?php
// Вывод заголовка с данными о кодировке страницы
header('Content-Type: text/html; charset=utf-8');
// Настройка локали
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
// Настройка подключения к базе данных
//mysql_query('SET names "utf8"');

session_start();
define('tourist_stories_db',true);
if($_SESSION['session_username'] && $_SESSION['session_id_user']){
$id_user = $_SESSION['session_id_user'];
	if(isset($_GET["logout"]))
    {
       unset($_SESSION['session_username']);
       unset($_SESSION['session_id_user']);//уничтожаем сессию
       header("Location:index.php");
	}

    }
include ("/include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
$id = ($_GET["id_story"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />

	<title>Tourist Stories</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css"/>

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/media.css" />
	<link rel="stylesheet" href="css/fonts.css" />
    
    <script src="libs/jquery/jquery-2.1.4.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/js/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="js/js/shop-script.js"></script>
<link rel="stylesheet" type="text/css" href="http://tourist-stories.ua//fancybox/jquery.fancybox.css" />
<script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/js/jTabs.js"></script>


    
    

<script type="text/javascript">
$(document).ready(function() {
 
    $(".send-review").fancybox();
    //$(".send-bad").fancybox();
	
});	
</script> 


  <!-- Demo CSS -->
	<link rel="stylesheet" href="slider/flexslider.css" type="text/css" media="screen" />

	<!-- Modernizr -->
  <script src="slider/demo/js/modernizr.js"></script>




</head>

<body>


 <header>
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
                <div class="collapse navbar-collapse navbar-right" id="top_menu">
<?php

                if($_SESSION['session_username'] && $_SESSION['session_id_user'])
               {
                $id_user = $_SESSION['session_id_user'];
                $result=mysql_query("SELECT * FROM user WHERE id_user = $id_user",$link);
                $row=mysql_fetch_array($result);
                   echo '<ul class="menu">
 						<li><a href="index.php">Главная</a></li>
 						<li><a href="rating.php">Рейтинги</a></li>
 						<li><a href="profile.php?id_user='.$row['id_user'].'">Личный кабинет</a></li>
                        <li><a href="?logout">Выйти</a></li>
 				  	</ul>'; }
else{
 
  echo '<ul class="menu">
 						<li><a href="index.php">Главная</a></li>
 						<li><a href="#">Рейтинги</a></li>
 						<li><a href="login.php">Войти</a></li>
 					</ul>';   
    
}	
?>
     </div>           
 			</div>

 			<!-- <div class="top_line">
 				
 			</div> -->
 		</div>
 	</nav>

 	<div class="container">
 		<div class="row">
 			<div class="coll-md-8 coll-offset-2">
 				<div class="tittle_block">
 					<h1>Tourist Stories</h1>
 					<p class="tittle_block_text">Жизнь - это книга, кто не путешествует, тот читает только одну страницу!</p>
 				</div>
 			</div>
 		</div>
 	</div>
 </header>

<div class="container-fluid text-center-story">    
  	<div class="row content">
    	<div class="col-sm-2 sidenav">
    	</div>
		
   		 <div class="col-sm-8 contain">
         <?php
         	$result = mysql_query("Select * from story where id_story= $id;",$link);
            If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
$user_id=$row["id_user"];
if($user_id === NULL){
    $result = mysql_query("Select * from story, type_of_trip where story.id_type_of_story=type_of_trip.id_type_of_trip and story.id_story= $id;",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
      if  (strlen($row['image']) > 0 && file_exists("./upload/".$row["image"]))
               { 
            $image_path = "./upload/".$row['image'];
            $max_width=70;
            $max_height=70;
            list($width,$height)=getimagesize($image_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio=min($ratioh,$ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
            }
            else
            {
            $image_path = "/upload/no_ava.jpg"; 
            $width = 70;
            $height = 70;
            }
            
    if  (strlen($row['img']) > 0 && file_exists("./upload/".$row["img"]))
               {
            $img_path = "./upload/".$row['img'];
            }
            else
            {
            $img_path = "/upload/no_image.jpg";

            }
    
    echo '
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">'.$row["name_story"].'</p>
    	    </div>

		<div class="line1"></div>
		<div class="line2"></div>

    <section class="story">
      		<div class="story_block">
    <img src="'.$img_path.'" class="img-responsive" />
   	<div class="story_text">
        		<span>'.$row["text_story"].'</br></span>
                <p>Вид отдыха: '.$row["name_type"].'</p>';
$res1 = mysql_query("SELECT * from city, city_in_story where city.id_city=city_in_story.id_city and city_in_story.id_story= $id;",$link);
If (mysql_num_rows($res1) > 0)
{
$myrow1 = mysql_fetch_array($res1);
echo'<p class="city_story">Города:';
do

{ 
    echo'
    '.$myrow1["name_city"].'
    ';
 }while ($myrow1 = mysql_fetch_array($res1));
 echo'</p>';
 }        

 
                echo'
                <div class="block_like">
                <p id="like" uid="'.$id_user.'" sid="'.$row['id_story'].'">Нравится</p> <p class="glyphicon" id="likegoodcount"> '.$row['count_like'].' </p> </br>
                </div>
                <p class="glyphicon" > Дата публикации: '.$row['date'].'</p> </br>
                <p class="glyphicon">  Автор статьи неизвестен (к сожалению, автор удалил свой профиль)</p>
                </div>';
                
 
} while ($row = mysql_fetch_array($result));
}}} if(isset($user_id)){
    
	$result = mysql_query("Select * from story, user, type_of_trip where story.id_user=user.id_user and story.id_type_of_story=type_of_trip.id_type_of_trip and story.id_story= $id;",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
      if  (strlen($row['image']) > 0 && file_exists("./upload/".$row["image"]))
               { 
            $image_path = "./upload/".$row['image'];
            $max_width=70;
            $max_height=70;
            list($width,$height)=getimagesize($image_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio=min($ratioh,$ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
            }
            else
            {
            $image_path = "/upload/no_ava.jpg"; 
            $width = 70;
            $height = 70;
            }
            
    if  (strlen($row['img']) > 0 && file_exists("./upload/".$row["img"]))
               {
            $img_path = "./upload/".$row['img'];
            }
            else
            {
            $img_path = "/upload/no_image.jpg";

            }
    
    echo '
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">'.$row["name_story"].'</p>
    	    </div>

		<div class="line1"></div>
		<div class="line2"></div>

    <section class="story">
      		<div class="story_block">
    <img src="'.$img_path.'" class="img-responsive" />
   	<div class="story_text">
        		<p align="justify">'.nl2br($row["text_story"]).'</br></p>
                <p>Вид отдыха: '.$row["name_type"].'</p>';
$res1 = mysql_query("SELECT * from city, city_in_story where city.id_city=city_in_story.id_city and city_in_story.id_story= $id;",$link);
If (mysql_num_rows($res1) > 0)
{
$myrow1 = mysql_fetch_array($res1);
echo'<p class="city_story">Города:';
do

{ 
    echo'
    '.$myrow1["name_city"].'
    ';
 }while ($myrow1 = mysql_fetch_array($res1));
 echo'</p>';
 }            ?>
 


 <?php   
                echo'
                
                
                <div class="block_like">
                <p id="like" sid="'.$row['id_story'].'">Нравится</p> <p class="glyphicon" id="likegoodcount"> '.$row['count_like'].' </p> </br>
                </div>
        		<p class="glyphicon"> Дата публикации: '.$row['date'].'</p> </br>
                </div>
      		</div>
            </section>

    <section class="avtor">
        <div "class=media">
            <a "class=pull-left" href="view_profile.php?id_avtor='.$row['id_user'].'">
                 <img src="'.$image_path.'  "width="'.$width.' "height="'.$height.' "class="img-circle" "/>
             </a>
             <div "class=media-body">

                  <h5 "class=media-heading">Автор статьи: '.$row["username"].'</h5>
               ';
                
                
} while ($row = mysql_fetch_array($result));
}}

echo'
<div id="main" role="main">
      <section class="slider">
        <div class="flexslider">
          <ul class="slides">';
$result = mysql_query("SELECT * from story_img where id_story= $id;",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do{
    $image_path = "./upload/".$row['img_story'];
         
  echo'
  
  <li>
            
    <img src="'.$image_path.'"  />
       </li>';
  
} while ($row = mysql_fetch_array($result));
}
echo' 
  </ul>
        </div>
      </section>
      
          
    </div>';

?>
<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="none;" data-options="medium,square,line,horizontal,nocounter,sepcounter=1,theme=14" data-services="vkontakte,odnoklassniki,facebook,google,twitter"></div>
<?php
if(isset($id_user)){   
    echo       '
                <p id="link-send-review"><a class="send-review" href="#send-review">Написать комментарий</a></p>
               ';
    }else {
        echo       '
                <p id="link-send-review"><a class="send-review" href="login.php">Написать комментарий</a></p>
               ';
    }
                
                
                $query_reviews = mysql_query("SELECT * FROM reviews WHERE id_story='$id' AND moderat='0' ORDER BY id_reviews DESC",$link);

If (mysql_num_rows($query_reviews) > 0)
{
$row_reviews = mysql_fetch_array($query_reviews);
do
{
$reviews=$row_reviews["id_reviews"];
echo '
<div class="block-reviews" >
<p class="author-date" ><strong>'.$row_reviews["name"].'</strong>, '.$row_reviews["date"].', '.$reviews.'</p> 
<p class="text-comment">'.$row_reviews["comment"].'</p>
</div>';
if($row_reviews["id_user"]==$id_user){
    echo'
<p id="link-send-bad"><a class="send-bad" href="delete_reviews.php?id_reviews='.$row_reviews["id_reviews"].'&id_story='.$id.'">| Удалить</a></p>';
}
echo'
<p id="link-send-bad" rid="'.$reviews.'"><a class="send-bad" href="block_reviews.php?id_reviews='.$row_reviews["id_reviews"].'&id_story='.$id.'&id_user='.$row_reviews["id_user"].'">Пожаловаться</a></p>';

//<div id="send-bad" >
    //<p align="right" id="title-review">Выша жалоба будет рассмотрена модератором.</p>
   // <ul>     
   // <li><p align="right"><label id="label-comment" >Ваша жалоба<span>*</span></label><textarea id="comment_review" >'.$reviews.'</textarea></p></li>    
   // </ul>
   // <p id="reload-img"><img src="/img/loading.gif"/></p> <p id="button-send-bad" rid="'.$reviews.'"  ></p>  
   // </div>
//';
        
}
 while ($row_reviews = mysql_fetch_array($query_reviews));
}
else
{
    echo '<p class="title-no-info" >Отзывов нет</p>';
}
                
                echo'
      		</div>
            </section>

    
    '; 
 echo'
 

<div id="send-review" >
    
    <p align="right" id="title-review">Написание комментария.</p>
    
    <ul>
    <li><p align="right"><label id="label-name" >Имя<span>*</span></label><input maxlength="15" type="text"  id="name_review" /></p></li>     
    <li><p align="right"><label id="label-comment" >Комментарий<span>*</span></label><textarea id="comment_review" ></textarea></p></li>    
    </ul>
   <p id="reload-img"><img src="/img/loading.gif"/></p> <p id="button-send-review" iid="'.$id.'" user_id="'.$id_user.'" ></p>  
    </div>'; ?>



   </div>

    <div class="col-sm-2 sidenav">
      <section class="new_story">
      <p class="navbar-text text_sort">Новые истории</p>
<?php
        $result=mysql_query("SELECT * FROM `story` where moderat=1 ORDER BY date DESC limit 5;",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do
            {
                if  (strlen($row['img']) > 0 && file_exists("./upload/".$row["img"]))
                    {
                        $img_path = "/upload/".$row['img']; 

                    }
                 else
                    {
                        $img_path = "/upload/no_image.jpg"; 

                    }
             echo'
      	<div class="new_story_block">
      			
      			<a href="story.php?id_story='.$row['id_story'].'"><img src="'.$img_path.'" class="img-responsive" /></a>
      			<div class="example_text">
      			 <h5>'.$row['name_story'].'</h5>
        		<p>  Дата публикации:'.$row['date'].'</p>
          </div>
      	</div></br></br>';
        }while ($row = mysql_fetch_array($result));
        }
        ?>
       </section>


    </div>
</div>
</div>



<footer class="container-fluid text-center">
<div class="top_line"></div>

<span class="glyphicon glyphicon-copyright-mark"> Designed by Ira Klinkova</span>
</footer>


  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

  <!-- FlexSlider -->
  <script defer src="slider/jquery.flexslider.js"></script>

  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>



  <!-- Syntax Highlighter -->
  <script type="text/javascript" src="slider/demo/js/shCore.js"></script>
  <script type="text/javascript" src="slider/demo/js/shBrushXml.js"></script>
  <script type="text/javascript" src="slider/demo/js/shBrushJScript.js"></script>

  <!-- Optional FlexSlider Additions -->
  <script src="slider/demo/js/jquery.easing.js"></script>
  <script src="slider/demo/js/jquery.mousewheel.js"></script>
  <script defer src="slider/demo/js/demo.js"></script>
	
</body>
</html>