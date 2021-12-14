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
		    
echo'<div class="mybar"><center>Заполнить номер телефона</center></div>';			

echo'<div class="menu"><form action="" method="post">';
						
if (isset($_POST['wmid'])) {

if (!empty($_POST['wmid']) && mb_strlen($_POST['wmid']) < 1 or mb_strlen($_POST['wmid']) > 16 && !is_numeric($_POST['wmid'])) {
$error.= 'Поле Номер карты телефона заполнено не верно!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("update `users` set `wmid`='".utf($_POST['wmid'])."' limit 1")) {

echo '<div class="ok"><center>Данные сохранены!</center></div><meta http-equiv="Refresh" content="1; "/>';
} else {
echo '<div class="error"><center>Данные не сохранены!</center></div>';
}
}
}
			
if ($user['wmid'] <1) echo'Номер телефона:<br/><font color="red">Заполнять номер карты можно только 1 раз!</font> Без пробелов</br><input type="text" name="wmid" value="'.utf($user['wmid']).'" maxlength="13"/><br/>
<input type="submit" value="Сохранить"/></form></div>';
 else {
	echo '<div class="error"><center>Данные сохранены! Заполнять Номер телефона можно только 1 раз</center></div>';
	}
	
			
echo'</div>';




include ('inc/foot.php');
?>