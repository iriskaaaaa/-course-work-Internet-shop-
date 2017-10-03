<?php
session_start();
if($_SESSION['auth_login']=="yes_auth"){

	if(isset($_GET["logout"]))
    {
	   unset($_SESSION['auth_login']);
       unset($_SESSION['username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    }
	include("include/db_connect.php");
    $sorting=$_GET["sort"];
    mysql_query("SET NAMES 'cp1251'");
    session_start();
    
    switch($sorting){
        case 'price-asc';
        $sorting='price ASC';
        break;
        
        case 'price-desc';
        $sorting='price DESC';
        break;
        
        default:
        $sorting='id_product DESC';
        break;
    }
   
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="windows-1251" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />    
	<title>Интернет-магазин WG</title>
</head>
<body>
<div id="body">
<?php
	include("include/header.php");
 
?>
<div id="content">
<div id="content-in">
<ul id="sort">
<li>Сортировать:</li>
<li><a href="Zarubka-Light.php?sort=price-desc">От дорогих к дешовым</a></li>
<li><a href="Zarubka-Light?sort=price-asc">От дешовых к дорогим</a></li>
</li>
</ul>
<div id="tovar1">

<?php
	$result=mysql_query("SELECT * FROM product WHERE brand='Zarubka-Light' ORDER BY $sorting",$link);
     
    if (mysql_num_rows($result)>0)//найдены ли какие-то товары в таблице
    {
        $row=mysql_fetch_array($result);
            do{
                    if  (strlen($row['image']) > 0 && file_exists("upload/".$row["image"]))
               {
            $img_path = 'upload/'.$row["image"];
            $max_width=300;
            $max_height=300;
            list($width,$height)=getimagesize($img_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio=min($ratioh,$ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
    }
    else
{
$img_path = "../images/no-image.png";
$width = 300;
$height = 300;
}
        
            echo' 
            <a href="about-product.php?id_product='.$row['id_product'].'" class="tovar_href" >
            <li>
            <div class="block-images-grid">
            <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
            </div>
            <p class="title-grid"><a href="">'.$row["title"].'</a></p>
            <p class="price-grid"><strong>'.$row["price"].'</strong> грн.</p>
            </li>
            </a>
            ';
        }
         while($row = mysql_fetch_array($result));
         }
    
    
?>
</div>
</div>
</div>
<?php
	include("include/footer.php");
?>
</div>
</body>
</html>

