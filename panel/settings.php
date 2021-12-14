<?php

$title = 'Настройки системы';
include ('../inc/head.php');

define('root', ROOT.'/panel/settings.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';

if(!isset($_POST['ok'])){
echo '<div class="menu">';
echo '<form action="settings.php" method="post" name="form">';
echo 'Минималка в рублях:<br/>';
echo '<input type="text" name="mincost" maxlength="3" value="'.$set['mincost'].'"/><br/>';
echo 'Реф.процент:<br/>';
echo '<input type="text" name="refpr" maxlength="5" value="'.$set['refpr'].'"/><br/>';

echo 'Элементов на страницу:<br/>';
echo '<input type="text" name="pages" maxlength="3" value="'.$set['pages'].'"/><br/>';
echo 'E-Mail админа:<br/>';
echo '<input type="text" name="mail" maxlength="50" class="do_button" value="'.$set['mail'].'"/><br/>';
echo 'Время антифлуда:<br/>';
echo '<input type="text" name="antiflud" maxlength="4" value="'.$set['antiflud'].'"/><br/>';
echo 'Регистрация включена?:<br/>';
echo '<select name="registration">';
if ($set['registration'] == 0){
echo '<option value="0">Нет</option><br/>';
echo '<option value="1">Да</option><br/>';
}else{
echo '<option value="1">Да</option><br/>';
echo '<option value="0">Нет</option><br/>';
}
echo '</select><br/>';

echo '<input name="ok" type="submit" value="Сохранить" /></form></div>';
} else {

$mincost = val($_POST['mincost']);
$refpr = win($_POST['refpr']);
$pages = val($_POST['pages']);
$registration = val($_POST['registration']);
$mail = win($_POST['mail']);
$antiflud = val($_POST['antiflud']);

$error = '';
if(empty($mincost) or empty($refpr) or empty($pages) or empty($antiflud)){
$error .= 'Ошибка! Одно из полей не заполнено!';
}
if (!empty($mail) and !preg_match('#^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+(\.([A-Za-z0-9])+)+$#', $mail)){
$error .= 'Вы ввели неверный адрес e-mail, необходим формат name@site.domen!'; }
if(!empty($error)) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
mysql_query("UPDATE `settings` SET `value` = '".win($mail)."' WHERE `name` = 'mail'");

mysql_query("UPDATE `settings` SET `value` = '".win($mincost)."' WHERE `name` = 'mincost'");
mysql_query("UPDATE `settings` SET `value` = '".win($refpr)."' WHERE `name` = 'refpr'");
mysql_query("UPDATE `settings` SET `value` = '".win($pages)."' WHERE `name` = 'pages'");
mysql_query("UPDATE `settings` SET `value` = '".win($registration)."' WHERE `name` = 'registration'");
mysql_query("UPDATE `settings` SET `value` = '".win($antiflud)."' WHERE `name` = 'antiflud'");

echo '<div class="ok"><center>Настройки успешно изменены!</center></div><meta http-equiv="Refresh" content="1; "/>';
}
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