<?php
   include("include/db_connect.php");
   $id_user=$_GET['id_user'];
   mysql_query(" UPDATE user SET block=1 WHERE id_user='$id_user' ");
   mysql_close();
   header("Location: inf_user.php?id_user=$id_user");
?>