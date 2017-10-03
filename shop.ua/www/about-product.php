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
    mysql_query("SET NAMES 'cp1251'");
    $id = ($_GET["id_product"]);
   
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
<div id="tovar1">

<?php
	$result=mysql_query("SELECT * FROM product WHERE id_product='$id'",$link);
     
    if (mysql_num_rows($result)>0)//найдены ли какие-то товары в таблице
    {
        $row=mysql_fetch_array($result);
            do{
                    if  (strlen($row['image']) > 0 && file_exists("upload/".$row["image"]))
               {
            $img_path = 'upload/'.$row["image"];
            $max_width=400;
            $max_height=400;
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
$width = 300;
$height = 300;
}
        
            echo' 
            <p id="about_title">'.$row["title"].'</p>
            <div id="about-image">
            <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
            </div>
            <p id="about-price"><strong>'.$row["price"].'</strong> грн.</p>
            <p id="about-decsription">'.$row["description"].'</p>
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

