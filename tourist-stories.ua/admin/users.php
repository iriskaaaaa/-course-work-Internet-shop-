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

  $_SESSION['urlpage'] = "<a href='index.php' >Главная</a> \ <a href='history_admin.php' >Пользователи</a>";
  
  include("include/functions.php"); 
   
    $id = clear_string($_GET["id"]);    
    $sort = $_GET["sort"];
	
   switch ($sort) {

	    case 'accept':

	    $sort = " where user.block='1'" ;
        $sort_name = 'Проверенные';

	    break;

	    case 'no-accept':

	    $sort = "where user.block='0'";
        $sort_name = 'Не проверенные';

	    break;
        
        
        case 'complaint-desc':

	    $sort = "order by user.count_complaint DESC";
        $sort_name = 'По уменьшению количества жалоб';

	    break;
        
        case 'complaint-asc':

	    $sort = "order by user.count_complaint ASC ";
        $sort_name = 'По возростанию количества жалоб';

	    break;
        
	    default:
        
        $sort = "";
        $sort_name = 'Без сортировки';
        
	    break;

	} 
    
               
$action = $_GET["action"];
if (isset($action))
{

   switch ($action) {

	    case 'accept':

   if ($_SESSION['accept_reviews'] == '1')
   {

        $update = mysql_query("UPDATE reviews SET moderat='1' WHERE id_reviews = '$id'",$link);  
    
   }
   else
   {
      $msgerror = 'У вас нет прав на одобрение отзывов!';
   }		   
	    break;
        
        case 'delete':
   if ($_SESSION['delete_reviews'] == '1')
   {

        $delete = mysql_query("DELETE FROM reviews WHERE id_reviews = '$id'",$link);      
       
   }   else
   {
      $msgerror = 'У вас нет прав на удаление отзывов!';
   }
	    break;
        
	} 
    
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
    
 $all_count = mysql_query("SELECT * FROM user",$link);
 $all_count_result = mysql_num_rows($all_count);

 $no_accept_count = mysql_query("SELECT * FROM user WHERE user.block = '1'",$link);
 $no_accept_count_result = mysql_num_rows($no_accept_count); 
?>
<div id="block-content">
<div id="block-parameters">
<ul id="options-list">
<li>Сортировать</li>
<li><a id="select-links" href="#"><? echo $sort_name; ?></a>
<ul id="list-links-sort">
<li><a href="users.php?sort=no-accept">Не заблокированные</a></li>
<li><a href="users.php?sort=accept">Заблокированные</a></li>
<li><a href="users.php?sort=complaint-desc">По уменьшению количества жалоб</a></li>
<li><a href="users.php?sort=complaint-asc">По возрастанию количества жалоб</a></li>
</ul>
</li>
</ul>
</div>
<div id="block-info">
<ul id="review-info-count">
<li>Всего пользователей - <strong><?php echo $all_count_result; ?></strong></li>
<li>Заблокированные - <strong><?php echo $no_accept_count_result; ?></strong></li>
</ul>
</div>
<?php
if (isset($msgerror)) echo '<p id="form-error" align="center">'.$msgerror.'</p>';

    $num = 15;
    $page = strip_tags($_GET['page']);              
    $page = mysql_real_escape_string($page);

$count = mysql_query("SELECT COUNT(*) FROM user",$link);
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

echo'
<table class="table table-striped">
<tr>
    <td>Пользователь</td>
    <td>Количество историй</td>
    <td>Количество жалоб</td>
    <td>Статус</td>
</tr>';
 
    if($temp[0]>0){
        $result=mysql_query("SELECT * FROM user $sort LIMIT $start, $num",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do{
                $id_user=$row['id_user'];
             if($row['block']==0){
                $moderat="Не заблокирован";
                $class="green";
 
             }
             if($row['block']==1){
                $moderat="Заблокирован";
                $class="red";
             }
             
            $count1 = mysql_query("Select COUNT(story.id_story) from story, user where story.id_user=user.id_user and user.id_user=$id_user;",$link);
                           $temp1=mysql_fetch_array($count1);
                           $count_publication=$temp1[0];
    echo'
<tr>

    <td><a href="inf_user.php?id_user='.$row['id_user'].'">'.$row['username'].'</a></td></a> 
    <td>'.$count_publication.'</td>
    <td>'.$row['count_complaint'].'</td>
    <td class="'.$class.'">'.$moderat.'</td>
   
</tr>';
    } while ($row = mysql_fetch_array($result));
}
}
   echo '</table>';


if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="users.php?'.$url.'page='. ($page - 1) .'" />&laquo;</a></li>';

if ($page != $total) $nextpage = '<li><a class="pstr-next" href="users.php?'.$url.'page='. ($page + 1) .'"/>&raquo;</a></li>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="users.php?'.$url.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="users.php?'.$url.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="users.php?'.$url.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="users.php?'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="users.php?'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="users.php?'.$url.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="users.php?'.$url.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="users.php?'.$url.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="users.php?'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="users.php?'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="users.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}

	if ($total > 1)
{
    echo '
    <ul class="pagination mypagination">   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='users.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
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