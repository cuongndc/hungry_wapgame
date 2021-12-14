<?php

$title = 'Админ панель | Заявки на вывод';
include ('../inc/head.php');
define('root', ROOT.'/panel/mobilepay.php');

if (isset($active) && $user['admin'] == 1) {

echo '<div class="mybar"><center>'.$title.'</center></div>';


$count = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `payment` WHERE `status`='moder'"), 0);

echo '<div class="menu"><center>Всего заявок на вывод средств: '.$count.'</center></div>';

$k_post = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `payment` WHERE `status`='moder'"), 0);
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;

$sql = mysql_query("SELECT `id`,`date`,`user`,`wmr`,`moneyigra`,`number`,`operator` FROM `payment` WHERE `status`='moder' ORDER BY `id` ASC LIMIT ".$start.", 10");

if ($count) {
if (isset($_GET['true'])) {
$true = val($_GET['true']);
if (mysql_num_rows(mysql_query("SELECT (`id`) FROM `payment` WHERE `status`='moder' AND `id`='".$true."'"))) {
mysql_query("UPDATE `payment` SET `status`='on' WHERE `id`='".$true."'");
}
		
header('Location: '.root);
} else if (isset($_GET['false'])) {
$false = val($_GET['false']);
		
if (mysql_num_rows(mysql_query("SELECT (`id`) FROM `payment` WHERE `status`='moder' AND `id`='".$false."'"))) {
mysql_query("UPDATE `payment` SET `status`='lock' WHERE `id`='".$false."'");
}
header('Location: '.root);
}


echo '<table border="1" class="menu" width="100%">
<tr><td>Дата</td><td>Кому</td><td>Сумма</td>
<td>Оператор</td><td>Номер</td><td>Действие</td></tr>';
while ($row = mysql_fetch_assoc($sql)) {	
if($row['operator'] == 1) {
$opsos = 'Мегафон'; }
elseif($row['operator'] == 2) {
$opsos = 'TELE2';}
elseif($row['operator'] == 3) {
$opsos = 'Билайн';} 
elseif($row['operator'] == 4) {
$opsos = 'МТС';} 
elseif($row['operator'] == 5) {
$opsos = 'Башселл GSM';} 
elseif($row['operator'] == 6) {
$opsos = 'Акос';} 
elseif($row['operator'] == 7) {
$opsos = 'Vodafone Украина';} 
elseif($row['operator'] == 8) {
$opsos = 'Киевстар';} 
elseif($row['operator'] == 9) {
$opsos = 'Лайф';} 
elseif($row['operator'] == 10) {
$opsos = 'Смартс';}
elseif($row['operator'] == 11) {
$opsos = 'Мотив';}
elseif($row['operator'] == 12) {
$opsos = 'ПриватБанк';}
elseif($row['operator'] == 13) {
$opsos = 'Ощадбанк';
} else {
$opsos = 'Webmoney';}
echo '<tr><td>'.date('d.m.Y H:i', $row['date']).'</td><td>'.$row['user'].'</td>
<td>'.word($row['moneyigra']).' руб</td><td>'.$opsos.'</td><td>'.($row['number'] ? utf($row['number']) : ''.$row['wmr'].'').'</td>
<td><a href="'.ROOT.'/panel/mobilepay.php?true='.$row['id'].'">ON</a>|<a href="'.ROOT.'/panel/mobilepay.php?false='.$row['id'].'">OFF</a>
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