<?php
session_start();
define('my_shop',true);
if ($_SESSION['auth_login'] == 'yes_auth')
{
 
 echo '<p id="auth-user-info" align="right">Здравствуйте, '.$_SESSION['username'].'! <a href="?logout" class="top-auth">Выход</a></p>';   
    
}else{
 
  echo '<p id="reg-auth-title" ><a href="login.php" class="top-auth">Вход</a><a href="reg.php">Регистрация</a></p>';   
    
}
	
?>
<div id="header">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mocha.js"></script>
<div id="header-top-block">

<p class="logo"><img src="images/logov.png" alt="logo"/> </p>
<p id="telefon"><strong>Для заказа звоните: 093-234-43-45</strong></p>
</div>

<div id="foto-block">
<div id="foto">
<img src="images/slider1.png" class="image-0" style="opacity: 0.999985; display: none;"/> 
<img src="images/slider2.png" class="image-1" style="display: none;" />
<img src="images/slider3.png" class="image-2" style="display: none;" />
<img src="images/slider3.png" class="image-3" style="display: none;" />
<img src="images/slider5.png" class="image-4" style="display: none;" />
<img src="images/slider6.png" class="image-5" style="display: none;" />
</div>
  
<div id="mini">
<img src="images/mini1.png" class="mini-0"/>
<img src="images/mini2.png" class="mini-1"/>
<img src="images/mini3.png" class="mini-2"/>
<img src="images/mini4.png" class="mini-3"/>
<img src="images/mini5.png" class="mini-4"/>
<img src="images/mini6.png" class="mini-5"/>
</div> 
 
 <a href="#" id="next"></a>
 </div>
 

<div id="menu-block">
<div id="menu-block-in">
<ul id="top-menu">
   <li><a href="index.php">Главная</a></li>
   <li><a href="dostavka.php">Доставка и оплата</a></li>
   <li><a href="kontakt.php">Контакты</a></li>
</ul>
</div>


</div>
</div>