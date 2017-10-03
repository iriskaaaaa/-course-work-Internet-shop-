<?php
   include("include/db_connect.php");
$sql="DELETE FROM product WHERE id_product=$id"; 
  mysql_query($sql); 

?>