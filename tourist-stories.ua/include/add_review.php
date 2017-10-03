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
$pattern = "/\w{0,5}[хx]([хx\s\!@#\$%\^&*+-\|\/]{0,6})[уy]([уy\s\!@#\$%\^&*+-\|\/]{0,6})[Єiлeеюий€]\w{0,7}|\w{0,6}[пp]([пp\s\!@#\$%\^&*+-\|\/]{0,6})[iие]([iие\s\!@#\$%\^&*+-\|\/]{0,6})[3зс]([3зс\s\!@#\$%\^&*+-\|\/]{0,6})[дd]\w{0,10}|[сcs][уy]([уy\!@#\$%\^&*+-\|\/]{0,6})[4чkк]\w{1,3}|\w{0,4}[bб]([bб\s\!@#\$%\^&*+-\|\/]{0,6})[lл]([lл\s\!@#\$%\^&*+-\|\/]{0,6})[y€]\w{0,10}|\w{0,8}[еЄ][bб][лске@eыиаa][наи@йвл]\w{0,8}|\w{0,4}[еe]([еe\s\!@#\$%\^&*+-\|\/]{0,6})[бb]([бb\s\!@#\$%\^&*+-\|\/]{0,6})[uу]([uу\s\!@#\$%\^&*+-\|\/]{0,6})[н4ч]\w{0,4}|\w{0,4}[еeЄ]([еeЄ\s\!@#\$%\^&*+-\|\/]{0,6})[бb]([бb\s\!@#\$%\^&*+-\|\/]{0,6})[нn]([нn\s\!@#\$%\^&*+-\|\/]{0,6})[уy]\w{0,4}|\w{0,4}[еe]([еe\s\!@#\$%\^&*+-\|\/]{0,6})[бb]([бb\s\!@#\$%\^&*+-\|\/]{0,6})[оoаa@]([оoаa@\s\!@#\$%\^&*+-\|\/]{0,6})[тnнt]\w{0,4}|\w{0,10}[Є]([Є\!@#\$%\^&*+-\|\/]{0,6})[б]\w{0,6}|\w{0,4}[pп]([pп\s\!@#\$%\^&*+-\|\/]{0,6})[иeеi]([иeеi\s\!@#\$%\^&*+-\|\/]{0,6})[дd]([дd\s\!@#\$%\^&*+-\|\/]{0,6})[oоаa@еeиi]([oоаa@еeиi\s\!@#\$%\^&*+-\|\/]{0,6})[рr]\w{0,12}/i";
$replacement = "÷ензура";
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