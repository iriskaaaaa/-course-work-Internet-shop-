<?php
	session_start();
    define('my_shop',true);
      if($_POST["submit-enter"]){
       if (!$_POST['name']) { 
        $error[] = "Укажите свое имя";
         }
         else{$name = $_POST['name']; }
         
         
   if (!$_POST['surname']) { 
        $error[] = "Укажите свою фамилию";
         }
         else{$surname = $_POST['surname']; }
         
         
   if (!$_POST['patronomyc']) { 
        $error[] = "Укажите свое отчество";
         }
         else{$patronomyc = $_POST['patronomyc']; }
         
if(isset($_POST['email'])) { 
$email = $_POST['email']; 
if($email==''){ 
unset($email); 
} 
} 
if (!$_POST["phone"])
      {
         $error[] = "Укажите номер телефна";
      }
      if (!(preg_match("/^[0-9-]+$/",$_POST["phone"]))){
        $error[] = "Укажите телефон в правильном формате";
      }
       else{$phone = $_POST['phone']; }

   if (!$_POST['login']) { 
        $error[] = "Укажите свой логин";
         }
          
         else{$login = $_POST['login']; }

if (!$_POST['pass']) { 
        $error[] = "Укажите пароль";
         }
         
         else{$pass = $_POST['pass']; }

$name = htmlspecialchars($name);
$surname = htmlspecialchars($surname);
$patronomyc = htmlspecialchars($patronomyc);
$email = htmlspecialchars($email);
$phone = htmlspecialchars($phone);
$login = htmlspecialchars($login); 
$pass = htmlspecialchars($pass); 

$name = stripslashes($name); 
$surname = stripslashes($surname); 
$patronomyc = stripslashes($patronomyc); 
$email = stripslashes($email); 
$phone = stripslashes($phone);  
$login = stripslashes($login); 
$pass = stripslashes($pass); 

$name = trim($name); 
$surname = trim($surname); 
$patronomyc = trim($patronomyc); 
$email = trim($email); 
$phone = trim($phone); 
$login = trim($login); 
$pass = trim($pass); 



//Шифрование пароля 
$pass = md5($pass); 



include ("include/db_connect.php"); 
mysql_query("/*!40101 SET NAMES 'cp1251' */") or die("Error: " . mysql_error());

$result = mysql_query("SELECT id_user_reg FROM user_reg WHERE login = '$login'", $link); 
@$myrow = mysql_fetch_array($result); 
if(!empty($myrow['id_user_reg'])) { 
$error[]="Извините, введённый вами логин уже зарегистрирован. Введите другой логин."; 
}   

if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
            
       }
else{ mysql_query("INSERT INTO user_reg(name, surname, patronomyc, email, phone, login, pass) VALUES('$name', '$surname','$patronomyc','$email','$phone','$login', '$pass')"); 

$_SESSION['message'] = "<p id='form-success'>Вы успешно зарегестрированы!</p>";
      $id = mysql_insert_id();

}
 
    }
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="cp1251_general_ci" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style_reg.css" rel="stylesheet" type="text/css" />  
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
 
    
	<title>Интернет-магазин WG</title>
</head>

<body>
<div id="body">
    <div class="top">
        <a href="index.php" class="glavn">Вернуться на главную</a>
    </div>
<div id="block-pass-login">
<?php

		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}
  
?>
<form  method="post">
<ul id="pass-login">
<li><label for="name">Имя:</label>
<span id="star">*</span>
<input  type="text" id="name" name="name"/></li>
<li><label for="surname">Фамилия:</label>
<span id="star">*</span>
<input  type="text" id="surname" name="surname"/></li>
<li><label for="patronomyc">Отчество:</label>
<span id="star">*</span>
<input  type="text" id="patronomyc" name="patronomyc"/></li>
<li><label for="email">Email:</label>
<span id="star">*</span>
<input  type="text" id="email" name="email"/></li>
<li><label for="phone">Телефон:</label>
<span id="star">*</span>
<input  type="text" id="phone" name="phone"/></li>
<li><label for="login">Логин:</label>
<span id="star">*</span>
<input  type="text" id="login"name="login"/></li>
<li><label>Пароль</label>
<span id="star">*</span>
<input type="password" name="pass"/></li>
</ul>
<p><input type="submit" name="submit-enter" id="submit-enter" value="Зарегестрироваться"/></p>
</form>
</div>


</div>
</html>














</body>