<?php
$db_host= 'localhost';
$db_user= 'root';
$db_database ='tourist_stories_db';

$link=mysql_connect('localhost','root');
mysql_select_db('tourist_stories_db', $link) or die("Нет соединения с БД". mysql_error());

?>