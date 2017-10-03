<?php
   include("include/db_connect.php");
   $id = $_GET['id_reviews'];
   $id_story = $_GET['id_story'];
   $id_user=$_GET['id_user'];
   mysql_query(" DELETE FROM reviews WHERE id_reviews='$id' ");
   mysql_close();
   header("Location: reviews.php");
?>