<?php
session_start();
define('tourist-stories',true);

if ($_SESSION['auth_admin'] == "yes_auth")
{
   
include ("include/db_connect1.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='history_admin.php' >Отзывы</a>";
  
  include("include/functions.php"); 
   
    $id = clear_string($_GET["id"]);    
    $sort = $_GET["sort"];
	
   switch ($sort) {

	    case 'accept':

	    $sort = "AND reviews.moderat = '1'" ;
        $sort_name = 'С жалобой';

	    break;

	    case 'no-accept':

	    $sort = "AND reviews.moderat = '0'";
        $sort_name = 'Опубликованные';

	    break;
        
	    default:
        
        $sort = "ORDER BY id_reviews DESC";
        $sort_name = 'Без сортировки';
        
	    break;

	} 
    
               
$action = $_GET["action"];
if (isset($action))
{
/**

 *    switch ($action) {

 * 	    case 'accept':

 *    if ($_SESSION['accept_reviews'] == '1')
 *    {

 *         $update = mysql_query("UPDATE reviews SET moderat='1' WHERE id_reviews = '$id'",$link);  
 *     
 *    }
 *    else
 *    {
 *       $msgerror = 'У вас нет прав на одобрение отзывов!';
 *    }		   
 * 	    break;
 *         
 *         case 'delete':
 *    if ($_SESSION['delete_reviews'] == '1')
 *    {

 *         $delete = mysql_query("DELETE FROM reviews WHERE id_reviews = '$id'",$link);      
 *        
 *    }   else
 *    {
 *       $msgerror = 'У вас нет прав на удаление отзывов!';
 *    }
 * 	    break;
 *         
 * 	} 
 *     
 */
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<meta http-equiv="content-type" content="text/html; />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script> 
    <script type="text/javascript" src="js/script.js"></script> 

    
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css"/>
    
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Панель Управления - Отзывы</title>
</head>
<body>
<div id="block-body">
<?php
	include("include/block-header.php");
    
 $all_count = mysql_query("SELECT * FROM reviews",$link);
 $all_count_result = mysql_num_rows($all_count);

 $no_accept_count = mysql_query("SELECT * FROM reviews WHERE reviews.moderat = '1'",$link);
 $no_accept_count_result = mysql_num_rows($no_accept_count); 
?>
<div id="block-content">
<div id="block-parameters">

<ul id="options-list">
<li>Сортировать</li>
<li><a id="select-links" href="#"><? echo $sort_name; ?></a>
<ul id="list-links-sort">
<li><a href="reviews.php?sort=accept">C жалобой</a></li>
<li><a href="reviews.php?sort=no-accept">Опубликованные</a></li>
</ul>
</li>
</ul>
</div>
<div id="block-info">
<form id="search" name="search" action="searchr.php?q=" method="GET">
<input type="text" name="q" />
<input type="submit" name="submit-search" value="Искать"/>
</form>
<ul id="review-info-count">
<li>Всего отзывов - <strong><?php echo $all_count_result; ?></strong></li>
<li>Отзывы  с жалобой - <strong><?php echo $no_accept_count_result; ?></strong></li>
</ul>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

    $num = 15;
    $page = strip_tags($_GET['page']);              
    $page = mysql_real_escape_string($page);

$count = mysql_query("SELECT COUNT(*) FROM reviews",$link);
$temp = mysql_fetch_array($count);
$post = $temp[0];
// Находим общее число страниц
$total = (($post - 1) / $num) + 1;
$total =  intval($total);
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
// Вычисляем начиная с какого номера
// следует выводить сообщения
$start = $page * $num - $num;
 
    if($temp[0]>0){
        $result=mysql_query("SELECT * FROM reviews, user wHERE reviews.id_user=user.id_user $sort LIMIT $start, $num",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do{
                echo'
     <div class="block-reviews">
 <div class="block-title-img">
 <p>NAme story</p>
 </div> 
<p class="author-date"><strong><a href="inf_user.php?id_user='.$row["id_user"].'">'.$row["username"].'</a></strong>, '.$row["date"].'</p>
<p class="reviews-comment" >'.$row["comment"].'</p>          
 <p class="links-actions" align="right" >
 ';
 if($row["moderat"]==1){
    echo'
 <a class="green1" href="reviews-add.php?id_reviews='.$row["id_reviews"].'" >Опубликовать</a> |<a class="delete" href="delete_reviews.php?id_reviews='.$row["id_reviews"].'" >Удалить</a></p>
 </div>';}
 if($row["moderat"]==0){
    echo'
 <a class="delete" href="delete_reviews.php?id_reviews='.$row["id_reviews"].'" >Удалить</a></p>
 </div>';}
    } while ($row = mysql_fetch_array($result));
}
}
   


if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="reviews.php?'.$url.'page='. ($page - 1) .'" />&laquo;</a></li>';

if ($page != $total) $nextpage = '<li><a class="pstr-next" href="reviews.php?'.$url.'page='. ($page + 1) .'"/>&raquo;</a></li>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="reviews.php?'.$url.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="reviews.php?'.$url.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="reviews.php?'.$url.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="reviews.php?'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="reviews.php?'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="reviews.php?'.$url.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="reviews.php?'.$url.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="reviews.php?'.$url.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="reviews.php?'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="reviews.php?'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="reviews.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}

	if ($total > 1)
{
    echo '
    <ul class="pagination mypagination">   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='reviews.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </ul>
    ';
} 
    	    
?>
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