<?php
// подключение к бд
include "db_connect.php";

// контейнер для ошибок 
$error = false;
// получение данных
$id_user = (int) $_POST['id_user'];
$id_story = (int) $_POST['id_story'];
$type = $_POST['type'];

// проверяем, голосовал ранее пользователь за эту новость или нет
$sql = mysql_query("
	SELECT count(*) FROM `story_like` WHERE `id_user` = $id_user AND `id_story` = $id_story") or die(mysql_error()); 
$result = mysql_fetch_row($sql);
// если что-то пришло из запроса, значит уже голосовал
//var_dump($result);exit;
if($result[0] > 0){
	$error = 'Вы уже голосовали';
}else{ // если пользователь не голосовал, проголосуем
	// получем поле для голосования - лайк или дизлайк
	if($type == 'like') $fieldName = 'count_like'; 
	if($type == 'dislike') $fieldName = 'count_dislike';
	// делаем запись о том, что пользователь проголосовал
	mysql_query("
		INSERT INTO `story_like` (`id_user`, `id_story`) VALUES ($id_user, $id_story)") or die(mysql_error()); 
	// делаем запись для новости - увеличиваем количесво голосов(лайк или дизлайк)
	mysql_query("
		UPDATE `story` SET `$fieldName`= `$fieldName` + 1 WHERE  `id_story` = $id_story;
	") or die(mysql_error());
}
	
// делаем ответ для клиента
if($error){
	// если есть ошибки то отправляем ошибку и ее текст
	echo json_encode(array('result' => 'error', 'msg' => $error));
}else{
	// если нет ошибок сообщаем об успехе
	echo json_encode(array('result' => 'success'));
}
?>
