<?php
$title = 'Авторизация';
include ('../inc/head.php');

if (isset($active) == true) {
header('Location: '.ROOT);
} else {
echo '<div class="mybar"><center>'.$title.'</center></div>';
$error = '';

if (isset($_REQUEST['login']) && isset($_REQUEST['pass'])){
if (empty($_REQUEST['login'])) {
$error.= 'Заполните поле логин!<br/>';
}
elseif (mb_strlen($_REQUEST['login']) < 3 or mb_strlen($_REQUEST['login']) > 15) {
$error.= 'Логин должен содержать от 3 до 15 символов!<br/>';
}
elseif (!mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".utf($_REQUEST['login'])."' limit 1"))) {
$error.= 'Пользователь с логином '.utf($_REQUEST['login']).' ненайден!<br/>';
}
elseif (empty($_REQUEST['pass'])) {
$error.= 'Заполните поле пароль!<br/>';
}
elseif (mb_strlen($_REQUEST['pass']) < 3 or mb_strlen($_REQUEST['pass']) > 15) {
$error.= 'Пароль должен содержать от 3 до 15 символов!<br/>';
}
elseif (mysql_num_rows(mysql_query("select * from `users` where `login`='".utf($_REQUEST['login'])."' and `pass`<>'".utf(md5(md5($_REQUEST['pass'])))."' limit 1"))) {
$error.= 'Пароль введен не верно!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
mysql_query("insert into `auth_err` set `time`='".time()."', `pass`='".win($_REQUEST['pass'])."', `log`='".win($_REQUEST['login'])."'");
} else {
$_SESSION['login'] = utf($_REQUEST['login']);
$_SESSION['pass'] = utf(md5(md5($_REQUEST['pass'])));
mysql_query("update `users` set `lasttime`='".time()."', `ip`='".utf($_SERVER['REMOTE_ADDR'])."', `ua`='".$_ua."' where `login`='".win($_REQUEST['login'])."'");
mysql_query("insert into `auth` set `time`='".time()."', `ip`='".utf($_SERVER['REMOTE_ADDR'])."', `ua`='".$_ua."', `log`='".win($_REQUEST['login'])."'");

 

header('Location: '.ROOT.'/cpanel.php/?act=enter');
}
}
echo'<form name="auth" action="" method="post">
<div class="menu">Логин:<br/><input type="text" name="login" maxlength="15"/><br/>
Пароль [<a href="'.ROOT.'/str/forgot.php">Забыли?</a>]:<br/><input type="password" name="pass" maxlength="15"/><br/>
<input type="submit" value="Авторизация"/></div></form>';
echo'<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';

}
include ('../inc/foot.php');
?>