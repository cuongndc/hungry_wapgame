<?php

$title = 'Разбан юзеров';
include ('../inc/head.php');

define('root', ROOT.'/panel/banlist.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';
				
if (isset($_GET['del'])) {
if (mysql_num_rows(mysql_query("select (`id`) from `ban` where `id`='".val($_GET['del'], 1)."'"))) {
if (isset($_POST['yes'])) {					
mysql_query("delete from `ban` where `id`='".val($_GET['del'], 1)."' limit 1");
header('Location: '.root);
}
elseif (isset($_POST['no'])) {
header('Location: '.root);
}

echo'<div class="menu"><form action="" method="post">
Вы точно хотите разбанить юзера?<br/><input type="submit" name="yes" value="Да"/>
<input type="submit" name="no" value="Нет"/></form></div>';
} else {
header('Location: '.root);
}
}
			
			
$k_post = mysql_result(mysql_query("select count(*) from `ban` where `id`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `ban` where `id` order by `id` desc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Забаненных еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="menu">' : '<div class="menu">').'
&raquo; Кто: '.utf($row['who']).' (До '.date('d.m h:i', $row['date']).')<br/> Причина: '.utf($row['reason']).'
'.(isset($user['admin']) ? ' (<a href="'.root.'/?del='.$row['id'].'">Разбанить</a>)' : null).'<br/></div>';
}
if ($k_page > 1) navigation('?', $k_page, $page);
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
break;

}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>