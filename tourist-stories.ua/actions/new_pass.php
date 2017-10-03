<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
define('tourist_stories_db',true); 
 include("db_connect.php");
 include("functions.php");
mysql_query("SET NAMES cp1251");
mysql_query("SET CHARACTER SET 'cp1251'");
 $id = clear_string($_POST['id']);
 $pass= iconv("UTF-8", "cp1251",clear_string($_POST['pass']));
 $new_pass =  iconv("UTF-8", "cp1251",clear_string($_POST['new_pass']));
 $newnew_pass =  iconv("UTF-8", "cp1251",clear_string($_POST['newnew_pass']));
$pass=md5($pass);
$new_pass=md5($new_pass);
$result=mysql_query("SELECT * FROM user WHERE id_user = $id ",$link);
        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_array($result);
            do{
                $dbpass=$row['pass'];
               if($dbpass==$pass){
                $update = mysql_query("UPDATE user SET pass ='$new_pass' WHERE id_user = '$id'",$link);   
               }
    } while ($row = mysql_fetch_array($result));

} 

echo 'yes';
}
?>