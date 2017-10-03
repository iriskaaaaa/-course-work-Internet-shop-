<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{    
session_start();
    if ($_SESSION['likeid'] != (int)$_POST["id"])
    {
	 include("db_connect.php");
  
     $id = (int)$_POST["id"];	
	
    $result = mysql_query("SELECT * FROM story WHERE id_story = '$id'",$link);
        if (mysql_num_rows($result) > 0)
            {
                $row = mysql_fetch_array($result); 
   
                $new_count = $row["count_like"] + 1;
                $update = mysql_query ("UPDATE story SET count_like='$new_count' WHERE id_story='$id'",$link);
                echo $new_count;
   
            }
        $_SESSION['likeid'] = (int)$_POST["id"]; 
    }
    else
    {
    echo 'no';
    }
  }  




?>