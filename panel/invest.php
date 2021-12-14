<?php

$title = 'Инвесторы';
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


echo'<div class="menu">* Логин: <font color=green>'.utf($row['login']).'</font><br/>- Баланс: <font color=green>'.$row['money'].'</font> руб<br/>
- Всего введено: <font color=green>'.val(mysql_result(mysql_query("SELECT SUM(`summa`) FROM `money_in` WHERE `login`='".$row['login']."'"), 0),1).'</font> руб<br/>
- Всего выведено: <font color=green>'.number_format(mysql_result(mysql_query("SELECT SUM(`money`) FROM `payment` WHERE `user`='".$row['login']."' AND `status`='on'"), 0),2).'</font> руб<br/>
</div>';
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