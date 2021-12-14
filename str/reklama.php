<?php

$title = 'Покупка рекламы';
include ('../inc/head.php');

define('root', ROOT.'/str/reklama.php');

if (isset($active) == true) {
switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';
$sql = mysql_query("select * from `reklama` where `user`='".win($user['login'])."'");

echo '<div class="menu"><img src="'.ROOT.'/img/cena.png" width="16" height="16" class="left" /> '.(isset($_GET['money']) ? '<a href="'.root.'">Свернуть</a>' : '<a href="'.root.'/?money">Стоимость рекламы</a>').'</div>';

if (isset($_GET['money'])) {
echo'<div class="menu">
Первая строка - 5руб/сутки<br/>
Вторая строка - 4руб/сутки<br/>
Третяя строка - 3руб/сутки<br/>
Четвертая строка -2руб/сутки<br/>
Пятая строка - 1 руб/сутки</div>';
}

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Вы еще не добавляли ссылки!</center></div>';
} else {
if (isset($_GET['del'])) {
if (mysql_num_rows(mysql_query("select * from `reklama` where `user`='".win($user['login'])."' and `id`='".val($_GET['del'], 1)."'"))) {
						
if (isset($_POST['yes'])) {
$row = mysql_fetch_assoc($sql);
if (mysql_query("delete from `reklama` where `id`='".val($_GET['del'], 1)."' and `user`='".win($user['login'])."' limit 1")) {
header('Location: '.root);
} else {
echo '<div class="error"><center>Ссылка не удалена!</center></div>';
}
}
elseif ($_POST['no']) {
header('Location: '.root);
}
echo'<div class="menu">
<form name="del_ref" action="" method="post">
Вы действительно хотите удалить ссылку?<br/>
<input type="submit" name="yes" value="Да"/> <input type="submit" name="no" value="Нет"/> 
</div></form>';
} else {
header('Location: '.root);
}
}
				
while ($row = mysql_fetch_assoc($sql)) {
echo '<div class="menu">
Название: '.utf($row['name']).'<br/>
Ссылка: <a href="http://'.$row['url'].'">'.utf($row['url']).'</a><br/>
Место: '.val($row['mesto'], 1).' строка<br/>
Переходов сегодня: '.val($row['count']).'<br/>
Переходов всего: '.val($row['count_all']).'<br/>
Жить до: '.date('d.m.y H:i', $row['date']).'<br/>
<img src="'.ROOT.'/img/delete.png" width="16" height="16" class="left" /> <a href="'.root.'/?del='.val($row['id'],1).'">Удалить</a></div>';
}
}
if ($count_rekl < 5) {
echo '<div class="menu"><img src="'.ROOT.'/img/add.png" width="16" height="16" class="left" /> <a href="'.root.'/?act=add">Добавить ссылку</a></div>';
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
break;

case 'add':
echo '<div class="mybar"><center>Добавить рекламную ссылку</center></div>';
			
$error = '';

if (isset($_POST['name']) && isset($_POST['url']) && isset($_POST['time']) && isset($_POST['mst']) && isset($_POST['color'])) {
				
/* Стоимость рекламной ссылки */
if ($_POST['mst'] == 1) {
$mesto = 5;}
elseif ($_POST['mst'] == 2) {
$mesto = 4;}
elseif ($_POST['mst'] == 3) {
$mesto = 3;}
elseif ($_POST['mst'] == 4) {
$mesto = 2;
} else {
$mesto = 1;}
				
if ($user['money'] < ($mesto + ($_POST['time'] ? 7 : null))) {
$error.= 'Недостаточно средств на балансе!<br/>';
}
elseif (empty($_POST['name'])) {
$error.= 'Введите название вашей ссылки!<br/>';
}
elseif (mysql_num_rows(mysql_query("select (`mesto`) from `reklama` where `mesto`='".val($_POST['mst'], 1)."'"))) {
$error.= 'Данная строка занята!<br/>';
}
elseif (mb_strlen($_POST['name'], 'utf8') < 5 or mb_strlen($_POST['name'], 'utf8') > 25) {
$error.= 'Название ссылки должно содержать от 5 до 25 символов!<br/>';
}
elseif (mysql_num_rows(mysql_query("select (`name`) from `reklama` where `name`='".win($_POST['name'])."'"))) {
$error.= 'Ссылка с таким названием уже существует!<br/>';
}
if (empty($_POST['url'])) {
$error.= 'Введите url адрес площадки!<br/>';
}
elseif (preg_match("/^http:\/\/[a-zA-Z0-9\/.=?_-]+$/", $_POST['url'])) {
$error.= 'Адрес сайта нужно вводить без http://<br/>';
}
elseif (mb_strlen($_POST['url']) < 5 or mb_strlen($_POST['url']) > 35) {
$error.= 'Адрес ссылки должен содержать от 5 до 35 символов!<br/>';
}
elseif (mysql_num_rows(mysql_query("select (`url`) from `reklama` where `url`='".win($_POST['url'])."'"))) {
$error.= 'Ссылка с таким адресом уже существует!<br/>';
}
if (!is_numeric($_POST['mst'])) {
$error.= 'Не верно выбрано место!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `reklama` set `mesto`='".val($_POST['mst'], 1)."', `user`='".win($user['login'])."', `date`='".($_POST['time'] ? time() + 604800 : time() + 86400)."', `name`='".win($_POST['name'])."', `color`='".win($_POST['color'])."', `url`='".win($_POST['url'])."'")) {
mysql_query("update `users` set `money`=`money`-'".($mesto + ($_POST['time'] ? 7 : null))."' where `login`='".win($user['login'])."' limit 1");
echo '<div class="ok"><center>Ваша ссылка успешно установлена!</center></div>';
} else {
echo '<div class="error"><center>Ваша ссылка не установлена!</center></div>';
}
}
}


echo'<div class="menu"><form action="" method="post">
Название:<br/><input type="text" name="name" maxlength="25"/><br/>
URL адрес:<br/>http://<input type="text" name="url" maxlength="35" size="12"/><br/>
Цвет ссылки:<br/><input type="text" name="color" maxlength="35" size="12"/><br/>
На срок:<br/><select name="time">
<option value="0">Сутки</option>
<option value="1">Неделя</option>
</select><br/>
Место:<br/><select name="mst">
<option value="1">1ая строка</option>
<option value="2">2ая строка</option>
<option value="3">3яя строка</option>
<option value="4">4ая строка</option>
<option value="5">5ая строка</option>
</select><br/>
<input type="submit" value="Добавить ссылку"/>
</form></div>';

echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Покупка рекламы</a></div>';
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