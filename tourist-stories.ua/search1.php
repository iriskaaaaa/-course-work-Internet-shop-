<?php
session_start();
if($_SESSION['auth_admin']=="yes_auth"){
    

	if(isset($_GET["logout"]))
    {
	   unset($_SESSION['auth_admin']);//уничтожаем сессию
       header("Location:login.php");
	}
    $_SESSION['urlpage']="<a href='index.php'>√лавна€</a> \ <a href='tovar.php'>“овары</a>";
    include("include/db_connect.php");
    mysql_query("SET NAMES 'cp1251'");
    
    $search=$_GET["q"];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>ѕанель управлени€</title>
</head>

<body>
<div id="block-body">
<?php
	include("include/block-header.php");
    $all_count=mysql_query("SELECT * FROM product WHERE title LIKE '%$search%' OR description LIKE '%$search%'",$link);
    $all_count_result=mysql_num_rows($all_count);
?>
<div id="block-content">
<div id="block-param">
<form id="search" name="search" action="search.php?q=" method="GET">
<input type="text" name="q" />
<input type="submit" name="submit-search" value="»скать"/>
</form>
</div>
<div id="block-info">
<p id="count-style">¬сего товаров - <strong><?php echo $all_count_result?></strong></p>
<p id="knopka-add"><a href="add-product.php">ƒобавить товар</a></p>
</div>
<ul id="block-tovar">
<?php
	$num=9;//сколько выводить товаров на страницу
    $page=(int)$_GET['page'];
    $count=mysql_query("SELECT COUNT(*) FROM product WHERE title LIKE '%$search%' OR description LIKE '%$search%'",$link);
    $temp=mysql_fetch_array( $count);
    $post=$temp[0];
    //находим общее число страниц
    $total = (($post-1)/$num)+1;
    $total=intval($total);
    //определ€ем начало сообщений дл€ текущей тсраницы
    $page=intval($page);
    //если значение  $page меньше или отрицательно
    // переходим на первую страницу
    //а если слишком большое, то переходим на последнюю
    if(empty($page) or $page<0)$page=1;
    if($page>$total)$page=$total;
    //вычисл€ем начина€ с какого номера следует выводить сообщени€
    $start=$page*$num-$num;
    
    if($temp[0]>0){
        $result=mysql_query("SELECT * FROM product  WHERE title LIKE '%$search%' OR description LIKE '%$search%' ORDER BY id_product  DESC LIMIT $start, $num",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do{
                    if  (strlen($row['image']) > 0 && file_exists("../upload/".$row["image"]))
               {
            $img_path = '../upload/'.$row["image"];
            $max_width=160;
            $max_height=160;
            list($width,$height)=getimagesize($img_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio=min($ratioh,$ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
    }
    else
{
$img_path = "/images/no-image.png";
$width = 120;
$height = 160;
}
    echo'
    <li>
    <p>'.$row['title'].'</p>
    <center>
    <img src="'.$img_path.' "width="'.$width.' "height="'.$height.'"/>
    </center>
    <p align="center" class="link-action" >
    <a class="green" href="edit_product1.php?id_product='.$row['id_product'].'">»зменить</a> | <a href="delete_product.php?id_product='.$row['id_product'].'" class="delete" >”далить</a>
    </p>
    </li> 
    '; 
    } while ($row = mysql_fetch_array($result));
   
 
} 
}  

if ($page != 1){ $pstr_prev = '<li><a class="pstr-prev" href="search.php?q='.$search.'&?page='.($page - 1).'">&lt;</a></li>';}
if ($page != $total) $pstr_next = '<li><a class="pstr-next" href="search.php?q='.$search.'&page='.($page + 1).'">&gt;</a></li>';

// Ќаходим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="search.php?q='.$search.'&page='.($page - 5).'">'.($page - 5).'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="search.php?q='.$search.'&page='.($page - 4).'">'.($page - 4).'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="search.php?q='.$search.'&page='.($page - 3).'">'.($page - 3).'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="search.php?q='.$search.'&page='.($page - 2).'">'.($page - 2).'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="search.php?q='.$search.'&page='.($page - 1).'">'.($page - 1).'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="search.php?q='.$search.'&page='.($page + 5).'">'.($page + 5).'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="search.php?q='.$search.'&page='.($page + 4).'">'.($page + 4).'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="search.php?q='.$search.'&page='.($page + 3).'">'.($page + 3).'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="search.php?q='.$search.'&page='.($page + 2).'">'.($page + 2).'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="search.php?q='.$search.'&page='.($page + 1).'">'.($page + 1).'</a></li>';

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="search.php?q='.$search.'&page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}
   
?>
<div id="footerfix"></div>
<?php
	if ($total > 1)
{
    echo '
    <center>
    <div id="pstrnav">
    <ul>   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='search.php?q='.$search.'&page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </center>   
    </ul>
    </div>
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
   
    '
