<?php
   include("include/db_connect.php");
   $id = $_GET['id_mstory'];
   $moderat = $_GET['moderat'];
   mysql_query(" UPDATE story SET moderat = $moderat WHERE id_story='$id' ");
   $msgerror = 'История принята';
   mysql_close();
   header("Location: history_admin.php");


?>