<?php

$title = 'Golden Birds Mobile';
include ('inc/head.php');


echo'<div class="mybar"><center>Кабинет '.utf($user['login']).' | '.date('d.m.Y H:i').'<br/>'.date("d.m.y H:i",time()+3*3600).' NSK</center></div>';
echo'<div class="menu">';

echo'<img src="img/cash.png" width="16" height="16" class="left" /> Баланс: '.$user['money'].' руб [<a href="'.ROOT.'/cpanel.php?act=plus">Пополнить</a>]<br/>';
echo'<img src="img/select.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php?act=finance">Мои финансы</a><br/>';

echo'</div>';
echo'<div class="menu"><img src="http://wars.mobi/img/mail.gif" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/mail.php">Моя почта</a> ('.$count_mail_new.')</div>';			
echo'<div class="menu"><img src="img/system.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php/?act=settings">Настройки</a>|<a href="?act=exit">Выход</a></div>';
	    
echo'<div class="mybar"><center>Заполнить номер WMR</center></div>';			

echo'<div class="menu"><form action="" method="post">';
						
if (isset($_POST['wmr'])) {

if (!empty($_POST['wmr']) && mb_strlen($_POST['wmr']) < 1 or mb_strlen($_POST['wmr']) > 16 && !is_numeric($_POST['wmr'])) {
$error.= 'Поле Номер WMR заполнено не верно!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("update `users` set `wmr`='".utf($_POST['wmr'])."' limit 1")) {

echo '<div class="ok"><center>Данные сохранены!</center></div><meta http-equiv="Refresh" content="1; "/>';
} else {
echo '<div class="error"><center>Данные не сохранены!</center></div>';
}
}
}
			
if ($user['wmr'] <1) echo'Номер WMR:<br/><font color="red">Заполнять номер карты можно только 1 раз!</font> Без пробелов</br><input type="text" name="wmr" value="'.utf($user['wmr']).'" maxlength="13"/><br/>
<input type="submit" value="Сохранить"/></form></div>';
 else {
	echo '<div class="error"><center>Данные сохранены! Заполнять Номер телефона можно только 1 раз</center></div>';
	}
	
			
echo'</div>';




include ('inc/foot.php');
?>