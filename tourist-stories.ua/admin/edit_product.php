<?php
session_start();
if($_SESSION['auth_admin']=="yes_auth"){
    define(my_shop,true);
	if(isset($_GET['logout']))
    {
	   unset($_SESSION['auth_admin']);//уничтожаем сессию
       header("Location:login.php");
	}
    $_SESSION['urlpage']="<a href='index.php'>Главная</a> \ <a href='tovar.php'>Товары</a>\ <a>Изменение товаров</a>";
    include("include/db_connect.php");
    mysql_query("SET NAMES 'cp1251'");
    $id = ($_GET["id_product"]);
    $action = ($_GET["action"]);
if (isset($action))
{
   switch ($action) {

	    case 'delete':
         
         if (file_exists("../upload/".$_GET["image"]))
        {
          unlink("../upload/".$_GET["image"]);  
        }
            
    break;
    }
    header("Location:tovar.php");
    }
    
    
     if($_POST['submit_add'])//проверка нажата ли кнопка
    {
         
      $error = array();
    
    // Проверка полей
        
       if (!$_POST["add_title"])//если существует
      {
         $error[]="Укажите название товара";
      }
      
       if (!$_POST['add_price'])
      {
         $error[] = "Укажите цену";
      }
      
       if (!$_POST['add_brand'])
      {
      $error[] = "Укажите категорию";
      }
      
      if (!$_POST['add_description'])
      {
         $error[] = "Укажите описание";
      }      
       
      if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";//implode из массива все перводит в строки 
            
       }
       else
       {
        $new="title='{$_POST["add_title"]}', price='{$_POST["add_price"]}', brand='{$_POST["add_brand"]}', 
              description='{$_POST["add_description"]}', count='{$_POST["add_count"]}'";
        $update=mysql_query("UPDATE product SET $new WHERE id_product='$id'",$link);
           
        $_SESSION['message'] = "<p id='form-success'>Товар успешно изменен!</p>";
        header("Location:tovar.php");
      
      if (empty($_POST['upload']))
      {        
      include("actions/upload-image.php");
    //  unset($_POST['upload']);           
      } 
      }}
      
        
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Панель управления</title>
</head>

<body>
<div id="block-body">
<?php
	include("include/block-header.php");
  
?>
<div id="block-content">
<div id="block-param">
</div>
<div id="block-info">
<p id="count-style">Изменение товара</p>

</div>
<?php
		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}
 ?>   
 <?php
	$result = mysql_query("SELECT * FROM product WHERE id_product='$id'",$link);
    
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
    
echo '

<form enctype="multipart/form-data" method="post">
<ul id="block-add">
<li>
<label>Название товара</label>
<input type="text" name="add_title" value="'.$row['title'].'"/></li>

<li>
<label>Цена</label>
<input type="text" name="add_price" value="'.$row['price'].'"/></li>

<li>
<label>Бренд</label>
<input type="text" name="add_brand" value="'.$row['brand'].'"/></li>

<li>
';
if  (strlen($row["image"]) > 0 && file_exists("../upload/".$row["image"]))
{
$img_path = '../upload/'.$row["image"];
$max_width = 110; 
$max_height = 110; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height); 

echo '
<label class="stylelabel" >Основная картинка</label>
<div id="baseimg">
<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
<a href="edit_product.php?id='.$row["id_product"].'&image='.$row["image"].'&action=delete" ></a>
</div>

';
   
}else
{  
echo '
<label class="stylelabel" >Основная картинка</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="upload" />
</div>
';
}
   

echo'
<li>
<label>Описание товара</label>
<textarea name="add_description" cols="70px" rows="10px" >"'.$row['description'].'"</textarea>

<li>
<label>Количество товара</label>
<input type="text" name="add_count"/ value="'.$row['count'].'"></li>

</ul>
<p align="right"><input type="submit" id="submit_save" name="submit_save" value="Изменить товар"/></p>
</form>
';}
while ($row = mysql_fetch_array($result));
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