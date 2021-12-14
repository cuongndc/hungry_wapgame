<?php
$title = 'Восстановление пароля';
include ('../inc/head.php');

define('root', ROOT.'/str/forgot.php');

if (isset($active) == false) {
echo '<div class="mybar"><center>'.$title.'</center></div>';
	
$error = '';

$_SESSION['rand_pass'] = gen_pass();

if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['code'])) {
if (empty($_POST['login'])) {
$error.= 'Введите логин в системе!<br/>';
}
elseif (mb_strlen($_POST['login']) < 3 or mb_strlen($_POST['login']) > 15) {
$error.= 'Логин должен содержать от 3 до 15 символов!<br/>';
}
elseif (!mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".win($_POST['login'])."'"))) {
$error.= 'Пользователя с таким логином не существует!<br/>';
}
if (empty($_POST['email'])) {
$error.= 'Введите ваш почтовый ящик!<br/>';
}
elseif (!preg_match('|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})$|ius', win($_POST['email']))) {
$error.= 'Поле e-mail заполнено не верно!<br/>';
}
elseif (mysql_num_rows(mysql_query("select (`login`),(`email`) from `users` where `login`='".win($_POST['login'])."' and `email`<>'".win($_POST['email'])."'"))) {
$error.= 'Не верно введен почтовый ящик!<br/>';
}
if (empty($_POST['code'])) {
$error.= 'Введите код с картинки!<br/>';
}
elseif ($_SESSION['code'] != $_POST['code']) {
$error.= 'Код с картинки введен не верно!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("update `users` set `pass`='".md5(md5($_SESSION['rand_pass']))."' where `login`='".win($_POST['login'])."' limit 1")) {

mailto($_POST['email'], 'Восстановление пароля',
'Вы запросили восстановления пароля!<br/>
Ваш новый пароль: '.utf($_SESSION['rand_pass']).'<br/> Ссылка для автологина: '.ROOT.'/str/auth.php?login='.utf($_POST['login']).'&pass='.utf($_SESSION['rand_pass']),
$set['mail']);
echo '<div class="ok"><center>Данные высланы на указанный вами email!</center></div>';
} else {
echo '<div class="error"><center>Ошибка при восстановлении пароля!</center></div>';
}
}
}

echo'<div class="menu">
<form action="" method="post">
Логин:<br/><input type="text" name="login" maxlength="15"/><br/>
E-mail:<br/><input type="text" name="email" maxlength="35"/><br/>
Введите код:<img src="'.ROOT.'/str/code.php" alt="check"/><br/><input type="text" name="code" value="" maxlength="4" size="5"/><br/>
<input type="submit" value="Восстановить"/></form></div>';
echo'<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';
} else {
header('Location: '.root);
}

include ('../inc/foot.php');
?>