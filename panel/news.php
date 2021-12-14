<?php

$title = 'Новости';
include ('../inc/head.php');

define('root', ROOT.'/panel/news.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';
echo '<div class="menu"><img src="'.ROOT.'/img/add.png" width="16" height="16" class="left" /> <a href="'.root.'/?act=add">Добавить новость</a></div>';
				
if (isset($_GET['del'])) {
if (mysql_num_rows(mysql_query("select (`id`) from `news` where `id`='".val($_GET['del'], 1)."' and `news`=''"))) {
					
if (isset($_POST['yes'])) {
mysql_query("delete from `news` where `id`='".val($_GET['del'], 1)."' limit 1");
header('Location: '.root);
}
elseif (isset($_POST['no'])) {
header('Location: '.root);
}

echo'<div class="menu"><form action="" method="post">
Вы действительно хотите удалить новость?<br/><input type="submit" name="yes" value="Да"/>
<input type="submit" name="no" value="Нет"/></form></div>';
} else {
header('Location: '.root);
}
}

$k_post = mysql_result(mysql_query("select count(*) from `news` where `news`=''"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `news` where `news`='' order by `id` desc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Новостей еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo'<div class="menu">
<a><b>'.utf($row['name']).'</b></a> ('.date('d.m H:i', $row['date']).') '.($row['date'] > time() - 86400 ? '(<span style="color:red">New!</span>)' : null).' ';
if($user['admin'] == 1) echo'(<a href="'.root.'/?del='.$row['id'].'">D</a>)';
echo'<br/>'.nl2br(bb(smiles(utf($row['text'])))).'<br/><img src="'.ROOT.'/img/comments.png" width="16" height="16" class="left" /> <a href="'.root.'/?act=comment&id='.$row['id'].'">Коментарии</a> ('.mysql_result(mysql_query("select count(`id`) from `news` where `news`='".$row['id']."'"), 0).')</div>';			
			
}
if ($k_page > 1) navigation('?', $k_page, $page);
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
break;

case 'comment':
if (!mysql_num_rows(mysql_query("select * from `news` where `id`='".$id."'"))) {
header('Location: '.root);
} else {
			
$k_post = mysql_result(mysql_query("select count(*) from `news` where `news`='".$id."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
				
$sql = mysql_query("select * from `news` where `news`='".$id."' order by `id` desc limit ".$start.", 10");
$news = mysql_fetch_assoc(mysql_query("select (`name`) from `news` where `id`='".$id."'"));
				
echo '<div class="mybar"><center>'.utf($news['name']).'</center></div>';

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Комментариев еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="menu">' : '<div class="menu">').''.sexicon($row['name']).'<a href="'.ROOT.'/user.php?login='.$row['name'].'">'.utf($row['name']).'</a> ('.online($row['name']).') ('.date('d.m H:i', $row['date']).')<br/>'.nl2br(smiles(utf($row['text']))).'</div>
'.(empty($row['answer']) ? null : (is_integer($count / 2) ? '<div class="menu">' : '<div class="menu">').'<span style="color:red">Ответ:</span> '.nl2br(smiles(utf($row['answer']))).'</div>');
}
if ($k_page > 1) navigation(root.'/?act=comment&id='.$id.'&', $k_page, $page);
}
				
$error = '';

if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введи сообщение!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 5) {
$error.= 'Текст должен содержать не менее 5 символов!<br/>';
}
elseif (isset($_SESSION['news_'.$id.'_comment'])) {
if ($_SESSION['news_'.$id.'_comment'] > time() - 120) {
$error.= 'Антиспам! Лимит 2 минуты!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
$_SESSION['news_'.$id.'_comment'] = time();
if (mysql_query("insert into `news` set `date`='".time()."', `news`='".$id."', `name`='".$user['login']."', `text`='".win($_POST['text'])."'")) {
header('Location: '.root.'/?act=comment&id='.$id);
} else {
echo '<div class="error"><center>Ошибка при добавлении коментария!</center></div>';
}
}
}
echo'<div class="menu">
<form name="form" action="" method="post">
Сообщение:<br/><textarea name="text" rows="3" cols="20"></textarea><br/>
<input type="submit" value="Добавить"/></form></div>';
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
break;
		
case 'add':
if ($user['admin'] == 1) {
echo '<div class="mybar"><center>Добавить новость</center></div>';

$error = '';
				
if (isset($_POST['name']) && isset($_POST['text'])) {
if (empty($_POST['name'])) {
$error.= 'Введите название новости!<br/>';
}
elseif (mb_strlen($_POST['name'], 'utf8') < 5 or mb_strlen($_POST['name'], 'utf8') > 500) {
$error.= 'Название должно содержать от 5 до 500 символов!<br/>';
}
if (empty($_POST['text'])) {
$error.= 'Новость не должна быть пуста!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 5) {
$error.= 'Новость не должна быть такой короткой!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `news` set `news`='', `date`='".time()."', `name`='".win($_POST['name'])."', `text`='".win($_POST['text'])."'")) {
header('Location: '.root);
} else {
echo '<div class="error"><center>Новость не добавлена!</center></div>';
}
}
}
				
echo'<div class="menu">
<form name="form" action="" method="post">
Название:<br/><input type="text" name="name" maxlength="500"/><br/>
Новость:<br/><textarea name="text" rows="4" cols="40"></textarea><br/>
<input type="submit" value="Добавить"/></form></div>'; 

echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';				

} else {
header('Location: '.root);
}
break;
}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>