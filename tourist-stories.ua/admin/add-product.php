<?php
session_start();
if($_SESSION['auth_admin']=="yes_auth"){
    

	if(isset($_GET['logout']))
    {
	   unset($_SESSION['auth_admin']);//уничтожаем сессию
       header("Location:login.php");
	}
    $_SESSION['urlpage']="<a href='index.php'>Главная</a> \ <a href='tovar.php'>Товары</a>\ <a>Добавление товаров</a>";
    include("include/db_connect.php");
    mysql_query("SET NAMES 'cp1251'");
    
     if($_POST['submit-add'])//проверка нажата ли кнопка
    
      { 
      $error = array();
    
    // Проверка полей
        
       if (!$_POST["add-title"])
      {
         $error[] = "Укажите название товара";
      }
      else{$add_title = $_POST["add-title"];}
       if (!$_POST["add-price"])
      {
         $error[] = "Укажите цену";
      }
      if (!(preg_match("/^[0-9-]+$/",$_POST["add-price"]))){
        $error[] = "Укажите цену в цифрах";
      }
       else{$add_price = $_POST["add-price"];}   
      if (!$_POST["add-brand"])
      {
         $error[] = "Укажите бренд";         
      }
        else{
        $add_brand=$_POST["add-brand"];
       }
       
           
       
        $add_description=$_POST["add-description"];
        $add_count= $_POST["add-price"];
      
                                      
       if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }
 
       else
       {
                           
              	mysql_query("INSERT INTO product(title,price,brand,description,count)
						VALUES(						
                            '$add_title',
                            '$add_price',
                            '$add_brand',
                            '$add_description',
                            '$add_count'                            
						)",$link);
                  
      $_SESSION['message'] = "<p id='form-success'>Товар успешно добавлен!</p>";
      $id = mysql_insert_id();
      

      }
       if (empty($_POST["upload"]))
      {        
      include("actions/upload-image.php");
      unset($_POST["upload"]);           
      }          
      }
      
        
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
<p id="count-style">Добавление товара</p>

</div>
<?php


		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}
  
?>
<form enctype="multipart/form-data" method="post" action="add-product.php"><!--enctype - показывает что надо загружать данные(картинку)-->
<ul id="block-add">
<li>
<label>Название товара</label>
<input type="text" name="add-title"/></li>

<li>
<label>Цена</label>
<input type="text" name="add-price"/></li>

<li>
<label>Бренд</label>
<input type="text" name="add-brand"/></li>

<li>
<label>Основная картинка</label>
<div id="upload-img">
<input type="file" name="upload"/></li>

<li>
<label>Описание товара</label>
<textarea name="add-description" cols="60px" rows="10px"></textarea></li>

<li>
<label>Количество товара</label>
<input type="text" name="add-count"/></li>



</ul>
<p id="add"><input type="submit" id="submit-add" name="submit-add" value="Добавить товар"/></p>
</form>

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
