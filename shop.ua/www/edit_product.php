<?php
session_start();
if($_SESSION['auth_admin']=="yes_auth"){
    

	if(isset($_GET['logout']))
    {
	   unset($_SESSION['auth_admin']);//���������� ������
       header("Location:login.php");
	}
    $_SESSION['urlpage']="<a href='index.php'>�������</a> \ <a href='tovar.php'>������</a>\ <a>���������� �������</a>";
    include("include/db_connect.php");
    mysql_query("SET NAMES 'cp1251'");
    $id = $_GET['id_product'];
    
     if($_POST['submit-add'])//�������� ������ �� ������
    {
      $error = array();
    
    // �������� �����
        
       if (isset($_POST['add-title']))
      {
         $add_title=$_POST['add-title'];
      }
      else{
      echo "������� �������� ������";
      }
      
       if (isset($_POST['add-price']))
      {
         $add_price=$_POST['add-price'];
      }
      else{
      $error[] = "������� ����";
      }
      
       if (isset($_POST['add-brand']))
      {
         $add_brand=$_POST['add-brand'];
      }
      else{
      $error[] = "������� ���������";
      }
      
      if (isset($_POST['add-description']))
      {
         $add_description=$_POST['add-description'];
      }
       
      if (isset($_POST['add-count']))
      {
         $add_count=$_POST['add-count'];
      }
      $result=mysql_query("SELECT * FROM product WHERE id_product=$id",$link);
      $row=mysql_fetch_array($result);
       
      if (count($error))
       {           
            $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";//implode �� ������� ��� �������� � ������ 
            
       }
       else
       {
                          
              	mysql_query("UPDATE INTO product SET(title,price,brand,description,count)
						VALUES(						
                            '$add_title',
                            '$add_price',
                            '$add_brand',
                            '$add_description',
                            '$add_count'                            
						)",$link);
                  
      $_SESSION['message'] = "<p id='form-success'>����� ������� �������!</p>";
      
      if (empty($_POST['upload']))
      {        
      include("actions/upload-image.php");
    //  unset($_POST['upload']);           
      } 
      }}
      
        
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>������ ����������</title>
</head>

<body>
<div id="block-body">
<?php
	include("include/block-header.php");
  
?>
<div id="block-content">
<div id="block-param">
</div>
<div id="block-info">
<p id="count-style">���������� ������</p>

</div>
<?php


		 if(isset($_SESSION['message']))
		{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
		}
        
?>
<?php
	$result = mysql_query("SELECT * FROM product WHERE id_product='$id'",$link);
    
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
do
{
    
echo '

<form enctype="multipart/form-data" method="post" action="add-product.php">
<ul id="block-add">
<li>
<label>�������� ������</label>
<input type="text" name="add-title" value="'.$row['title'].'"/></li>

<li>
<label>����</label>
<input type="text" name="add-price" value="'.$row['price'].'"/></li>

<li>
<label>�����</label>
<input type="text" name="add-brand" value="'.$row['brand'].'"/></li>

<li>
<label>�������� ��������</label>
<div id="upload-img">
<input type="file" name="upload" value="'.$row['image'].'"/>

<li>
<label>�������� ������</label>
<textarea name="add-description" cols="70px" rows="10px" >value="'.$row['description'].'"</textarea>

<li>
<label>���������� ������</label>
<input type="text" name="add-count"/ value="'.$row['count'].'"></li>


</div>
</ul>
<p><input type="submit" id="submit-add" name="submit-add" value="�������� �����"/></p>
</form>
'
</div>
</div>
</body>
</html>
?>
<?php
}else
{
    header("Location: login.php");
}
?>
   
    '
