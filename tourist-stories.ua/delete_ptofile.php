<?php
session_start();
   include("include/db_connect.php");
   $id = $_SESSION['session_id_user'];
   $id = $_GET['id_user'];
   
   mysql_query("DELETE FROM user WHERE id_user='$id' ");
   mysql_close();
   unset($_SESSION['session_username']);
   unset($$_SESSION['session_id_user']);//уничтожаем сессию
       header("Location:index.php");


?>