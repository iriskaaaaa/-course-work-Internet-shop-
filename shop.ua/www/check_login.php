<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
define('my_shop', true);    
include("../include/db_connect.php");
include("../functions/functions.php");

$login = clear_string($_POST['login']);

$result = mysql_query("SELECT login FROM user_reg WHERE login = '$login'",$link);
If (mysql_num_rows($result) > 0)
{
   echo 'false';
}
else
{
   echo 'true'; 
}
}
?>