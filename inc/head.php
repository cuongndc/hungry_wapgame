<?php

error_reporting(0);
session_name('SID') . session_start();
header('Cache-Control: private, max-age=3600');

include (dirname(__DIR__) . '/inc/config.php');

//require_once HOME.'/inc/config.php';

mysql_connect(HOST, USER, PASS) or exit('Ошибка подключения к серверу');
mysql_select_db(BASE) or exit('Немогу подключиться к базе');
mysql_query("set names 'utf8'") . mysql_query("set charset 'utf8'");

include (dirname(__DIR__) . '/inc/function.php');

$id = isset($_GET['id']) ? val($_GET['id'], 1) : false;
$act = isset($_GET['act']) ? utf($_GET['act']) : false;
mysql_query("delete from `reklama` where `date`<='".time()."'");
//mysql_query("update `reklama` set `count`='0'");
$title = empty($title) ? 'GOLD BIRD!' : $title;

header("Content-type:text/html; charset=utf-8");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru"><head>';
echo '<title>'.$title.'</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
echo '<link rel="shortcut icon" href="'.ROOT.'/favicon.ico" />';
echo '<link rel="stylesheet" href="'.ROOT.'/style.css" type="text/css" />';
echo '<meta name="keywords" content="Инвестиции,Заработок,Пирамида,Мой сад,Игра" />';
echo '<meta name="description" content="Заработок на инвестициях в игру" />';
echo '<meta name="generator" content="EXTRA HIDE STUDIO" />';
echo'<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=1">';
echo '</head><body>';
echo'<div class="head"><a href="'.ROOT.'"><img src="/img/tree.png"  width="30" height="60"><img src="'.ROOT.'/img/logo.png" width="100" height="80" alt="gbird" /><br/></div></a>';		


################################################################################
if ($user['admin'] == 1) {
//echo '<div class="menu1"><img src="img/admin.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/panel/">Админ-панель</a></div>';

if (mysql_result(mysql_query("select count(`id`) from `inmoney`"), 0) > 0) echo '<center><div class="wape"><a href="'.ROOT.'/panel/inmoney.php"><font color="red">Просят ввод средств!</font></a>+'.val($count_in, 1).'</div></center>';
if (mysql_result(mysql_query("select count(`id`) from `payment` where `status`='moder'"), 0) > 0) echo '<center><div class="wape"><a href="'.ROOT.'/panel/mobilepay.php"><font color="red">Просят вывод средств!</font></a>+'.val($count_mobile, 1).'</div></center>';
}
################################################################################


if($active){
echo ($count_mail_new > 0) ? '<center><div class="panel"><img src="'.ROOT.'/img/pop.png" width="16" height="16" class="left" />
<a href="'.ROOT.'/str/mail.php?act=in">Новое сообщение</a> +'.$count_mail_new.'</div></center>' : false;		
}
/*if ($active){
$extra_n = rand(1,100);
if ($extra_n == 100 or $extra_n == 50 or $extra_n == 1){
$extra_unic = rand(1111111111,9999999999);
$_SESSION['unic_code'] = $extra_unic;
echo '<center><div class="panel"><a href="'.ROOT.'/cpanel.php?act=bonus&unic_code='.$extra_unic.'">Забрать бонус!</a></div></center>';
}
} */


//mysql_query("DELETE FROM `guest` WHERE `date`<".(time() - 3600)."");
/* Бан система юзеров */
mysql_query("DELETE FROM `ban` WHERE `date`<".time()."");
if($active){
if(mysql_num_rows(mysql_query("SELECT who FROM `ban` WHERE `who`='".win($user['login'])."' "))!=0){
$res = mysql_fetch_array(mysql_query("SELECT * FROM `ban` WHERE `who`='".win($user['login'])."' LIMIT 1"));

echo '<div class="menu"><center>Bнимaниe! Baш aккayнт зaбaнeн!<br/>Пpичинa бaнa: '.utf($res['reason']).'<br/>Koнeц бaнa: '.date('G:i:s d.m.Y',$res['date']).'</center></div>';
include (dirname(__FILE__) . '/foot.php');
exit;}} 