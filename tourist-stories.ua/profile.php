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
    
    <script src="libs/jquery/jquery-2.1.4.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/js/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="js/js/shop-script.js"></script>
<link rel="stylesheet" type="text/css" href="http://tourist-stories.ua//fancybox/jquery.fancybox.css" />
<script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/js/jTabs.js"></script>


    
    

<script type="text/javascript">
$(document).ready(function() {
 
    $(".send-pass").fancybox();
    //$(".send-bad").fancybox();
	
});	
</script>  

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
      			<p class=" text_sort_profile">'.$row["username"].'</p>
    	    </div>

		<div class="line1"></div>
		<div class="line2"></div>
            
    '; 
} while ($row = mysql_fetch_array($result));
}
?>
         <div class="col-sm-5">
          <?php
$result = mysql_query("SELECT * FROM user WHERE id_user='$id'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
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
                 <img src="'.$img_path.'  "width="'.$width.' "height="'.$height.' "class="img-thumbnail avtor-img" "/>
             </a>
            </div>
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
         <p class="text_sort_profile">О себе</p>
         <p>'.$row["about_me"].'</p>
         <p>Ваш email: '.$row["email"].'</p>
         ';
} while ($row = mysql_fetch_array($result));
}
         ?>
          <a href="edit_profile.php" class="button-create "><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Редактировать информацию"/></a>
        <?php echo'<a href="delete_ptofile.php?id_user='.$id.' class="button-create" ><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Удалить профиль"/></a>'; ?>
        <p  id="link-send-pass1"><a href="#send-pass" class="button-create send-pass"><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Изменить пароль"/></a></p>
               </div>
          <div class="col-sm-12 contain">
          <div class="line2"></div>
         </div>
         
         <section class="works_s">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-sm-6 p0">
					<div class="work_block">
						<div class="image_wrap">
							<div class="work_descr">
                           <?php 
                           $count1 = mysql_query("Select COUNT(story.id_story) from story, user where story.id_user=user.id_user and user.id_user=$id;",$link);
                           $temp1=mysql_fetch_array($count1);
                           $count_publication=$temp1[0];

                           echo'<h4>'.$count_publication.'</h4>';
s
                            ?>	
								<p>ПУБЛИКАЦИЙ</p>
							</div>
						</div>
						<img src="img/blue.jpg" class="img-responsive" alt="workItem"/>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p0 ">
					<div class="work_block">
						<div class="image_wrap">
							<div class="work_descr">
     <?php 
                           $count1 = mysql_query("Select SUM(story.count_like) from story, user where story.id_user=user.id_user and user.id_user=$id;",$link);
                           $temp1=mysql_fetch_array($count1);
                           $count_LIKE=$temp1[0];
                            $count_LIKE= (int)$count_LIKE;

                           echo'<h4>'.$count_LIKE.'</h4>';

                            ?>
                                
								<p>LIKE</p>
							</div>
						</div>
						<img src="img/blue.jpg" class="img-responsive" alt="workItem"/>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p0 ">
					<div class="work_block">
						<div class="image_wrap">
							<div class="work_descr">
                                <?php 
                                $row_number=0;
                                $sql  = mysql_query("SET @row_number = 0",$link);
                           $result = mysql_query("Select *, (@row_number:=@row_number + 1) AS 'num' from (
Select  user.id_user, user.username, SUM(story.count_like) AS 'count' 
from story, user where story.id_user=user.id_user GROUP BY user.id_user ORDER BY count DESC ) t",$link);
                          If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
    $user=$row["id_user"];
    if($user == $id){
         echo'
            <h4>'.$row["num"].'</h4>
         ';
}
} while ($row = mysql_fetch_array($result));
}
                          

                            ?>
                                
                                
								<p>В РЕЙТИНГЕ</p>
							</div>
						</div>
						<img src="img/blue.jpg" class="img-responsive" alt="workItem"/>
					</div>
				</div>
                </section>
       <div class="col-sm-12 contain">
    <div class="line1"></div>
    </div>

       
        <a href="historyform.php" class="button-create "><input type="submit" name="submit-enter" id="submit-enter"  class="button" value="Создать историю"/></a>
        
        <?php
            $num=9;//сколько выводить товаров на страницу
    $page=(int)$_GET['page'];
    $count=mysql_query("SELECT COUNT(*) FROM story WHERE id_user ='$id'",$link);
    $temp=mysql_fetch_array($count);
    $post=$temp[0];
    //находим общее число страниц
    $total = (($post-1)/$num)+1;
    $total=intval($total);
    //определяем начало сообщений для текущей тсраницы
    $page=intval($page);
    //если значение  $page меньше или отрицательно
    // переходим на первую страницу
    //а если слишком большое, то переходим на последнюю
    if(empty($page) or $page<0)$page=1;
    if($page>$total)$page=$total;
    //вычисляем начиная с какого номера следует выводить сообщения
    $start=$page*$num-$num;
    
    if($temp[0]>0){
        $result=mysql_query("SELECT * FROM story WHERE id_user = $id ORDER BY id_story  DESC LIMIT $start, $num",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do{
                    $string = $row['text_story'];
                    $string = strip_tags($string);
                    if(strlen($string) > 600)
                    {
                    $string = substr($string, 0, 600);
                    $string = rtrim($string, "!,.-");
                    $string = substr($string, 0, strrpos($string, ' '));
                    $string = $string.'...';
                    }
                    
                    if  (strlen($row['img']) > 0 && file_exists("./upload/".$row["img"]))
               {
            $img_path = "/upload/".$row['img']; 
           // $max_width=160;
           // $max_height=160;
           //  list($width,$height)=getimagesize($img_path);
           // $ratioh=$max_height/$height;
           // $ratiow=$max_width/$width;
           // $ratio=min($ratioh,$ratiow);
           //  $width=intval($ratio*$width);
           //  $height=intval($ratio*$height);
    }
    else
{
$img_path = "/upload/no_image.jpg"; 
//$width = 120;
//$height = 160;
}
    echo'
    <section class="story">
      		<div class="story_block">
            <p class="text_sort_status">CТАТУС - 
            ';
            if($row['moderat']==0){
                echo'<span style="color: blue;">Ваша история еще не проверена модератором</span>';
            }
            if($row['moderat']==1){
                echo'<span style="color: green;">История опубликована</span>';
            }
            if($row['moderat']==2){
                echo'<span style="color: red;">История отклонена модератором</span>';
            }
            echo'
            </p>
    <a href="story.php?id_story='.$row['id_story'].'"><img src="'.$img_path.'" class="img-responsive" /></a>
   	<div class="example_text">
      			 <h5>'.$row['name_story'].'</h5>
        		<span>'.$string.'</br></span>
        		<p class="glyphicon glyphicon-heart"> '.$row['count_like'].' | Дата публикации: '.$row['date'].'</p></br>
                <a class="text" href="edit_historyform.php?id_story='.$row['id_story'].'">Редактировать историю</a>
                <a href="delete_story.php?id_story='.$row['id_story'].'" class="delete" >Удалить</a>
                </div>
      		</div>
            </section>
    '; 
    } while ($row = mysql_fetch_array($result));
   
 
} 
}  
if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="profile.php?'.$url.'page='. ($page - 1) .'" />&laquo;</a></li>';

if ($page != $total) $nextpage = '<li><a class="pstr-next" href="profile.php?'.$url.'page='. ($page + 1) .'"/>&raquo;</a></li>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<li><a href="profile.php?'.$url.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
if($page - 4 > 0) $page4left = '<li><a href="profile.php?'.$url.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
if($page - 3 > 0) $page3left = '<li><a href="profile.php?'.$url.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
if($page - 2 > 0) $page2left = '<li><a href="profile.php?'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
if($page - 1 > 0) $page1left = '<li><a href="profile.php?'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';

if($page + 5 <= $total) $page5right = '<li><a href="profile.php?'.$url.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
if($page + 4 <= $total) $page4right = '<li><a href="profile.php?'.$url.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
if($page + 3 <= $total) $page3right = '<li><a href="profile.php?'.$url.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
if($page + 2 <= $total) $page2right = '<li><a href="profile.php?'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
if($page + 1 <= $total) $page1right = '<li><a href="profile.php?'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="profile.php?'.$url.'page='.$total.'">'.$total.'</a></li>';
}else
{
    $strtotal = ""; 
}

	if ($total > 1)
{
    echo '
    <ul class="pagination">   
    ';
    echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='profile.php?".$url."page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$nextpage;
    echo '
    </ul>
    ';
} 
echo'
    <div id="send-pass" >
    
    <p align="right" id="title-review">Изменение пароля</p>
    
    <ul>
    <li><p align="right"><label id="label-name" >Старый пароль<span>*</span></label><input maxlength="20" type="text"  id="pass" /></p></li>     
    <p align="right"><label id="label-name" >Новый пароль<span>*</span></label><input maxlength="20" type="text"  id="new_pass" /></p></li>    
    <p align="right"><label id="label-name" >Подтвердите новый пароль<span>*</span></label><input maxlength="20" type="text"  id="newnew_pass" /></p></li> 
    </ul>
   <p id="reload-img"><img src="/img/loading.gif"/></p> <p id="button-send-pass" iid="'.$id.'"></p>  
    </div>'; ?>
            
            
   </div>

    <div class="col-sm-2 sidenav">
      <section class="new_story">
      <p class="navbar-text text_sort">Новые истории</p>
<?php
        $result=mysql_query("SELECT * FROM `story` where moderat=1 ORDER BY date DESC limit 5;",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do
            {
                if  (strlen($row['img']) > 0 && file_exists("./upload/".$row["img"]))
                    {
                        $img_path = "/upload/".$row['img']; 

                    }
                 else
                    {
                        $img_path = "/upload/no_image.jpg"; 

                    }
             echo'
      	<div class="new_story_block">
      			
      			<a href="story.php?id_story='.$row['id_story'].'"><img src="'.$img_path.'" class="img-responsive" /></a>
      			<div class="example_text">
      			 <h5>'.$row['name_story'].'</h5>
        		<p>  Дата публикации:'.$row['date'].'</p>
          </div>
      	</div></br></br>';
        }while ($row = mysql_fetch_array($result));
        }
        ?>
       </section>


    </div>
    
</div>
</div>



<footer class="container-fluid text-center">
<div class="top_line"></div>

<span class="glyphicon glyphicon-copyright-mark"> Designed by Ira Klinkova</span>
</footer>



	
</body>
</html>