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
$id_user = $_SESSION['session_id_user'];
	if(isset($_GET["logout"]))
    {
       unset($_SESSION['session_username']);
       unset($_SESSION['session_id_user']);//уничтожаем сессию
       header("Location:index.php");
	}

    }
include ("/include/db_connect.php"); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
$id = ($_GET["id_story"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />

	<title>Tourist Stories</title>



	<link rel="stylesheet" href="css/style1.css" />
	<link rel="stylesheet" href="css/media.css" />
	<link rel="stylesheet" href="css/fonts.css" />
    


<script src="js/slides.min.jquery.js"></script>

<script>
    $(function(){
  $("#slides").slides({

    play: 5000,
    pause: 2500,
    hoverPause: true,
    generateNextPrev: true
  });
});
</script>

<style type="text/css" media="screen">   
  .slides_container {
          max-width: 100%;
    height: auto;   
       
    }
    .slides_container div {
    
          display:block;    
    }  
    
    .slides_container img {
    max-width: 100%;
    height: auto;     
    }  
</style>
</head>

<body>

<?php       
               
echo'
<div id="slides">
   <div class="slides_container">';
$result = mysql_query("SELECT * from story_img where id_story= 93;",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do{
    $image_path = "./upload/".$row['img_story'];
         
  echo'
  
  <div>
            
    <img src="'.$image_path.'"  />
       </div>';
  
} while ($row = mysql_fetch_array($result));
}
echo' 
</div>
</div>';


?>

<footer class="container-fluid text-center">
<div class="top_line"></div>

<span class="glyphicon glyphicon-copyright-mark"> Designed by Ira Klinkova</span>
</footer>


	
</body>
</html>