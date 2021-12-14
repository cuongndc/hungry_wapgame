<?php

$title = 'Начисление  средств';
include ('../inc/head.php');

define('root', ROOT.'/panel/money.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:
echo'<div class="mybar"><center>'.$title.'</center></div>';

$error = '';

if (isset($_POST['col']) && isset($_POST['login'])) {
if (empty($_POST['col'])) {
$error.= 'Введите сумму!<br/>';
}
elseif (!is_numeric($_POST['col'])) {
$error.= 'Не верно введено количество!<br/>';
}
if (empty($_POST['login'])) {
$error.= 'Введите логин получателя!<br/>';
}
elseif (mb_strlen($_POST['login']) < 3 or mb_strlen($_POST['login']) > 15) {
$error.= 'Логин должен содержать от 3 до 15 символов!<br/>';
}
elseif (!mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".win($_POST['login'])."'"))) {
$error.= 'Пользователь '.utf($_POST['login']).' не найден в системе!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {

if (mysql_query("update `users` set `money`=`money`+'".val($_POST['col'], 1)."' where `login`='".win($_POST['login'])."'")){
echo '<div class="ok"><center>Вы успешно начислили '.val($_POST['col'], 1).' руб пользователю '.utf($_POST['login']).'!</center></div>
<meta http-equiv="Refresh" content="1; url='.root.'"/>';
} else {
echo '<div class="error"><center>Ошибка при начислении средств!</center></div>';
}
}
}
echo'<div class="menu">
<form action="" method="post">
Количество:<br/><input type="text" name="col" maxlength="10"/><br/>
Пользователь:<br/><input type="text" name="login" maxlength="15"/><br/>
<input type="submit" value="Начислить"/></form></div>';
echo'<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
break;

}
} else {
echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';
}


include ('../inc/foot.php');
?>