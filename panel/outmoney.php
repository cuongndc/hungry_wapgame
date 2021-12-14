<?php

$title = 'Админ панель | Заявки на вывод';
include ('../inc/head.php');
define('root', ROOT.'/panel/outmoney.php');

if (isset($active) && $user['admin'] == 1) {

echo '<div class="mybar"><center>'.$title.'</center></div>';

$count = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `outmoney` WHERE `status`='moder'"), 0);

echo '<div class="menu"><center>Всего заявок на вывод средств: '.$count.'</center></div>';

$k_post = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `outmoney` WHERE `status`='moder'"), 0);
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;

$sql = mysql_query("SELECT `id`,`date`,`user`,`money`,`wmr`,`type` FROM `outmoney` WHERE `status`='moder' ORDER BY `id` ASC LIMIT ".$start.", 10");

if ($count) {
if (isset($_GET['true'])) {
$true = val($_GET['true']);
if (mysql_num_rows(mysql_query("SELECT (`id`) FROM `outmoney` WHERE `status`='moder' AND `id`='".$true."'"))) {
mysql_query("UPDATE `outmoney` SET `status`='on' WHERE `id`='".$true."'");
}
		
header('Location: '.root);
} else if (isset($_GET['false'])) {
$false = val($_GET['false']);
		
if (mysql_num_rows(mysql_query("SELECT (`id`) FROM `outmoney` WHERE `status`='moder' AND `id`='".$false."'"))) {
mysql_query("UPDATE `outmoney` SET `status`='lock' WHERE `id`='".$false."'");
}
header('Location: '.root);
}

echo '<table border="1" class="menu" width="100%">
<tr><td>Дата</td><td>Кому</td><td>Сумма</td>
<td>Тип выплат</td><td>Кошелек</td><td>Действие</td></tr>';
	
while ($row = mysql_fetch_assoc($sql)) {
echo '<tr><td>'.date('d.m.Y H:i', $row['date']).'</td><td>'.$row['user'].'</td>
<td>'.RUR($row['money']).'</td><td>'.cost_type($row['type']).'</td><td>'.($row['wmr'] ? utf($row['wmr']) : '-').'</td>
<td><a href="'.ROOT.'/panel/outmoney.php?true='.$row['id'].'">Ок</a>|<a href="'.ROOT.'/panel/outmoney.php?false='.$row['id'].'">Отм</a>
</td></tr>';
}
	
echo '</table>';
	
if ($k_page > 1) navigation(root.'?', $k_page, $page);

} else {
echo '<div class="menu">Заявок на вывод средств нет!</div>';
}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
include ('../inc/foot.php');
?>