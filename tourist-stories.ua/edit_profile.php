<?php
// Вывод заголовка с данными о кодировке страницы
header('Content-Type: text/html; charset=utf-8');
// Настройка локали
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
// Настройка подключения к базе данных
//mysql_query('SET names "utf8"');

session_start();
define('tourist_stories_db',true);
if($_SESSION['session_username'] && $_SESSION['session_id_user']){

	if(isset($_GET["logout"]))
    {
       unset($_SESSION['session_username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    }
include ("/include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
$id = $_SESSION['session_id_user'];

 if($_POST["submit_enter"]){
        
             if (!$_POST['email']) { 
                 $error[] = "Укажите свой email";
                 } else{$email = $_POST['email']; }

            if (!$_POST['about_me']) { 
                 $about_me ="Информация о себе";
                 } else{$about_me = $_POST['about_me'];}

                    
if($_POST['check'] == 'YES'){
    $access_to_email = 1;
} else{
    $access_to_email = 0;
}

$about_me = htmlspecialchars($about_me);
$email = htmlspecialchars($email);
 

$about_me = stripslashes($about_me); 
$email = stripslashes($email);   


$about_me = trim($about_me); 
$email = trim($email); 
 

if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }
else{ mysql_query("UPDATE `user` SET `email` = '$email', `access_to_email` = $access_to_email, `about_me` = '$about_me' WHERE id_user = '$id'",$link); 

$_SESSION['message'] = "<p id='form-success'>Информация отредактирована!</p>";


}
if (empty($_POST["upload"]))
      {        
      include("/include/upload_ava.php");
      unset($_POST["upload"]);           
      } 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />

	<title>Tourist Stories</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css"/>

	<link rel="stylesheet" href="css/style-profile.css" />
	<link rel="stylesheet" href="css/media.css" />
	<link rel="stylesheet" href="css/fonts.css" />
    

</head>

<body>

  <?php include ("/include/headerr.php"); ?>

<div class="container-fluid text-center">    
  	<div class="row content">
    	<div class="col-sm-2 sidenav">
    	</div>
		
   		 <div class="col-sm-8 contain">
                   <?php

	$result = mysql_query("SELECT * FROM user WHERE id_user='$id'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
            
    
    echo '
    		<div class="navbar-header" >
      			<p class=" text_sort_profile">Редактирование личнчого профиля</p>
    	    </div>

		<div class="line1"></div>
		<div class="line2"></div>
            
    '; 
        echo ' <div class="col-sm-5">';


         if  (strlen($row['image']) > 0 && file_exists("./upload/".$row["image"]))
               { 
            $img_path = "./upload/".$row['image'];
            $max_width=250;
            $max_height=250;
            list($width,$height)=getimagesize($img_path);
            $ratioh=$max_height/$height;
            $ratiow=$max_width/$width;
            $ratio=min($ratioh,$ratiow);
            $width=intval($ratio*$width);
            $height=intval($ratio*$height);
            } else {
                $img_path = "/upload/no_ava.jpg";
                $width=250;
                $height=250;
            }
            
    
    echo '

            
    <section "class=avtor">
        <div "class=media">
            <a "class=pull-left" href="#">
                 <img src="'.$img_path.'  "width="'.$width.' "height="'.$height.'  "class=" img-thumbnail avtor-img" "/>
             </a>
            </div>
            <p class=" text_sort_profile">'.$row["username"].'</p>
            </section>
    
    '; 
} while ($row = mysql_fetch_array($result));
}

?>
         </div>
         <div class="col-sm-7">
         <?php
         	$result = mysql_query("SELECT * FROM user WHERE id_user='$id'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
         echo'
         <form class="form-horizontal" enctype="multipart/form-data" method="post" action="edit_profile.php">';
         
		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}

 echo'
 <div class="form-group">
 <label class=" text_sort_profile">Расскажите о себе</label>
 <textarea class="form-control" rows="3"  name="about_me" >'.$row["about_me"].'</textarea>
 <i class="fa fa-lock"></i>
 </div>
 
 <div class="form-group">
 <label class=" text_sort_profile">Ваш email </label>
 <input type="email" class="form-control" id="pass_control" name="email" value="'.$row["email"].'"/>
 <i class="fa fa-lock"></i>
 </div>
  
<div class="form-group">
    <div class="main-checkbox">
        <input type="checkbox" value="YES" id="checkbox1" name="check" '; if($row['access_to_email']==1){ echo'checked';} echo'>
         <label for="checkbox1"></label>
     </div>
    <span class="text_sort_profile_span">Разрешить другим пользователям видеть Ваш email?</span>
 </div>
 <div class="form-group">
    <label class="text_sort_profile" for="exampleInputFile">Загрузите фото</label>  </div>        
    <input  class="input-foto" type="file" name="upload" id="exampleInputFile"/>  
      </div>
      <p><input type="submit" name="submit_enter" id="submit-enter"  class="button" value="Редактировать информацию"/></p>
 </form>
         ';
} while ($row = mysql_fetch_array($result));
}
         ?>
                    
          
        
         


    </div>
</div>
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