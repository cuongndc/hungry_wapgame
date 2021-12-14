<?php

$title = 'Онлайн';
include ('../inc/head.php');

define('root', ROOT.'/str/online.php');

if (isset($active) == true) {
echo '<div class="menus menu2"><center>'.$title.'</center></div>';

$k_post = mysql_result(mysql_query("select count(*) from `online` where `date`>'".(time() - 300)."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 

$sql = mysql_query("select * from `online` where `date`>'".(time() - 300)."' limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Онлайн никого нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {

$count ++;
echo'<div class="wape">'.sexicon($row['user']).'<a href="'.ROOT.'/str/user.php?login='.$row['user'].'">'.utf($row['user']).'</a> ('.date('H:i:s', $row['date']).')<br/>';
echo'Находится: '.where($row['where']).'<br/>';
if($user['admin'] == 1){echo'IP адрес: '.utf($row['ip']).'<br/>';}

echo'Юзер Агент: '.utf($row['ua']).'</div>';
}
if ($k_page > 1) navigation(root.'/?', $k_page, $page);
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
} else {
echo'<div class="title">ERROR | Вы не авторизированы</div>
<div class="wape">Для просмотра данной страницы вам необходимо выполнить следующие действия:<br/>
<a href="'.ROOT.'/str/auth.php">Авторизация</a> или <a href="'.ROOT.'/str/reg.php">Регистрация</a></div>
<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';
}
include ('../inc/foot.php');
?>