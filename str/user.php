<?php
$title = 'Пользователи';
include ('../inc/head.php');

define('root', ROOT.'/str/user.php');
if (isset($active) == true) {

function status($type) {
switch($type) {
default:
return 'Пользователь'; 
break;
case 1:
return '<span style="color:red">Администратор</span>';
break;
}
}
if (!isset($_GET['login'])) {
echo '<div class="menus menu2"><center>'.$title.'</center></div>';

		
$k_post = mysql_result(mysql_query("select count(*) from `users`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
	
$sql = mysql_query("select * from `users` order by `id` limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Пользователей нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo'<div class="wape wape1">'.sexicon($row['login']).' <a href="'.root.'/?login='.$row['login'].'">'.utf($row['login']).'</a> ('.online($row['login']).') ('.date('d.m.y H:i', $row['datereg']).')<br/>
Статус: '.status($row['admin']).'</div>';
}
if ($k_page > 1) navigation(root.'/?', $k_page, $page);
}		
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
} else {
$sql = mysql_query("select * from `users` where `login`='".win($_GET['login'])."' limit 1");
if (!mysql_num_rows($sql)) {
header('Location: '.root);
} else {
$row = mysql_fetch_assoc($sql);
echo '<div class="menus menu2"><center>Анкета '.utf($row['login']).'</center></div>';
		
if (isset($active) && isset($_GET['rate'])) {
if ($row['login'] == $user['login']) {
echo '<div class="error"><center>Вы не можете голосовать за самого себя!</center></div>';
}
elseif (mysql_num_rows(mysql_query("select * from `rate` where `user`='".win($user['login'])."' and `to`='".win($row['login'])."'"))) {
echo '<div class="error"><center>Вы уже голосовали за этого пользователя!</center></div>';
} else {
if ($_GET['rate'] == 'plus') {
mysql_query("update `users` set `rate`=`rate`+'1' where `login`='".win($row['login'])."'");
} else {
mysql_query("update `users` set `rate`=`rate`-'1' where `login`='".win($row['login'])."'");
}
mysql_query("insert into `rate` set `user`='".win($user['login'])."', `to`='".win($row['login'])."'");
header('Location: '.root.'/?login='.win($_GET['login']));
}
}

if($row['country'] == 1) {
$country = 'Украина'; }
elseif($row['country'] == 2) {
$country = 'Беларусь';}
elseif($row['country'] == 3) {
$country = 'Казахстан';} 
elseif($row['country'] == 4) {
$country = 'Узбекистан';} 
elseif($row['country'] == 5) {
$country = 'Азербайджан';} 
elseif($row['country'] == 6) {
$country = 'Киргизия';} 
elseif($row['country'] == 7) {
$country = 'Эстония';} 
elseif($row['country'] == 8) {
$country = 'Таджикистан';} 
elseif($row['country'] == 9) {
$country = 'Туркменистан';} 
elseif($row['country'] == 10) {
$country = 'Молдавия';} 
elseif($row['country'] == 11) {
$country = 'Армения';}
elseif($row['country'] == 12) {
$country = 'Грузия';
} else {
$country = 'Россия';}
################################################################################
$refuser = mysql_result(mysql_query("select count(`id`) from `ref` where `who`='".win($row['login'])."'"), 0);	
$icq = empty($row['icq']) ? 'Незаполнен' : utf($row['icq']);		
$name = empty($row['name']) ? 'Незаполнено' : utf($row['name']);
echo'<div class="wape">';
echo'Логин: '.utf($row['login']).'<br/>';		
echo 'Имя: '.$name.'<br/>';		
echo'Пол: '.sex($row['login']).'<br/>';
echo'Статус: '.status($row['admin']).'<br/>';
echo'Страна: '.$country.'<br/>';
echo'Зарегистрирован: '.date('d/m/y H:i', $row['datereg']).'<br/>';
echo'Посл.вход: '.date('d/m/y H:i', $row['lasttime']).'<br/>';		
		
echo 'Рефералов: '.$refuser.' чел<br/>';		
//echo'ICQ: '.$icq.'<br/>';		
		
if($user['admin'] == 1){
echo'IP: '.utf($row['ip']).'<br/>';
echo'UA: '.utf($row['ua']).'<br/>';
}
echo'</div>';
echo'<div class="wape">';
echo'Рейтинг: '.val($row['rate'], 0).'<br/>'; 
if (isset($active) && !mysql_num_rows(mysql_query("select * from `rate` where `user`='".win($user['login'])."' and `to`='".win($row['login'])."'")) && $row['login'] != $user['login']) {
echo'<a href="'.root.'/?login='.win($_GET['login']).'&amp;rate=plus">За</a> | <a href="'.root.'/?login='.win($_GET['login']).'&amp;rate=minus">Против</a>';
}
echo'</div>';
echo'<div class="wape">
Cообщений в мини-чате: '.mysql_result(mysql_query("select count(`id`) from `guest` where `user`='".win($row['login'])."'"), 0).'<br/>
Kоментариев к новостям: '.mysql_result(mysql_query("select count(`id`) from `news` where `news`<>'' and `name`='".win($row['login'])."'"), 0).'<br/>
</div>';
echo'<div class="wape"><img src="'.ROOT.'/img/write.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/mail.php/?act=add&login='.win($row['login']).'">Написать '.utf($row['login']).'</a></div>';
}

echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
}
} else {
echo'<div class="title">ERROR | Вы не авторизированы</div>
<div class="menu">Для просмотра данной страницы вам необходимо выполнить следующие действия:<br/>
<a href="'.ROOT.'/str/auth.php">Авторизация</a> или <a href="'.ROOT.'/str/reg.php">Регистрация</a></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';

}
include ('../inc/foot.php');
?>