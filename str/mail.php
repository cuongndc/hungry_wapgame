<?php
$title = 'Моя почта';
include ('../inc/head.php');

define('root', ROOT.'/str/mail.php');

if (isset($active) == true) {
switch($act){
default:
echo '<div class="menus menu2"><center>'.$title.'</center></div>';
			
if (isset($_GET['del'])) {
if (isset($_POST['yes'])) {
if (mysql_query("delete from `mail` where `to`='".win($user['login'])."'") && mysql_query("delete from `mail` where `who`='".win($user['login'])."'")) {
echo '<div class="menu"><center>Почта успешно очищена!</center></div><meta http-equiv="Refresh" content="1; url='.root.'"/>';
} else {
echo '<div class="wape"><center>Почта не очищена!</center></div><meta http-equiv="Refresh" content="1; "/>';
}
}
elseif (isset($_POST['no'])) {
header('Location: '.root);
}

echo'<div class="menu">
<form action="" method="post">
Вы действительно хотите очистить все сообщения?<br/><input type="submit" name="yes" value="Да"/>
<input type="submit" name="no" value="Нет"/></form></div>';
}
			
echo'<div class="wape">';
echo'<div class="wape wape1">';
echo'<img src="'.ROOT.'/img/write.png" width="16" height="16" class="left" /> <a href="?act=add">Отправить сообщение</a><br/>
<img src="'.ROOT.'/img/delete.png" width="16" height="16" class="left" /> <a href="?del">Очистить почту</a><br/>
<img src="'.ROOT.'/img/pop.png" width="16" height="16" class="left" /> <a href="?act=in">Входящие</a> ('.$count_mail_me.'/<span style="color:red">'.$count_mail_new.'</span>)<br/>
<img src="'.ROOT.'/img/smtp.png" width="16" height="16" class="left" /> <a href="?act=out">Отправленные</a> ('.$count_mail_to.'/'.$count_mail_to_false.')</div>';
echo'</div>';
echo'<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';


break;

case 'add':
echo '<div class="menus menu2"><center>Отправить сообщение</center></div>';
			
$error = '';

if (isset($_POST['login']) && isset($_POST['tema']) && isset($_POST['text'])) {
if (empty($_POST['login'])) {
$error.= 'Введите логин получателя!<br/>';
}
elseif (mb_strlen($_POST['login']) < 3 or mb_strlen($_POST['login']) > 15) {
$error.= 'Логин получателя должен содержать от 3 до 15 символов!<br/>';
}
elseif ($_POST['login'] == $user['login']) {
$error.= 'Нельзя отправлять почту сaмому себе!<br/>';
}
elseif (!mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".win($_POST['login'])."'"))) {
$error.= 'Пользователь с логином '.utf($_POST['login']).' не найден!<br/>';
}
if (empty($_POST['text'])) {
$error.= 'Введите текст сообщения!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 10 or mb_strlen($_POST['text'], 'utf8') > 2000) {
$error.= 'Сообщение должно содержать не менее 10 и не более 2000 символов!<br/>';
}
if (!empty($_POST['tema']) && mb_strlen($_POST['tema'], 'utf8') > 40) {
$error.= 'Тема должна содержать не более 40 символов!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `mail` set `to`='".win($_POST['login'])."', `who`='".win($user['login'])."', `date`='".time()."', `status`='1', `tema`='".(empty($_POST['tema']) ? 'Без темы' : win($_POST['tema']))."', `text`='".win($_POST['text'])."'")) {
echo '<div class="ok"><center>Ваше сообщение успешно отправлено!</center></div>
<meta http-equiv="Refresh" content="1; url='.root.'"/>';
} else {
echo '<div class="error"><center>Ваше сообщение не отправлено!</center></div>';
}
}
}
			
if (isset($_GET['login'])) {
if ($_GET['login'] != $user['login']) {
if (mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".win($_GET['login'])."'"))) {
$row = mysql_fetch_assoc(mysql_query("select (`login`) from `users` where `login`='".win($_GET['login'])."' limit 1"));
}
}
}

echo'<div class="wape">
<form name="form" action="" method="post">
Получатель:<br/><input type="text" name="login" maxlength="15" value="'.win($_GET['login']).'"/><br/>
Тема:<br/><input type="text" name="tema" maxlength="40"/><br/>
Сообщение:<br/><textarea name="text" cols="30" rows="4"></textarea><br/>
<input type="submit" value="Написать сообщение"/></form></div>';

echo'<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.ROOT.'/mail.php">Моя почта</a></div>';

break;

case 'in':
echo '<div class="menus menu2"><center>Входящие сообщения</center></div>';
			
$k_post = mysql_result(mysql_query("select count(*) from `mail` where `to`='".utf($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `mail` where `to`='".utf($user['login'])."' order by `id` desc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Входящих сообщений нет!</center></div>';
} else {
$count = '';

if (isset($_GET['id'])) {
$sql = mysql_query("select * from `mail` where `to`='".win($user['login'])."' and `id`='".$id."'");
if (!mysql_num_rows($sql)) {
echo '<div class="error"><center>У вас нет такого сообщения!</center></div>';
} else {
$row = mysql_fetch_assoc($sql);

mysql_query("update `mail` set `status`='0' where `id`='".$id."' and `to`='".win($user['login'])."'");
						
echo '<div class="wape">
Отправитель: <a href="'.ROOT.'/str/user.php?login='.$row['who'].'">'.utf($row['who']).'</a><br/>
Дата: '.date('d.m в H:i', $row['date']).'<br/>
Тема: '.utf($row['tema']).'<br/>
Сообщение: '.nl2br(smiles(utf($row['text']))).'</div>
<div class="wape">'.(isset($_GET['add']) ? '<a href="'.root.'/?act=in&id='.$id.'">Cвернуть</a>' : '<a href="'.root.'/?act=in&id='.$id.'&amp;add">Ответить</a>').'</div>';

if (isset($_GET['add'])) {
							
$error = '';
							
if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введите сообщение для ответа!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 10 or mb_strlen($_POST['text'], 'utf8') > 2000) {
$error.= 'Сообщение не должно содержать менее 10 и не более 2000 символов!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `mail` set `to`='".win($row['who'])."', `who`='".win($user['login'])."', `date`='".time()."', `status`='1', `tema`='Re: ".win($row['tema'])."', `text`='".win($_POST['text'])."'")) {
echo '<div class="ok"><center>Ответ успешно отправлен!</center></div>
<meta http-equiv="Refresh" content="1; url='.root.'/?act=in"/>';
} else {
echo '<div class="error"><center>Ошибка при добавлении ответа!</center></div>';
}
}
}
echo'<div class="wape">
<form name="form" action="" method="post">
Сообщение:<br/><textarea name="text" cols="30" rows="2"></textarea><br/>
<input type="submit" value="Ответить"/></form></div>'; 
}
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'/?act=in">Входящие</a></div>';
include ('../inc/foot.php');
exit;
}
				
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="wape wape1">' : '<div class="wape wape1">').'
Отправитель: <a href="'.ROOT.'/str/user.php?login='.$row['who'].'">'.utf($row['who']).'</a><br/>
Дата: '.date('d.m в H:i', $row['date']).'<br/>
Статус: '.($row['status'] ? '<font color=red>Непрочитанное</font>' : '<font color=green>Прочитанное</font>').'<br/>
Тема: <a href="'.root.'/?act=in&id='.val($row['id'],1).'">'.utf($row['tema']).' &raquo;</a></div>'; 
}
if ($k_page > 1) navigation(root.'/?act=in&', $k_page, $page);
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Моя почта</a></div>';
break;

case 'out':
echo '<div class="menus menu2"><center>Отправленные сообщения</center></div>';
			
$k_post = mysql_result(mysql_query("select count(*) from `mail` where `who`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `mail` where `who`='".win($user['login'])."' order by `id` desc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Отправленных сообщений нет!<center></div>';
} else {
$count = '';

if (isset($_GET['id'])) {
$sql = mysql_query("select * from `mail` where `who`='".win($user['login'])."' and `id`='".val($id,1)."'");
if (!mysql_num_rows($sql)) {
echo '<div class="error"><center>У вас нет такого сообщения!</center></div>';
} else {
$row = mysql_fetch_assoc($sql);

mysql_query("update `mail` set `status`='0' where `id`='".val($id,1)."' and `to`='".win($user['login'])."'");
						
echo '<div class="wape">
Отправитель: <a href="'.ROOT.'/str/user.php?login='.$row['who'].'">'.utf($row['who']).'</a><br/>
Получатель: <a href="'.ROOT.'/str/user.php?login='.$row['to'].'">'.utf($row['to']).'</a><br/>
Дата: '.date('d.m в H:i', $row['date']).'<br/>
Тема: '.utf($row['tema']).'<br/>
Сообщение: '.nl2br(smiles(utf($row['text']))).'</div>
<div class="menu">'.(isset($_GET['add']) ? '<a href="'.root.'/?act=out&id='.val($id,1).'">Cвернуть</a>' : '<a href="'.root.'/?act=out&id='.val($id,1).'&amp;add">Отправить еще одно</a>').'</div>';

if (isset($_GET['add'])) {
							
$error = '';
							
if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введите сообщение для ответа!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 10 or mb_strlen($_POST['text'], 'utf8') > 2000) {
$error.= 'Сообщение не должно содержать менее 10 и не более 2000 символов!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `mail` set `who`='".win($row['who'])."', `to`='".win($row['to'])."', `date`='".time()."', `status`='1', `tema`='".win($row['tema'])."', `text`='".win($_POST['text'])."'")) {
echo '<div class="ok"><center>Сообщение успешно отправлено!</center></div>
<meta http-equiv="Refresh" content="1; url='.root.'/?act=out"/>';
} else {
echo '<div class="error"><center>Ошибка при добавлении ответа!</center></div>';
}
}
}
echo'<div class="wape">
<form name="form" action="" method="post">
Сообщение:<br/><textarea name="text" cols="30" rows="2"></textarea><br/>
<input type="submit" value="Ответить"/></form></div>'; 
}
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'/?act=out">Отправленные</a></div>';
include ('../inc/foot.php');
exit;
}
				
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="wape wape1">' : '<div class="wape wape1">').'
Отправитель: <a href="'.ROOT.'/user.php?login='.$row['who'].'">'.utf($row['who']).'</a><br/>
Дата: '.date('d.m в H:i', $row['date']).'<br/>
Статус: '.($row['status'] ? 'Непрочитанное' : 'Прочитанное').'<br/>
Тема: <a href="'.root.'/?act=out&id='.val($row['id'],1).'">'.utf($row['tema']).' &raquo;</a></div>'; 
}
if ($k_page > 1) navigation(root.'/?act=out&', $k_page, $page);
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Моя почта</a></div>';
break;
}
} else {
echo'<div class="title">ERROR | Вы не авторизированы</div>
<div class="menu">Для просмотра данной страницы вам необходимо выполнить следующие действия:<br/>
<a href="'.ROOT.'/str/auth.php">Авторизация</a> или <a href="'.ROOT.'/str/reg.php">Регистрация</a></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';
}

include ('../inc/foot.php');
?>