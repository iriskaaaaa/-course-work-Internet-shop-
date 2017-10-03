<?php
// Вывод заголовка с данными о кодировке страницы
header('Content-Type: text/html; charset=utf-8');
// Настройка локали
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
// Настройка подключения к базе данных
//mysql_query('SET names "utf8"');

session_start();
define('tourist_stories_db',true);
if($_SESSION['session_username'] && $_SESSION['session_id_user'])
               {
                $id_user = $_SESSION['session_id_user'];
	if(isset($_GET["logout"]))
    {
       unset($_SESSION['session_username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    } 
    $id=($_GET["id_story"]);
    
    if($_POST["submit-enter"]){
        
             if (!$_POST['name_story']) { 
                 $error[] = "Укажите название истории";
                 } else{$name_story = $_POST['name_story']; }

            if (!$_POST['text_story']) { 
                 $error[] = "Напишите историю";
                 } else{$text_story = $_POST['text_story']; }
                 
            if(!$_POST['optionsRadios']){
                $error[] = "Выбирите вид отдыха";
                } elseif ($_POST['optionsRadios'] == "Активный") {
                       $type_of_trip=$_POST['optionsRadios'];
                    } 
                    elseif ($_POST['optionsRadios'] == "Пассивный") {
                       $type_of_trip=$_POST['optionsRadios'];
                    } 
                    elseif ($_POST['optionsRadios'] == "Семейный") {
                       $type_of_trip=$_POST['optionsRadios'];
                    } 

$name_story = htmlspecialchars($name_story);
$text_story = htmlspecialchars($text_story); 

$name_story = stripslashes($name_story); 
$text_story = stripslashes($text_story);   

$name_story = trim($name_story); 
$text_story = trim($text_story); 


include ("/include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
//mysql_query("/*!40101 SET NAMES 'cp1251' */") or die("Error: " . mysql_error());
$result = mysql_query("SELECT id_type_of_trip FROM type_of_trip WHERE name_type = '$type_of_trip'", $link); 
@$myrow = mysql_fetch_array($result); 
if(!empty($myrow['id_type_of_trip'])) { 
$id_type_of_trip=$myrow['id_type_of_trip']; 
} 

if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }

else{
    mysql_query("UPDATE story SET name_story='$name_story', text_story='$text_story', id_type_of_story='$id_type_of_trip' WHERE id_story = '$id'",$link); 

$_SESSION['message'] = "<p id='form-success'>Вы успешно отредактировали  историю!</p>";

}
  if (empty($_POST["upload"]))
      {        
      include("/include/upload-image.php");
      unset($_POST["upload"]);           
      } 
    if (!empty($_POST["collect"]))
      {   
  foreach ($_POST['collect'] as $keys=>$values) {
     mysql_query("INSERT INTO `city_in_story` ( `id_city`, `id_story`) VALUES ('$values', '$id')",$link); 
     $result = mysql_query("SELECT count_story FROM city WHERE id_city = '$values'", $link); 
     @$myrow = mysql_fetch_array($result); 
     if(!empty($myrow['count_story'])) { 
     $count_story=$myrow['count_story'];
     $a=1; 
     $count_story=$count_story + $a;
     mysql_query("UPDATE city SET count_story ='$count_story' WHERE id_city = '$values'",$link); 
    } 
  } }  
      
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />

	<title>Tourist Stories</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css"/>
    
<!--<script src="https://yastatic.net/share2/share.js" async="async"></script>
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js" async="async"></script> -->
   
	<link rel="stylesheet" href="/css/style-historyform..css" />
	<link rel="stylesheet" href="/css/media.css" />
	<link rel="stylesheet" href="/css/fonts.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>


</head>

<body>
 <div class="header_history_form">
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

        </div>
 				<div class="collapse navbar-collapse navbar-right" id="top_menu">
 				   <ul class="menu">
 						<li><a href="index.php">Главная</a></li>
 						<li><a href="rating.php">Рейтинги</a></li>
                        <?php
                        echo'
 						<li><a href="profile.php?id_user='.$row['id_user'].'">Личный кабинет</a></li> ';
                        ?>
                        <li><a href="?logout">Выйти</a></li>
 				  	</ul>

 				</div>

 			</div>
 			</div>
 		</div>
 	</nav>
   </div>

<div class="container-fluid text-center-edit-profile">    
  	<div class="row content">
    	 <div class="col-sm-2 sidenav">
       </div>

   	 <div class="col-sm-8 contain">
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">Редактирование истории</p>
                <p class="navbar-text text_sort">История будет опубликована после модерации администратором</p>
    	  </div>

		   <div class="line1"></div>
		   <div class="line2"></div>


  <?php

		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}

  include ("/include/db_connect.php"); 
  $result1 = mysql_query("SELECT  * FROM story WHERE id_story = '$id'", $link); 
if(mysql_num_rows($result1)>0){
$myrow1=mysql_fetch_array($result1);
    do{ 
        echo'
        <form  enctype="multipart/form-data" method="post" action="edit_historyform.php?id_story='.$id,'">
        <div class="form-group">
    <label class="label_history-edit" for="exampleInputEmail1">Название истории</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name_story" value="'.$myrow1['name_story'].'"/>
  </div>
  <div class="form-group">  
  <label class="label_history" for="exampleInputEmail1">Напишите историю</label>
  <textarea class="form-control" rows="3"  name="text_story" >'.$myrow1['text_story'].'</textarea>
  </div> ';
  if  (strlen($myrow1['img']) > 0 && file_exists("./upload/".$myrow1["img"]))
               { 
            $img_path = "./upload/".$myrow1['img'];
            $max_width=250;
            $max_height=250;
            list($width,$height)=getimagesize($img_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio=min($ratioh,$ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
            } else {
                $img_path = "/upload/no_image.jpg";
                $width=250;
                $height=250;
            }
            
    
    echo '
  
   <div class="form-group">
    <label class="label_base_img">Основная картинка </label>
   

           <div id="baseimg">
                <img src="'.$img_path.'  "width="'.$width.' "height="'.$height.' "class=" avtor-img-edit" "/>
       
            </div>
             </div>

  <div class="form-group">
    <label class="foto-edit" for="exampleInputFile">Загрузите фото</label>   
          
    <input  class="input-foto-edit" type="file" name="upload" id="exampleInputFile"/>
    
    </div>
  <div class="form-group">
 <label class="text_lest" for="exampleInputPassword1">Выбирите город, в котором вы путешествовали</label> 
<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12 select_city1">
<select name=collect[] multiple class="selectpicker " data-style="btn-info" data-max-options="100" data-live-search="true"> ';


$result = mysql_query("SELECT  * FROM country  INNER JOIN city ON country.id_country = city.id_country", $link); 
if(mysql_num_rows($result)>0){
$myrow=mysql_fetch_array($result);
    do{
        $name_country=$myrow['name_country'];
       if($name_country1 != $name_country){
    
    $id_country=$myrow['id_country'];      
    echo'
    <p>'.$name_country.'<p/>
    <optgroup label="'.$name_country.'">';
             $res = mysql_query("SELECT name_city, id_city FROM city  WHERE id_country = '$id_country'", $link);
             $row=mysql_fetch_array($res);
                do{
                    $name_city=$row['name_city'];
                    $id_city=$row['id_city'];
                    echo'
                         <option value="'.$id_city.'">'.$name_city.'</option>';
                   } while ($row = mysql_fetch_array($res));
    echo'</optgroup> ';
    }
    $name_country1 = $name_country;
    } while ($myrow = mysql_fetch_array($result));
    }
   
   echo' 
  </select>
  </div> 


<p class="text_lest">* Если необходимого города нет в списке, то <a href="city.php">добавьте</a> город в список городов!</p>
  <div class="form-group">  
<label class="text_lest" for="optionsRadios1">Выбирите вид отдыха</label>
</div> 
 
<div class="type_trip">
  <div class="radio">
  <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="Активный" '; if($myrow1['id_type_of_story']==1){ echo'checked';} echo' />
          Активный вид отдыха
        </label>
</div>
 <div class="radio">
  <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="Пассивный" '; if($myrow1['id_type_of_story']==2) { echo'checked';} echo' />
          Пассивный вид отдыха
        </label>
</div>
<div class="radio ">
  <label>
          <input type="radio" name="optionsRadios" id="optionsRadios3" value="Семейный" '; if($myrow1['id_type_of_story']==3) { echo'checked';} echo'/>
          Семейный вид отдыха
        </label>

</div>
</div> ';

  }while ($myrow1 = mysql_fetch_array($result1));
}
?>
  <p class="button-create"><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Редактировать"/></p>
</form>
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