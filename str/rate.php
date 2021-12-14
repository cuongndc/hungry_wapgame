<?php

$title = 'Рейтинги сайта';
include ('../inc/head.php');

define('root', ROOT.'/str/rate.php');

switch($rate = isset($_GET['rate']) ? win($_GET['rate']) : false){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';

$count_day = mysql_result(mysql_query("select count(`id`) from `users` where `lasttime`>'".mktime(0, 0, 1, date('m'), date('d'), date('Y'))."'"), 0);
$money_rat = mysql_result(mysql_query("select count(*) from `users` where `id`<>'0' and `money`>'0'"),0);
$fruit_rat = mysql_result(mysql_query("select count(*) from `users` where `id`<>'0' and `fruit`>'0'"),0);
$serebro_rat = mysql_result(mysql_query("select count(*) from `users` where `id`<>'0' and `serebro`>'0'"),0);


echo'<div class="menu">


- <a href="?rate=money">Рейтинг по деньгам</a> ('.$money_rat.')<br/>
- <a href="?rate=serebro">Рейтинг по серебру</a> ('.$serebro_rat.')<br/>
- <a href="?rate=fruit">Рейтинг по плодам</a> ('.$fruit_rat.')<br/>
- <a href="?rate=days">Нас посетили</a> ('.$count_day.')<br/>


</div>';
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> '.(isset($active) ? '<a href="'.ROOT.'/cpanel.php">В кабинет</a>' : '<a href="'.ROOT.'">На главную</a>').'</div>';
break;
case 'days':
echo '<div class="mybar"><center>Нас посетили</center></div>';
		
$k_post = mysql_result(mysql_query("select count(`id`) from `users` where `lasttime`>'".mktime(0, 0, 1, date('m'), date('d'), date('Y'))."'"),0);
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
		
$sql = mysql_query("select login,lasttime from `users` where `login`<>'' and `lasttime`>'".mktime(0, 0, 1, date('m'), date('d'), date('Y'))."' order by `id` desc limit ".$start.", 10");
		
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Рейтинг по деньгам пуст!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
echo '<div class="menu">&raquo; <a href="'.ROOT.'/str/user.php?login='.utf($row['login']).'">'.utf($row['login']).'</a> - '.daytime($row['lasttime']).'</div>';
}
if ($k_page > 1) {
navigation(root.'/?rate=days&amp;', $k_page, $page);
}
}
		
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Рейтинги сайта</a></div>';
break;



case 'money':
echo '<div class="mybar"><center>Рейтинг по деньгам</center></div>';
		
$k_post = mysql_result(mysql_query("select count(*) from `users` where `id`<>'0' and `money`>'0'"),0);
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
		
$sql = mysql_query("select login,money from `users` where `id`<>'0' and `money`>'0' order by `money` desc limit ".$start.", 10");
		
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Рейтинг по деньгам пуст!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
echo '<div class="menu">&raquo; <a href="'.ROOT.'/str/user.php?login='.utf($row['login']).'">'.utf($row['login']).'</a> - '.$row['money'].' WMR</div>';
}
if ($k_page > 1) {
navigation(root.'/?rate=money&amp;', $k_page, $page);
}
}
		
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Рейтинги сайта</a></div>';
break;

case 'fruit':
echo '<div class="mybar"><center>Рейтинг по плодам</center></div>';
		
$k_post = mysql_result(mysql_query("select count(*) from `users` where `id`<>'0' and `fruit`>'0'"),0);
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
		
$sql = mysql_query("select login,fruit from `users` where `id`<>'0' and `fruit`>'0' order by `fruit` desc limit ".$start.", 10");
		
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Рейтинг по плодам пуст!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
echo '<div class="menu">&raquo; <a href="'.ROOT.'/str/user.php?login='.utf($row['login']).'">'.utf($row['login']).'</a> - <font color=green>'.$row['fruit'].'</font></div>';
}
if ($k_page > 1) {
navigation(root.'/?rate=fruit&amp;', $k_page, $page);
}
}
		
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Рейтинги сайта</a></div>';
break;	

case 'serebro':
echo '<div class="mybar"><center>Рейтинг по серебру</center></div>';
		
$k_post = mysql_result(mysql_query("select count(*) from `users` where `id`<>'0' and `serebro`>'0'"),0);
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
		
$sql = mysql_query("select login,serebro from `users` where `id`<>'0' and `serebro`>'0' order by `serebro` desc limit ".$start.", 10");
		
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Рейтинг по серебру пуст!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
echo '<div class="menu">&raquo; <a href="'.ROOT.'/str/user.php?login='.utf($row['login']).'">'.utf($row['login']).'</a> - '.$row['serebro'].'</div>';
}
if ($k_page > 1) {
navigation(root.'/?rate=serebro&amp;', $k_page, $page);
}
}
		
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Рейтинги сайта</a></div>';
break;

		

			

		

		
 
		


}

include ('../inc/foot.php');
?>