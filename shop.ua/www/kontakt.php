<?php
session_start();
if($_SESSION['auth_login']=="yes_auth"){

	if(isset($_GET["logout"]))
    {
	   unset($_SESSION['auth_login']);
       unset($_SESSION['username']);;//���������� ������
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
	<title>��������-������� WG</title>
</head>

<body>

<div id="body">
<?php
	include("include/header.php");
 
?>
<div id="content">
<div id="content-in">
<p id="p2">����������� �����:  wood@mail.ru<br /> 
�������: 093-234-43-45<br /> 
</p>

 
<p id="p1">���������������� ����� ������:</p>

<p class="city">�������</p>
<p id="p2">
PIMP YOUR EYES<br /> 
������-����� �������, ��. ��������� �������, 144, 095-410-24-21<br /> 

VITRINA<br /> 
����� ������� �ArtPlay�, ������������ ���., 15, ���� 2�, 095-508-14-51<br /> 

SOSUNNY <br /> 

������-������� ���������� ������ www.sosunny.ru , 095-923-41-04<br />  <br /> 
</p>

<p class="city">��������������</p> 
<p id="p2">
PIMP YOUR EYES <br /> 
��. ���������, 20; ��������� 12-21, 940-73-25<br /> 
</p>
<p class="city">����</p>

<p id="p2">
20/80 CONCEPT STORE<br /> 
��. ���������, 22; ��������� 11-20<br /> 
</p>

<p class="city">������</p>

<p id="p2">
VANILLA SKY <br /> 
������-�����, �� ��. ���������� ���������� 16, ��. 1009, 093-489-77-35<br /> 
iSWAG<br /> 
�������� ����� �������� ��������, ��. ������������ 100, 093-172-36-66<br /> 
</p>

<p class="city">�����</p>

<p id="p2">
iSWAG<br /> 
�������� ����� ��������� ����� 158, 096-111-62-94<br /> 
</p>


</div>
</div>
<?php
	include("include/footer.php");
?>
</div>



</body>
</html>