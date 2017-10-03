<?php
   include("include/db_connect.php");
   $id = $_GET['id_reviews'];
   $id_story = $_GET['id_story'];
   $id_user=$_GET['id_user'];
   mysql_query(" UPDATE reviews SET moderat=1 WHERE id_reviews='$id' ");
   $res1 = mysql_query("SELECT count_complaint from user where id_user=$id_user;",$link);
If (mysql_num_rows($res1) > 0)
{
$row = mysql_fetch_array($res1);
$count_complaint=$row["count_complaint"];
$count_complaint=$count_complaint+1;
}
   mysql_query(" UPDATE user SET count_complaint=$count_complaint WHERE id_user='$id_user' ");
   mysql_close();
   header("Location: story.php?id_story=$id_story");
?>