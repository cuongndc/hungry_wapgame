<?php

$title = 'Ввод средств';
include ('../inc/head.php');

define('root', ROOT.'/panel/inmoney.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';

if (isset($_GET['ok']) && isset($_GET['log'])&& isset($_GET['sum'])) {			
if (mysql_num_rows(mysql_query("select (`id`) from `inmoney` where `id`='".val($_GET['ok'], 1)."'"))) {

if (isset($_POST['yes'])) {

mysql_query("insert into `money_in` set `time`='".time()."', `login`='".$_GET['log']."', `summa`='".val($_GET['sum'], 1)."'");					
mysql_query("delete from `inmoney` where `id`='".val($_GET['ok'], 1)."' limit 1");
mysql_query("insert into `mail` set `to`='".win($_GET['log'])."', `who`='".$user['login']."', `date`='".time()."', `status`='1', `tema`='WebMoney Merchant', `text`='Hello, + ".$_GET['sum']." RUB'");
mysql_query("update `users` set `money`=`money`+'".win($_GET['sum'])."' where `login`='".$_GET['log']."' limit 1");
header('Location: '.root);
}
elseif (isset($_POST['no'])) {
header('Location: '.root);
}
echo'<div class="menu"><form action="" method="post">
Ввести средства?<br/><input type="submit" name="yes" value="Да"/> <input type="submit" name="no" value="Нет"/>
</form></div>';
} else {
header('Location: '.root);
}
}
if (isset($_GET['no'])) {
if (mysql_num_rows(mysql_query("select (`id`) from `inmoney` where `id`='".val($_GET['no'], 1)."'"))) {
if (isset($_POST['yes'])) {					
mysql_query("delete from `inmoney` where `id`='".val($_GET['no'], 1)."' limit 1");
header('Location: '.root);
}
elseif (isset($_POST['no'])) {
header('Location: '.root);
}
echo'<div class="menu"><form action="" method="post">
Удалить ввод?<br/><input type="submit" name="yes" value="Да"/>
<input type="submit" name="no" value="Нет"/></form></div>';
} else {
header('Location: '.root);
}
}
$k_post = mysql_result(mysql_query("select count(*) from `inmoney` where `id`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `inmoney` where `id` order by `id` asc limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Заявок на ввод нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="menu">' : '<div class="menu">').'
&raquo; ID: '.utf($row['id']).'<br/>Заказал: '.utf($row['user']).'<br/>Дата: '.date('d.m.Y h:i', $row['date']).'<br/>Сумма: '.utf($row['money']).' WMR<br/>Кошелек: '.utf($row['wmr']).'<br/>
'.(isset($user['admin']) ? '(<a href="'.root.'/?ok='.$row['id'].'&log='.$row['user'].'&sum='.$row['money'].'">Ввести</a>' : null).'</a> | '.(isset($user['admin']) ? '<a href="'.root.'/?no='.$row['id'].'">Отказ</a>)' : null).'</a></div>';
}
if ($k_page > 1) navigation('?', $k_page, $page);
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ-панель</a></div>';
break;

}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>