<?php

$title = 'Поиск по UA';
include ('../inc/head.php');

define('root', ROOT.'/panel/searchm.php');

if (isset($active) && $user['admin'] == 1) {
echo '<div class="mybar"><center>'.$title.'</center></div>';
switch($act){
default:

echo '<div class="menu"><form action="searchm.php?act=view" method="POST">
Введите запрос:<br />
<input type="text" name="text" maxlength="100" /><br />
<input name="search" type="submit" class="go" value="Искать" /></form></div>';
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
break;
case 'view':

if(isset($_POST['search'])){
$text = win($_POST['text']);
$error = '';
if(empty($text)){
$error .= 'Ошибка! Не введен запрос! <br/>';}
if(mb_strlen($text) > 100){
$error .= 'Ошибка! Поле превышает лимит символов! <br/>';}
if(!empty($error)){
echo '<div class="error"><center>'.$error.'</center></div>';
}
}
$k_post = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `ua` LIKE '%".$text."%'"));
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
$sql = mysql_query("SELECT * FROM `users` WHERE `ua` LIKE '%".$text."%' ORDER BY `ua` DESC LIMIT ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="ok"><center>В базе нет сведений!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo (is_integer($count / 2) ? '<div class="menu">' : '<div class="menu">').'
&raquo; Кто: '.utf($row['login']).'<br/>UA: '.utf($row['ua']).'<br/>
IP: '.utf($row['ip']).'<br/>Посл.вход: '.date('d.m.Y H:i:s', $row['lasttime']).'<br/></div>';
}
if ($k_page > 1) navigation('?', $k_page, $page);
}

echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
break;
}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}

include ('../inc/foot.php');
?>