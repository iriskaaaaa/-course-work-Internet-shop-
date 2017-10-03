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
$sorting=$_GET["sort_city"];
$sorting=$_GET["sort_country"];
switch($sorting){
        case 'popular-acs';
        $sorting='ASC';
        break;
        
        case 'popular-desc';
        $sorting='DESC';
        break;

        default:
        $sorting_city='id_city DESC';
        $sorting='DESC';
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

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/media.css" />
	<link rel="stylesheet" href="css/fonts.css" />
    <script type="text/javascript" src="js/shop-script.js"></script>

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
                $id = $_SESSION['session_id_user'];
                $result=mysql_query("SELECT * FROM user WHERE id_user = $id",$link);
                $row=mysql_fetch_array($result);
                   echo '<ul class="menu">
 						<li><a href="index.php">Главная</a></li>
 						<li><a href="#">Рейтинги</a></li>
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

<div class="container-fluid text-center">    
  	<div class="row content">
    	<div class="col-sm-2 sidenav">
        </div>
        
		
   		 <div class="col-sm-8 contain">
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">Рейтинги</p>
      <!-- <button class="navbar-toggle collapsed menu_btn" data-toggle="collapse" data-target="#sort">
 						<span class="glyphicon glyphicon-menu-hamburger">	</span>	
 					</button> -->
    	    </div>
 
		<div class="line1"></div>
		<div class="line2"></div>
<p class="navbar-text text_sort">РЕЙТИНГ ГОРОДОВ</p>
<p class="navbar-text text_sort">Сортировать по:</p>
<ul class="nav navbar-nav sort" >
       			 <li class="dropdown">
         			 <a href="#" class="dropdown-toggle sort_a" data-toggle="dropdown">Популярности<b class="caret"></b></a>
         	 		<ul class="dropdown-menu">
            			<li><a href="rating.php?sort_city=popular-acs">Возрастание</a></li>
            			<li><a href="rating.php?sort_city=popular-desc">Убывание</a></li>
         	 		</ul>
       			 </li>
</ul><br/>
  		<table class="table table-striped">
<tr>
    <td>Номер в рейтинге</td>
    <td>Город</td>
    <td>Количество историй</td>
</tr>
            <?php
            $num=9;//сколько выводить товаров на страницу
    $page=(int)$_GET['page'];
    $count=mysql_query("SELECT COUNT(*) FROM city",$link);
    $temp=mysql_fetch_array($count);
    $post=$temp[0];
    //находим общее число страниц
    $total = (($post-1)/$num)+1;
    $total=intval($total);
    //определяем начало сообщений для текущей тсраницы
    $page=intval($page);
    //если значение  $page меньше или отрицательно
    // переходим на первую страницу
    //а если слишком большое, то переходим на последнюю
    if(empty($page) or $page<0)$page=1;
    if($page>$total)$page=$total;
    //вычисляем начиная с какого номера следует выводить сообщения
    $start=$page*$num-$num;
    echo'';
    if($temp[0]>0){
        $result=mysql_query("SELECT *, COUNT(city_in_story.id_story) AS 'count' from city, city_in_story WHERE city_in_story.id_city=city.id_city GROUP BY city.id_city ORDER BY count $sorting;",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            $i=1;
            do{
             $id=$row['id_city'];   
            $count1 = mysql_query("SELECT COUNT(city_in_story.id_story) from city, city_in_story where city.id_city=city_in_story.id_city and city_in_story.id_story AND city_in_story.id_city=$id;",$link);
            $temp1=mysql_fetch_array($count1);
            $count_city=$temp1[0];
            
    echo'
<tr>
    <td>'.$i.'</td>
    <td>'.$row['name_city'].'</td>
    <td>'.$count_city.'</td>
</tr>';
$i++;
    } while ($row = mysql_fetch_array($result));

   echo '</table>';
 

}
}  
echo'
<p class="navbar-text text_sort">РЕЙТИНГ СТРАН</p>
<p class="navbar-text text_sort">Сортировать по:</p>
<ul class="nav navbar-nav sort" >
       			 <li class="dropdown">
         			 <a href="#" class="dropdown-toggle sort_a" data-toggle="dropdown">Популярности<b class="caret"></b></a>
         	 		<ul class="dropdown-menu">
            			<li><a href="rating.php?sort_country=popular-acs">Возрастание</a></li>
            			<li><a href="rating.php?sort_country=popular-desc">Убывание</a></li>
         	 		</ul>
       			 </li>
</ul><br/>
<table class="table table-striped">
<tr>
    <td>Номер в рейтинге</td>
    <td>Страна</td>
    <td>Количество историй</td>
</tr>';
            $num=9;//сколько выводить товаров на страницу
    $page=(int)$_GET['page'];
    $count=mysql_query("SELECT COUNT(*) FROM country",$link);
    $temp=mysql_fetch_array($count);
    $post=$temp[0];
    //находим общее число страниц
    $total = (($post-1)/$num)+1;
    $total=intval($total);
    //определяем начало сообщений для текущей тсраницы
    $page=intval($page);
    //если значение  $page меньше или отрицательно
    // переходим на первую страницу
    //а если слишком большое, то переходим на последнюю
    if(empty($page) or $page<0)$page=1;
    if($page>$total)$page=$total;
    //вычисляем начиная с какого номера следует выводить сообщения
    $start=$page*$num-$num;
    echo'';
    if($temp[0]>0){
        $result=mysql_query("SELECT *, COUNT(city_in_story.id_story) AS 'count' from city, city_in_story, country WHERE city_in_story.id_city=city.id_city and city.id_country=country.id_country GROUP BY country.id_country ORDER BY count $sorting;",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            $i=1;
            do{
             $id=$row['id_country'];   
            $count1 = mysql_query("SELECT COUNT(city_in_story.id_story) AS 'count' from city, city_in_story, country WHERE city_in_story.id_city=city.id_city and city.id_country=country.id_country and country.id_country=$id;",$link);
            $temp1=mysql_fetch_array($count1);
            $count_city=$temp1[0];
            
    echo'
<tr>
    <td>'.$i.'</td>
    <td>'.$row['name_country'].'</td>
    <td>'.$count_city.'</td>
</tr>';
$i++;
    } while ($row = mysql_fetch_array($result));

   echo '</table>';
 

}
}  

echo'
<p class="navbar-text text_sort">РЕЙТИНГ АВТОРОВ</p>
<p class="navbar-text text_sort">Сортировать по:</p>
<ul class="nav navbar-nav sort" >
       			 <li class="dropdown">
         			 <a href="#" class="dropdown-toggle sort_a" data-toggle="dropdown">Популярности<b class="caret"></b></a>
         	 		<ul class="dropdown-menu">
            			<li><a href="rating.php?sort_country=popular-acs">Возрастание</a></li>
            			<li><a href="rating.php?sort_country=popular-desc">Убывание</a></li>
         	 		</ul>
       			 </li>
</ul><br/>
<table class="table table-striped">
<tr>
    <td>Номер в рейтинге</td>
    <td>Автор</td>
    <td>Количество историй</td>
</tr>';
            $num=9;//сколько выводить товаров на страницу
    $page=(int)$_GET['page'];
    $count=mysql_query("SELECT COUNT(*) FROM user",$link);
    $temp=mysql_fetch_array($count);
    $post=$temp[0];
    //находим общее число страниц
    $total = (($post-1)/$num)+1;
    $total=intval($total);
    //определяем начало сообщений для текущей тсраницы
    $page=intval($page);
    //если значение  $page меньше или отрицательно
    // переходим на первую страницу
    //а если слишком большое, то переходим на последнюю
    if(empty($page) or $page<0)$page=1;
    if($page>$total)$page=$total;
    //вычисляем начиная с какого номера следует выводить сообщения
    $start=$page*$num-$num;
    echo'';
    if($temp[0]>0){
        
        
        
        $row_number=0;
                                $sql  = mysql_query("SET @row_number = 0",$link);
        $result=mysql_query("Select *, (@row_number:=@row_number + 1) AS 'num' from ( Select user.id_user, user.username, COUNT(story.id_story) AS 'count' from story, user where story.id_user=user.id_user GROUP BY user.id_user ORDER BY count $sorting ) t",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            $i=1;
            do{
             $id=$row['id_user']; 
             $num_user=$row["num"]; 
            $count1 = mysql_query("SELECT COUNT(story.id_story) AS 'count' from story, user WHERE story.id_user= user.id_user and user.id_user=$id;",$link);
            $temp1=mysql_fetch_array($count1);
            $count_story=$temp1[0];
            
    echo'
<tr>
    <td>'.$num_user.'</td>
    <td>'.$row['username'].'</td>
    <td>'.$row["count"].'</td>
</tr>';
$i++;
    } while ($row = mysql_fetch_array($result));

   echo '</table>';
 

}
}  

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

<span class="glyphicon glyphicon-copyright-mark"> Designed by Ira Klinkova</span>
</footer>


<script src="libs/jquery/jquery-2.1.4.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>

<script src="js/common.js"></script>

	
</body>
</html>