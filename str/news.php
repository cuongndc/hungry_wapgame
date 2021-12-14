<?php

$title = 'Новости';
include ('../inc/head.php');

define('root', ROOT.'/str/news.php');

if (isset($active) == true) {
switch($act){
default:
echo '<div class="menus menu2"><center>'.$title.'</center></div>';
		
			
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
echo'<div class="wape">
<a><b>'.utf($row['name']).'</b></a> ('.date('d.m H:i', $row['date']).') '.($row['date'] > time() - 86400 ? '(<span style="color:red">New!</span>)' : null).' ';
echo'<br/>'.nl2br(bb(smiles(utf($row['text'])))).'<br/><img src="'.ROOT.'/img/comments.png" width="16" height="16" class="left" /> <a href="'.root.'/?act=comment&id='.$row['id'].'">Коментарии</a> ('.mysql_result(mysql_query("select count(`id`) from `news` where `news`='".$row['id']."'"), 0).')</div>';			
}			
if ($k_page > 1) navigation('?', $k_page, $page);
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
break;

case 'comment':
if (!mysql_num_rows(mysql_query("select * from `news` where `id`='".val($id, 1)."'"))) {
header('Location: '.root);
} else {
			
$k_post = mysql_result(mysql_query("select count(*) from `news` where `news`='".val($id, 1)."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
				
$sql = mysql_query("select * from `news` where `news`='".val($id, 1)."' order by `id` desc limit ".$start.", 10");
$news = mysql_fetch_assoc(mysql_query("select (`name`) from `news` where `id`='".val($id, 1)."'"));
				
echo '<div class="menus menu2"><center>'.utf($news['name']).'</center></div>';

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Комментариев еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo'<div class="wape wape1">'.sexicon($row['name']).' <a href="'.ROOT.'/str/user.php?login='.$row['name'].'">'.utf($row['name']).'</a> ('.online($row['name']).') ('.date('d.m H:i', $row['date']).')<br/>'.nl2br(smiles(utf($row['text']))).'</div>';
}
if ($k_page > 1) navigation(root.'/?act=comment&id='.val($id, 1).'&', $k_page, $page);
}
				
$error = '';

if (isset($_POST['text'])) {
if (empty($_POST['text'])) {
$error.= 'Введи сообщение!<br/>';
}
elseif (mb_strlen($_POST['text'], 'utf8') < 5) {
$error.= 'Текст должен содержать не менее 5 символов!<br/>';
}
elseif (isset($_SESSION['news_'.val($id, 1).'_comment'])) {
if ($_SESSION['news_'.val($id, 1).'_comment'] > time() - 120) {
$error.= 'Антиспам! Лимит 2 минуты!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
$_SESSION['news_'.val($id, 1).'_comment'] = time();
if (mysql_query("insert into `news` set `date`='".time()."', `news`='".val($id, 1)."', `name`='".win($user['login'])."', `text`='".win($_POST['text'])."'")) {
echo'<meta http-equiv="Refresh" content="1; url='.root.'?act=comment&id='.$id.'"/>';
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

echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">К новостям</a></div>';
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