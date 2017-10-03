<?php
session_start();
if($_SESSION['auth_login']=="yes_auth"){

	if(isset($_GET["logout"]))
    {
	   unset($_SESSION['auth_login']);
       unset($_SESSION['username']);;//уничтожаем сессию
       header("Location:index.php");
	}

    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="windows-1251" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />    
	<title>Интернет-магазин WG</title>
</head>

<body>

<div id="body">
<?php
	include("include/header.php");
 
?>
<div id="content">
<div id="content-in">
<p id="p2">Электронная почта:  wood@mail.ru<br /> 
Телефон: 093-234-43-45<br /> 
</p>

 
<p id="p1">Авторизированные точки продаж:</p>

<p class="city">Харьков</p>
<p id="p2">
PIMP YOUR EYES<br /> 
Дизайн-завод «Флакон», ул. Академика Павлова, 144, 095-410-24-21<br /> 

VITRINA<br /> 
Центр дизайна «ArtPlay», Пискуновский пер., 15, вход 2А, 095-508-14-51<br /> 

SOSUNNY <br /> 

Онлайн-магазин актуальной оптики www.sosunny.ru , 095-923-41-04<br />  <br /> 
</p>

<p class="city">Днепропетровск</p> 
<p id="p2">
PIMP YOUR EYES <br /> 
ул. Казанская, 20; ежедневно 12-21, 940-73-25<br /> 
</p>
<p class="city">Киев</p>

<p id="p2">
20/80 CONCEPT STORE<br /> 
ул. Яблочкова, 22; ежедневно 11-20<br /> 
</p>

<p class="city">Одесса</p>

<p id="p2">
VANILLA SKY <br /> 
Бизнес-Центр, на ул. Вокзальная магистраль 16, оф. 1009, 093-489-77-35<br /> 
iSWAG<br /> 
Торговый центр «Красная Площадь», ул. Дзержинского 100, 093-172-36-66<br /> 
</p>

<p class="city">Львов</p>

<p id="p2">
iSWAG<br /> 
Торговый центр »Променад» бутик 158, 096-111-62-94<br /> 
</p>


</div>
</div>
<?php
	include("include/footer.php");
?>
</div>



</body>
</html>