<?php
$error_img = array();//

if($_FILES['upload']['error'] > 0)
{
 //� ����������� �� ������ ������ ������� ��������������� ���������
 switch ($_FILES['upload']['error'])
 {
 case 1: $error_img[] =  '������ ����� ��������� ���������� �������� UPLOAD_MAX_FILE_SIZE'; break;
 case 2: $error_img[] =  '������ ����� ��������� ���������� �������� MAX_FILE_SIZE'; break;
 case 3: $error_img[] =  '�� ������� ��������� ����� �����'; break;
 case 4: $error_img[] =  '���� �� ��� ��������'; break;
 case 6: $error_img[] =  '����������� ��������� �����.'; break;
 case 7: $error_img[] =  '�� ������� �������� ���� �� ����.'; break;
 case 8: $error_img[] =  'PHP-���������� ���������� �������� �����.'; break;
 }

}else
{
//��������� ����������
if($_FILES['upload']['type'] == 'image/jpeg' || $_FILES['upload']['type'] == 'image/jpg' || $_FILES['upload']['type'] == 'image/png')
{ 

$imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload']['name']));//����������� ����������

    //����� ��� ��������
$uploaddir = './upload/';
//����� ��������������� ��� �����
$newfilename = 'image-'.$id.rand(10,100).'.'.$imgext;
//���� � ����� (�����.����)
$uploadfile = $uploaddir.$newfilename;
 
//��������� ���� move_uploaded_file
if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile))
{

  $update = mysql_query("UPDATE story SET img ='$newfilename' WHERE id_story = '$id'",$link);   

}
else
{
 $error_img[] =  "������ �������� �����.";    
}
 

    
}else
{
 $error_img[] =  '���������� ����������: jpeg, jpg, png';
}
 

}

?>