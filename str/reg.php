<?php

$title = 'Регистрация';
include ('../inc/head.php');
if($set['registration'] == 1){
echo '<div class="error"><center>Регистрация закрыта!</center></div>';
require_once ('inc/foot.php');
exit; }

if (isset($active) == true) {
header('Location: '.ROOT);
} else {
echo '<div class="mybar"><center>'.$title.'</center></div>';

$error = null;

if (isset($_POST['login']) && isset($_POST['pass']) && !preg_match("#^([A-zА-я-ІіЇїЄє])+$#ui") && isset($_POST['email'])   && isset($_POST['rule']) && isset($_POST['code'])){
if (empty($_POST['login'])) {
$error.= 'Поле логин обязательно для заполнения!<br/>';
}
if (!preg_match('|^([a-z0-9_\.\-]{1,20})$|ius', $_POST['login'])) {
$error.= 'Поле Логин заполнено не верно!Запрещенные символы<br/>';
}

elseif (mb_strlen($_POST['login']) < 3 or mb_strlen($_POST['login']) > 15) {
$error.= 'Логин должен содержать от 3 до 15 символов!<br/>';
  if (!empty($login) && $err1 == false && !preg_match("#^([A-zА-я-ІіЇїЄє])+$#ui", $login)) $err1 = true;
}
elseif (mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".win($_POST['login'])."'"))) {
$error.= 'Пользователь с логином '.utf($_POST['login']).' уже зарегистрирован!<br/>';
}
if (empty($_POST['pass'])) {
$error.= 'Поле пароль обязательно для заполнения!<br/>';
}
elseif (mb_strlen($_POST['pass']) < 3 or mb_strlen($_POST['pass']) > 15) {
$error.= 'Пароль должен содержать от 3 до 15 символов!<br/>';
}
if (!preg_match('|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})$|ius', $_POST['email'])) {
$error.= 'Поле e-mail заполнено не верно!<br/>';
}
elseif (mysql_num_rows(mysql_query("select (`email`) from `users` where `email`='".win($_POST['email'])."'"))) {
$error.= 'Пользователь с таким почтовым ящиком уже зарегистрирован!<br/>';
}
if (empty($_POST['code'])) {
$error.= 'Введите код с картинки!<br/>';
}
elseif ($_SESSION['code'] != $_POST['code']) {
$error.= 'Код с картинки введен не верно!<br/>';
}
if (empty($_POST['rule'])) {
$error.= 'Вы не приняли правила!<br/>';
}


if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `users` set `datereg`='".time()."', `login`='".win($_POST['login'])."', `pass`='".win(md5(md5($_POST['pass'])))."', `wmr`='".win($_POST['wmr'])."', `email`='".win($_POST['email'])."'")) {

if (isset($_SESSION['ref'])) {
if (mysql_num_rows(mysql_query("select (`login`) from `users` where `login`='".win($_SESSION['ref'])."'"))) {
mysql_query("insert into `ref` set `user`='".win($_POST['login'])."', `count`='0', `who`='".win($_SESSION['ref'])."'");
//mysql_query("UPDATE `users` SET `contref` = `contref`+1 WHERE `id` = '".win($_SESSION['ref'])."' where `id`='1'");
} else {
unset($_SESSION['ref']);
}
}

if (mysql_insert_id() == 1) {
mysql_query("update `users` set `admin`='1' where `id`='1'");
}

mailto($_POST['email'], 'Регистрация на сайте '.$_SERVER['HTTP_HOST'],
'Спасибо за регистрацию на нашем сайте!<br/>Ваши данные для входа в личный кабинет:<br/>
Логин '.$_POST['login'].'<br/>Пароль: '.$_POST['pass'].'<br/>
Автологин: '.ROOT.'/str/auth.php?login='.$_POST['login'].'&pass='.$_POST['pass'], $set['mail']);

echo'<div class="menu"><center>Вы успешно зарегистрированы!</center></div>
<div class="menu">Ваши данные для входа:<br/>Логин: '.win($_POST['login']).'<br/>Пароль: '.win($_POST['pass']).'</div>
<div class="menu">Теперь вы можете воспользоваться нашим сайтом, <a href="'.ROOT.'/str/auth.php?login='.win($_POST['login']).'&pass='.win($_POST['pass']).'">Войти</a> в личный кабинет!</div>
<div class="menu">Автологин: <input type="text" value="'.ROOT.'/str/auth.php?login='.win($_POST['login']).'&pass='.win($_POST['pass']).'"/></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';

exit(include ('../inc/foot.php'));
} else {
echo'<div class="menu"><center>Ошибка при регистрации!</center></div>';
}
}
}

echo'<div class="error">Поля отмеченные <span style="color:red">*</span> обязательны для заполнения!</div>
<form name="registration" action="" method="post">
<div class="menu"><span style="color:red">*</span> Логин:<br/><input type="text" name="login" maxlength="15" /><br/>
<span style="color:red">*</span> Пароль:<br/><input type="password" name="pass" maxlength="15" /><br/>
<span style="color:red">*</span> E-mail:<br/><input type="text" name="email" maxlength="35" /><br/>
Введите код:<img src="'.ROOT.'/str/code.php" alt="check"/><br/><input type="text" name="code" value="" maxlength="4" size="5" /><br/>
<input name="rule" type="checkbox" value="1" /> Я согласен с <a href="/str/info.php?act=rules">правилами</a>!<br>
<input type="submit" value="Зарегистрироваться" /></div></form>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>'; 

}
include ('../inc/foot.php');
?>