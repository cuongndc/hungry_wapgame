<?php

$title = 'Логи выводов';
include ('../inc/head.php');

define('root', ROOT.'/panel/outlog.php');

if (isset($active) && $user['admin'] == 1) {
echo '<div class="mybar"><center>'.$title.'</center></div>';

$k_post = mysql_result(mysql_query("select count(*) from `payment` where `status`='on'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
$sql = mysql_query("select * from `payment` where `status`='on' limit ".$start.", 10");
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Выводов не было!</center></div>';
}else{
echo '<table border="1" class="menu" width="100%">
<tr><td>Дата</td><td>Куда</td><td>Кому</td>
<td>Сумма</td><td>Статус</td></tr>';

while ($row = mysql_fetch_assoc($sql)) {
echo '<tr><td>'.date('d.m.Y H:i', $row['date']).'</td><td>'.$row['user'].'</td><td>'.($row['wmr'] ? utf($row['wmr']) : ''.$row['number'].'').'</td>
<td>'.word($row['money'], 'рубль', 'рубля', 'рублей').'</td>
<td>'.cost($row['status']).'</td></tr>';

}
echo '</table>';
if ($k_page > 1) navigation(root.'?', $k_page, $page);
}

echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';

} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>