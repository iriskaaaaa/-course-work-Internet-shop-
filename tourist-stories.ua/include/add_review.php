<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
define('tourist_stories_db',true); 
 include("db_connect.php");
 include("functions.php");
mysql_query("SET NAMES cp1251");
mysql_query("SET CHARACTER SET 'cp1251'");
 $id = clear_string($_POST['id']);
 $name = iconv("UTF-8", "cp1251",clear_string($_POST['name']));
 $text =  iconv("UTF-8", "cp1251",clear_string($_POST['comment']));
 $user_id =  clear_string($_POST['user_id']);
 
@setlocale(LC_ALL, array ('ru_RU.CP1251', 'rus_RUS.1251'));
$pattern = "/\w{0,5}[�x]([�x\s\!@#\$%\^&*+-\|\/]{0,6})[�y]([�y\s\!@#\$%\^&*+-\|\/]{0,6})[�i�e�����]\w{0,7}|\w{0,6}[�p]([�p\s\!@#\$%\^&*+-\|\/]{0,6})[i��]([i��\s\!@#\$%\^&*+-\|\/]{0,6})[3��]([3��\s\!@#\$%\^&*+-\|\/]{0,6})[�d]\w{0,10}|[�cs][�y]([�y\!@#\$%\^&*+-\|\/]{0,6})[4�k�]\w{1,3}|\w{0,4}[b�]([b�\s\!@#\$%\^&*+-\|\/]{0,6})[l�]([l�\s\!@#\$%\^&*+-\|\/]{0,6})[y�]\w{0,10}|\w{0,8}[�][b�][����@e���a][���@���]\w{0,8}|\w{0,4}[�e]([�e\s\!@#\$%\^&*+-\|\/]{0,6})[�b]([�b\s\!@#\$%\^&*+-\|\/]{0,6})[u�]([u�\s\!@#\$%\^&*+-\|\/]{0,6})[�4�]\w{0,4}|\w{0,4}[�e�]([�e�\s\!@#\$%\^&*+-\|\/]{0,6})[�b]([�b\s\!@#\$%\^&*+-\|\/]{0,6})[�n]([�n\s\!@#\$%\^&*+-\|\/]{0,6})[�y]\w{0,4}|\w{0,4}[�e]([�e\s\!@#\$%\^&*+-\|\/]{0,6})[�b]([�b\s\!@#\$%\^&*+-\|\/]{0,6})[�o�a@]([�o�a@\s\!@#\$%\^&*+-\|\/]{0,6})[�n�t]\w{0,4}|\w{0,10}[�]([�\!@#\$%\^&*+-\|\/]{0,6})[�]\w{0,6}|\w{0,4}[p�]([p�\s\!@#\$%\^&*+-\|\/]{0,6})[�e�i]([�e�i\s\!@#\$%\^&*+-\|\/]{0,6})[�d]([�d\s\!@#\$%\^&*+-\|\/]{0,6})[o��a@�e�i]([o��a@�e�i\s\!@#\$%\^&*+-\|\/]{0,6})[�r]\w{0,12}/i";
$replacement = "�������";
$text = preg_replace($pattern, $replacement, $text);

    		mysql_query("INSERT INTO reviews(id_story, id_user, name, comment, date)
						VALUES(						
                            '".$id."',
                            '".$user_id."',
                            '".$name."',
                            '".$text."',
                             NOW()							
						)",$link);	

echo 'yes';
}
?>