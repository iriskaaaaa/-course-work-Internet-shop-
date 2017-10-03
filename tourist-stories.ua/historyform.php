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
else{ mysql_query("INSERT INTO `story` (`id_story`, `name_story`, `text_story`, `date`, `count_like`, `id_user`, `id_type_of_story`, `moderat`, `id_admin`) VALUES (NULL, '$name_story', '$text_story', SYSDATE(), '0', '$id_user', '$id_type_of_trip', '0', '1');",$link);
 

$_SESSION['message'] = "<p id='form-success'>Вы успешно опубликовали новую историю!</p>";

      $id = mysql_insert_id();

}
      
       if (empty($_POST["upload"]))
      {        
      include("/include/upload-image.php");
      unset($_POST["upload"]);           
      }
 
 
  $img = $_FILES['uploadf'];
function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}    
if(!empty($img))
{
    $img_desc = reArrayFiles($img);
    
    foreach($img_desc as $val)
    {
        $newname = date('YmdHis',time()).mt_rand().'.jpg';
        move_uploaded_file($val['tmp_name'],'upload/'.$newname);
        mysql_query("INSERT INTO `story_img` (`id_story`, `img_story`) VALUES ('$id', '$newname')",$link); 
        unset($_POST["uploadf"]);  
 }
}


      if (!empty($_POST['collect'])){
     foreach ($_POST['collect'] as $keys=>$values) {
     mysql_query("INSERT INTO `city_in_story` ( `id_city`, `id_story`) VALUES ('$values', '$id')",$link); 
   /**
 *   foreach ($values) {
 *      $result = mysql_query("SELECT * FROM city WHERE id_city = '$values'", $link); 
 *      @$myrow = mysql_fetch_array($result); 
 *      if(!empty($myrow['count_story'])) { 
 *      $count_story=$myrow['count_story'];
 *      $a=1; 
 *      $count_story=$count_story + $a;
 *      mysql_query("UPDATE city SET count_story ='$count_story' WHERE id_city = '$values'",$link); 
 *      }
 *     } 
 */
  }   }
      
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

<div class="container-fluid text-center">    
  	<div class="row content">
    	 <div class="col-sm-2 sidenav">
       </div>

   	 <div class="col-sm-8 contain">
    		<div class="navbar-header" >
      			<p class="navbar-text text_sort">Создание истории</p>
                <p class="navbar-text text_sort">История будет опубликована после модерации администратором</p>
    	  </div>

		   <div class="line1"></div>
		   <div class="line2"></div>

<form  enctype="multipart/form-data" method="post" action="historyform.php">
  <?php

		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}

?>
  <div class="form-group">
    <label class="label_history" for="exampleInputEmail1">Название истории</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name_story" placeholder="Введите название истории"/>
  </div>
  <div class="form-group">  
  <label class="label_history" for="exampleInputEmail1">Напишите историю</label>
  <textarea class="form-control" rows="3"  name="text_story" placeholder="Text input"></textarea>
  </div>  
  <div class="form-group">
   <!-- <label for="exampleInputPassword1">Выбирите Страну, в котороый вы путешествовали</label>
    <select multiple class="form-control">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select> -->
 <label for="exampleInputPassword1">Выбирите город, в котором вы путешествовали</label>
 </div> 
   <!-- <select class="form-control">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select> -->
<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12 select_city">
<select name=collect[] multiple class="selectpicker " data-style="btn-info" data-max-options="100" data-live-search="true">
<?php
include ("/include/db_connect.php"); 
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
    
?>

  </select>
  </div> 


<p>* Если необходимого города нет в списке, то <a href="city.php">добавьте</a> город в список городов!</p>
  <div class="form-group">  
<label for="optionsRadios1">Выбирите вид отдыха</label>
</div>
<div class="type_trip">
  <div class="radio">
  <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="Активный" checked>
          Активный вид отдыха
        </label>
</div>
 <div class="radio">
  <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="Пассивный" checked>
          Пассивный вид отдыха
        </label>
</div>
<div class="radio ">
  <label>
          <input type="radio" name="optionsRadios" id="optionsRadios3" value="Семейный"/>
          Семейный вид отдыха
        </label>

</div>
</div>

  <div class="form-group">
    <label class="foto" for="exampleInputFile">Загрузите главное фото</label>               
    <input  class="input-foto" type="file" name="upload" id="exampleInputFile" /> 
    <label class="foto-foto" for="exampleInputFile1">Загрузите фото истории</label>   
    <input  class="input-foto1" type="file" name="uploadf[]" id="exampleInputFile1" multiple/>  
    <p class="button-create"><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Создать"/></p>
  </div>

  
</form>
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