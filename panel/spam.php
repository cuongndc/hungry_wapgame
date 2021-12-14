<?php

$title = 'Массовая рассылка';
include ('../inc/head.php');

define('root', ROOT.'/panel/spam.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:

echo'<div class="mybar"><center>'.$title.'</center></div>';
echo '<form action="" method="post">Тема:<br/>
<input type="text" name="tema" value="Массовая рассылка"/><br/>
Сообщение:<br/>
<input type="text" name="message" value=""/><br/>
<input type="submit" value="Отправить"/></form>';
echo'<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
if (!empty($_POST['message'])){
$s = mysql_query("SELECT * FROM `users`");
while ($q = mysql_fetch_array($s)){
mysql_query("insert into `mail` set `to`='".win($q['login'])."', `who`='Системный бот', `date`='".time()."', `status`='1', `tema`='".win($_POST['tema'])."', `text`='".win($_POST['message'])."'");
echo '<meta http-equiv="Refresh" content="1; url='.root.'"/>';
}

break;
		
}
}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>