<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
define('tourist_stories_db',true); 
 include("db_connect.php");
 include("functions.php");
mysql_query("SET NAMES cp1251");
mysql_query("SET CHARACTER SET 'cp1251'");
 $id = clear_string($_POST['rid']);
 $bad = iconv("UTF-8", "cp1251",clear_string($_POST['bad']));
 mysql_query("UPDATE `reviews` SET `moderat` = '1'  WHERE `reviews`.`id_reviews` = '$id')",$link);		

echo 'yes';
}
?>