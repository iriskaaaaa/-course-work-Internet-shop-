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
<p id="p1">��������</p>
<p id="p2">��������!<br /> 
��������� �������� ������ ���������� ����������� �������� (����� �����, ���� �������� ) - ��� ��������� ����������� ���������� ������� ����� ������ � ������, � ��� �� ��� ������� ���.
� ������ ����������� ������, ��� �������� ������������ ������ - ���������� ���������� �� ��������� ������ � ��� ������, � ��� �� ��������� ���(���������) . � ������ ���� ������ �������� ����� ����� ����� - ����������� �������� ��� � ����������� �� ���: (044) 537-02-22, (044) 503-80-80, 0 800 503-808
/<br /> 
</p>

<p class="city">�������� � ��������� ����� ����� �� ���� �������</p>
<p id="p2">

� ������� �������� ����� ������, �� ������ �������� ����� ���� � ����� ���������� ������� �������<br /> 

� �������, �������� �������� 1-3 ���, �� ����� ������ ���� ��������� ��������� � ���� ���� �������� ����� ��������� ������.<br /> 

��������� �������� ������� ����� ������ � ��������� ���������� 35 ���<br /> 

��������� �������� ���������������� ������� ���������� 80 ���<br /> 

��������� �������� ������� �� ������� �������� ������� � �������� �������������� �������������.<br /> 
  <br /> 
</p>

<p class="city">�������� �������� �� ��������</p> 
<p id="p2">

�������� � �������� �������� ��������� ��� ������ �� ����� �� 2000 ���.<br />  
��������� �������� ������� �� 2000 ��� ���������� 35 ���.<br /> <br /> 
</p>
<p id="p1">������</p>
<p class="city">������ ���������</p>
<p id="p2">
������ ��������� ��� ��������� ������ �������� �� ���� ���������� ������� �� ���������� �������. <br /> 
������ ������������ ������������� � ������������ ������.<br /> 
� ������������� ������ �� ������ ��� �������� ���.<br /> 
����� �������� ������ ���������� �������� ��� ��������� ������ � ���������� ����� �����.<br /> <br /> 
</p>


</div>
</div>
<?php
	include("include/footer.php");
?>
</div>



</body>
</html>