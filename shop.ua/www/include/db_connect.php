<?php
$db_host= 'localhost';
$db_user= 'root';
$db_database ='my_shop';

$link=mysql_connect('localhost','root');
mysql_select_db('my_shop', $link) or die("Нет соединения с БД". mysql_error());

?>