<?php
   include("include/db_connect.php");
   $id = $_GET['id_story'];
   mysql_query(" DELETE FROM story WHERE id_story='$id' ");
   mysql_close();
header("Location: profile.php");
?>