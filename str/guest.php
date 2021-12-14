<?php

$title = 'Мини-чат';
include ('../inc/head.php');
define('root', ROOT.'/str/guest.php');

if (isset($active) == true) {
switch($act) {
default:
echo'<div class="menus menu2"><center>'.$title.'</center></div>';
echo'<div class="wape"><img src="'.ROOT.'/img/add.png" width="16" height="16" class="left" /> <a href="?act=add">Добавить</a>  | <a href="?refresh='.rand(100,100000).'">Обновить</a></div>';
if ($user['admin'] == 1) {
if (isset($_GET['del'])) {
if (mysql_num_rows(mysql_query("select (`id`) from `guest` where `id`='".val($_GET['del'], 1)."'"))) {
if (isset($_POST['yes'])) {
mysql_query("delete from `guest` where `id`='".val($_GET['del'], 1)."' limit 1");
header('Location: '.root);
}
elseif (isset($_POST['no'])) {
header('Location: '.root);
}

echo'<div class="error">
<form action="" method="post">
Удалить пост?<br/><input type="submit" name="yes" value="Да"/> 
<input type="submit" name="no" value="Нет"/></form></div>';
} else {
header('Location: '.root);
}
}
}
################################################################################	
$k_post = mysql_result(mysql_query("select count(*) from `guest`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
	
$sql = mysql_query("select * from `guest` order by `id` desc limit ".$start.", 10");


$error = '';

if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введи сообщение!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 5) {
$error.= 'Текст должен содержать не менее 5 символов!<br/>';
}
elseif (isset($_SESSION['guest_add'])) {
if ($_SESSION['guest_add'] > time() - 10) {
$error.= 'Антиспам! Лимит 10 секунд!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `guest` set `date`='".time()."', `user`='".win($user['login'])."', `text`='".win($_POST['text'])."'")) {
$_SESSION['guest_add'] = time();
echo '<div class="ok"><center>Сообщение добавлено!</center></div>';
header('Location: '.root.'');
} else {
echo '<div class="error">Ошибка при добавлении сообщения!</div>';
}
}
}
echo'<div class="menu"><form name="form" action="" method="post">

Сообщение:[<a href="'.ROOT.'/str/info.php?act=smiles">Смайлы</a> | <a href="'.ROOT.'/str/info.php?act=bbcode">BB-Коды</a>]
<br/><textarea name="text" rows="3" cols="20"></textarea>
<br/><input type="submit" value="Добавить"/></form></div>';

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Гостевая пуста!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {

$count ++;
echo'<div class="wape">';
echo '<div class="wape wape1">'.sexicon($row['user']).' <a href="'.ROOT.'/str/user.php?login='.$row['user'].'">'.utf($row['user']).'</a> ('.online($row['user']).') ('.date('d.m H:i', $row['date']).') ';
if($user['admin'] == 1) echo'(<a href="'.root.'/?del='.$row['id'].'">D</a>)';
echo'<br/>'.nl2br(smiles(bb(bblinks(utf($row['text']))))).' (<a href="'.root.'/?act=answer&ans='.$row['user'].'">Отв</a>)</div>';
echo'</div>';
}

if ($k_page > 1) navigation('?', $k_page, $page);
}		
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
break;

case 'answer':
echo '<div class="mybar"><center>Добавить ответ</center></div>';
if (isset($_GET['ans'])) {
$error = '';

if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введи сообщение!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 5) {
$error.= 'Текст должен содержать не менее 5 символов!<br/>';
}
elseif (isset($_SESSION['guest_ans'])) {
if ($_SESSION['guest_ans'] > time() - 10) {
$error.= 'Антиспам! Лимит 10 секунд!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `guest` set `date`='".time()."', `user`='".win($user['login'])."', `text`='".win($_POST['text'])."'")) {
$_SESSION['guest_add'] = time();
echo '<div class="ok"><center>Сообщение добавлено!</center></div>';
header('Location: '.root.'');
} else {
echo '<div class="error">Ошибка при добовлении сообщения!</div>';
}
}
}
echo'<div class="menu">
<form name="form" action="" method="post">
Сообщение:[<a href="'.ROOT.'/str/info.php?act=smiles">Смайлы</a> | <a href="'.ROOT.'/str/info.php?act=bbcode">BB-Коды</a>]
<br/><textarea name="text" rows="3" cols="20">[b]'.$_GET['ans'].'[/b], </textarea>
<br/><input type="submit" value="Добавить"/></form></div>';
}

echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Гостевая</a>|<a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
break;

case 'add':
echo '<div class="mybar"><center>Добавить сообщение</center></div>';
$error = '';

if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введи сообщение!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 5) {
$error.= 'Текст должен содержать не менее 5 символов!<br/>';
}
elseif (isset($_SESSION['guest_add'])) {
if ($_SESSION['guest_add'] > time() - 10) {
$error.= 'Антиспам! Лимит 10 секунд!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `guest` set `date`='".time()."', `user`='".win($user['login'])."', `text`='".win($_POST['text'])."'")) {
$_SESSION['guest_add'] = time();
echo '<div class="ok"><center>Сообщение добавлено!</center></div>';
header('Location: '.root.'');
} else {
echo '<div class="error">Ошибка при добавлении сообщения!</div>';
}
}
}
echo'<div class="menu"><form name="form" action="" method="post">

Сообщение:[<a href="'.ROOT.'/str/info.php?act=smiles">Смайлы</a> | <a href="'.ROOT.'/str/info.php?act=bbcode">BB-Коды</a>]
<br/><textarea name="text" rows="3" cols="20"></textarea>
<br/><input type="submit" value="Добавить"/></form></div>';

echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Гостевая</a> | <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
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