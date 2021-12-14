<?php

$title = 'Админ панель';
include ('../inc/head.php');

define('root', ROOT.'/panel/');

if (isset($active) && $user['admin'] == 1) {

echo '<div class="mybar"><center>Админ панель</center></div>';
if($user['admin'] == 1){	

echo '<div class="menu1"><img src="'.ROOT.'/img/news.png" width="16" height="16" class="left" /> <a href="news.php">Новости</a> ('.val($count_news,1).')</div>';

echo '<div class="menu1"><img src="'.ROOT.'/img/user.png" width="16" height="16" class="left" /> <a href="info.php">Пользователи</a> (<a href="user.php">Ред</a>) ('.val($count_users,1).')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/referal.png" width="16" height="16" class="left" /> <a href="referal.php">Рефералы</a> ('.val($count_ref_all,1).')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/stop.png" width="16" height="16" class="left" /> <a href="banlist.php">Разбанить</a> ('.val($count_ban,1).')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/stop.png" width="16" height="16" class="left" /> <a href="ban.php">Банить юзера</a></div>';

echo '<div class="menu1"><img src="'.ROOT.'/img/system.png" width="16" height="16" class="left" /> <a href="settings.php">Настройки системы</a></div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/email.png" width="16" height="16" class="left" /> <a href="spam.php">Массовая рассылка</a></div>';

echo '<div class="menu1"><img src="'.ROOT.'/img/addmoney.png" width="16" height="16" class="left" /> <a href="inmoney.php">Ввод средств</a> ('.val($count_in,1).')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/outmon.png" width="16" height="16" class="left" /> <a href="mobilepay.php">Вывод средств</a> ('.val($count_mobile,1).')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/gold.png" width="16" height="16" class="left" /> <a href="invest.php">Инвесторы</a></div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/cash.png" width="16" height="16" class="left" /> <a href="money.php">Начисление  средств</a></div>';

echo '<div class="menu1"><img src="'.ROOT.'/img/autherr.png" width="16" height="16" class="left" /> <a href="autherr.php">Ошибочные входы</a> ('.$count_error.')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/auth.png" width="16" height="16" class="left" /> <a href="authlog.php">Логи авторизаций</a> ('.$count_auth.')</div>';

echo '<div class="menu1"><img src="'.ROOT.'/img/addmoney.png" width="16" height="16" class="left" /> <a href="inlog.php">Логи вводов</a> ('.val($cntin,1).')</div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/outmon.png" width="16" height="16" class="left" /> <a href="outlog.php">Логи выводов</a> ('.val($out_many,1).')</div>';


echo '<div class="menu1"><img src="'.ROOT.'/img/search.png" width="16" height="16" class="left" /> <a href="search.php">Поиск по IP</a></div>';
echo '<div class="menu1"><img src="'.ROOT.'/img/search.png" width="16" height="16" class="left" /> <a href="searchm.php">Поиск по UA</a></div>';

echo '<div class="menu1"><img src="'.ROOT.'/img/reklink.png" width="16" height="16" class="left" /> <a href="reklama.php">Реклама на главной</a></div>';



}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="/cpanel.php">В кабинет</a></div>';
################################################################################
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}
include ('../inc/foot.php');
?>