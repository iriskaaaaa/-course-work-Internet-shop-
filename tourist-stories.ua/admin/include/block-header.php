<?php
	defined('tourist-stories') or die('Доступ запрещён!');
    
     $result1 = mysql_query("SELECT * FROM story WHERE moderat=0",$link);
    $count1 = mysql_num_rows($result1);
    
    if ($count1 > 0) { $count_str1 = '<p>+'.$count1.'</p>'; } else { $count_str1 = ''; }
    
    $result2 = mysql_query("SELECT * FROM reviews WHERE moderat=1",$link);
    $count2 = mysql_num_rows($result2);
    
    if ($count2 > 0) { $count_str2 = '<p>+'.$count2.'</p>'; } else { $count_str2 = ''; }
    
 

 
?>
<div id="block-header">
<div id="block-header1">
<h3>Tourist Stories. Панель управления</h3>
<p id="link-nav"><?php	echo $_SESSION['urlpage'] ?></p>
</div>

<div id="block-header2">
<p>Администратор | <a href="?logout">Выход</a></p>
<p>Вы - <span><?php echo $_SESSION['username']?></span></p>
</div>
</div>
<div id="left-nav">
<ul>
<li><a href="reviews.php">Отзывы</a><?php echo $count_str2; ?></li>
<li><a href="history_admin.php">Истории</a><?php echo $count_str1; ?></li>
<li><a href="users.php">Пользователи</a></li>
</ul>
</div>
