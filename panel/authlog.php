<?php

$title = 'Логи авторизаций';
include ('../inc/head.php');

define('root', ROOT.'/panel/authlog.php');

if (isset($active) && $user['admin'] == 1) {
echo '<div class="mybar"><center>'.$title.'</center></div>';


$k_post = mysql_result(mysql_query("select count(*) from `auth` where `id`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `auth` where `id` order by `id` asc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Записей еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="menu">' : '<div class="menu">').'
&raquo; Кто: '.utf($row['log']).'<br/>
Дата: '.date('d.m.Y H:i', $row['time']).'<br/>
UA: '.utf($row['ua']).'<br/>IP: '.utf($row['ip']).'<br/></div>';}
if ($k_page > 1) navigation('?', $k_page, $page);
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';

} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>