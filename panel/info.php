<?php

$title = 'Пользователи';
include ('../inc/head.php');

define('root', ROOT.'/panel/info.php');

if (isset($active) && $user['admin'] == 1) {
echo '<div class="mybar"><center>'.$title.'</center></div>';

$k_post = mysql_result(mysql_query("select count(*) from `users` where `id`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `users` where `id` order by `id` desc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Записей еще нет!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
$count_tree = mysql_result(mysql_query("select count(`id`) from `tree` where `login`='".$row['login']."'"), 0);

echo'<div class="menu">* Кто: '.utf($row['login']).'<br/>- Баланс: '.$row['money'].' руб<br/>
- Персиков: '.$row['fruit'].' шт.<br/>- Серебра: '.$row['serebro'].'<br/>
- Деревьев: '.$count_tree.' шт<br/></div>';
}
if ($k_page > 1) navigation('?', $k_page, $page);
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ-панель</a></div>';

} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>