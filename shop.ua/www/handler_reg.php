<?php
 if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
 session_start();
 define('my_shop', true);
 include("/include/db_connect.php");

 
     $error = array();
         
        
 
 
    if (strlen($login) < 5 or strlen($login) > 15)
    {
       $error[] = "����� ������ ���� �� 5 �� 15 ��������!"; 
    }
    else
    {   
     $result = mysql_query("SELECT login FROM user_reg WHERE login = '$login'",$link);
    If (mysql_num_rows($result) > 0)
    {
       $error[] = "����� �����!";
    }
            
    }
     
    if (strlen($pass) < 5 or strlen($pass) > 15) $error[] = "������� ������ �� 5 �� 15 ��������!";
    if (strlen($surname) < 2 or strlen($surname) > 20) $error[] = "������� ������� �� 2 �� 20 ��������!";
    if (strlen($name) < 3 or strlen($name) > 15) $error[] = "������� ��� �� 3 �� 15 ��������!";
    if (strlen($patronymic) < 3 or strlen($patronymic) > 25) $error[] = "������� �������� �� 3 �� 25 ��������!";
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email))) $error[] = "������� ���������� email!";
    if (!$phone) $error[] = "������� ����� ��������!";
   
   if (count($error))
   {
    
 echo implode('<br />',$error);
     
   }else
   {   
        $pass   = md5($pass);
        $pass   = strrev($pass);
        $pass   = "9nm2rv8q".$pass."2yo6z";
        
        $ip = $_SERVER['REMOTE_ADDR'];
		
		mysql_query("	INSERT INTO user_reg(login,pass,surname,name,patronymic,email,phone,ip)
						VALUES(
						
							'".$login."',
							'".$pass."',
							'".$surname."',
							'".$name."',
							'".$patronymic."',
                            '".$email."',
                            '".$phone."',
                            NOW(),
                            '".$ip."'							
						)",$link);

 echo 'true';
 }        


}
?>