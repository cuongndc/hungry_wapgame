<?php

$title = 'Golden Birds Mobile';
include ('inc/head.php');
define('root', ROOT.'/cpanel.php');

if (isset($active) == true) {
switch($act) {
default:


echo'<div class="menus menu2"><center>Главная</center></div>';
include ('akcia.php');

echo'</div></div>';
echo'<div class="menu1"><img src="img/pop.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/mail.php">Моя почта</a> ('.$count_mail_new.')</div>';			
echo'<div class="menu1"><img src="img/system.png" width="16" height="16" class="left" /> <a href="?act=settings">Настройки</a>|<a href="?act=exit">Выход</a></div>';
echo'<div class="menu1"><img src="img/user.png" width="16" height="16" class="left" /> <a href="kabinet.php">Мое меню</a></div>';

echo'</div class="wape wape1">';
$coll = mysql_result(mysql_query("select sum(`fruit`) from `tree` where `login`='".$user['login']."' order by `id` limit 1"), 0);
echo'<div class="menu1"><img src="img/logos.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/garden/">Склад →</a> <font color="red"> + ('.$coll.')</font>
</br>
<small>склад,покупка птиц,обмен плодов...</small>
</div>';
echo'</div>';
if ($user['admin'] == 1) {
echo '<div class="menu1"><img src="img/admin.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/panel/">Админ-панель</a></div>';
}	    
	/*
################################################################################
if ($user['admin'] == 1) {
echo '<div class="menu1"><img src="img/admin.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/panel/">Админ-панель</a></div>';

if (mysql_result(mysql_query("select count(`id`) from `inmoney`"), 0) > 0) echo '<center><div class="panel"><a href="'.ROOT.'/panel/inmoney.php"><font color="red">Просят ввод средств!</font></a>+'.val($count_in, 1).'</div></center>';
if (mysql_result(mysql_query("select count(`id`) from `payment` where `status`='moder'"), 0) > 0) echo '<center><div class="panel"><a href="'.ROOT.'/panel/mobilepay.php"><font color="red">Просят вывод средств!</font></a>+'.val($count_mobile, 1).'</div></center>';
}
################################################################################

*/
echo'<div class="menus menu2"><center>Меню проекта</center></div>';			

	

$re = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
$game = mysql_fetch_assoc($re);
//echo'<div class="menu1"><img src="img/game.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/garden/auction.php">Аукцион</a>  ('.$game['bank'].')</div>';
			
echo'<div class="menu1"><img src="img/news.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/news.php">Новости</a> ('.$count_news . $count_new_news.')<br/></div>';

echo'<div class="menu1"><img src="img/book.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/guest.php">Мини-чат</a> ('.$count_guest . $count_guest_new.')</div>';

echo'<div class="menu1"><img src="img/site.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/online.php">Онлайн игроки</a> ('.$count_online_user.' чел)</div>';

//echo'<div class="menu1"><img src="img/referal.png" width="16" height="16" class="left" /> <a href="?act=ref">Мои рефералы</a> ('.$count_ref.')</div></div>';

echo'<div class="menu1"><img src="img/user.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/user.php">Пользователи</a> ('.val($count_users,1).')</div>';
echo'<div class="menu1"><img src="img/reklink.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/reklama.php">Покупка рекламы</a> ('.val($count_reklama,1).')</div>';
echo'<div class="menu1"><img src="img/info.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/info.php">Правила системы</a></div>';
//echo'<div class="menu1"><img src="img/eagle.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/rate.php">Рейтинги сайта</a></div>';
echo'<div class="menu1"><img src="img/forum.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/str/stat.php">Статистика сайта</a></div>';
break;

################################################################################
case 'paymoneys':
echo '<div class="menus menu2"><center>Пополнение счета</center></div>';
echo'<div class="wape">';
echo'<div class="wape wape1">';
include ('akcia.php');
echo'</div></div>';
echo'<div class="menu1"><img src="img/cash.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/worldkassa/">Пополнить счет worldkassa </a></div>';
echo'<div class="menu1"><img src="img/cash.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/paywk">Пополнить счет wapkassa</a></div>';
echo'<div class="wape"><font color="red">*</font> Worldkassa - Сервий который позволяет пополнить счет через платежные системы webMoney,interkassa,robokassa.</div>';
echo'<div class="wape"><font color="red">*</font> Wapkassa - Сервий который позволяет пополнить счет через платежные системы qiwi,кредитной картой,мобильный счет.</div>';
break;
################################################################################
case 'bonus':
echo '<div class="mybar"><center>Забрать бонус</center></div>';

$unic_code = intval( $_GET['unic_code'] );
if ($unic_code == $_SESSION['unic_code'] and $_SESSION['unic_code'] != ''){
if (isset($user['id'])){
if($user['bonus'] == 0 or $user['bonus'] == ''){$user['bonus'] = 1;}
if(time() > $user['lasttime']){
$ss = rand(1,1);

$bals = rand(1,5);
if ($ss==1) {
mysql_query("UPDATE `users` SET `bonus`=`bonus`+'1' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `users` SET `fruit`=`fruit`+'$bals' WHERE `id`='".$user['id']."'");

echo'<div class="menu"><center>Вы получили '.$bals.' пер!</center></div>';

}
################################################################################
$_SESSION['unic_code'] = rand( 1111, 9999 );
}else{
echo'<div class="error"><center>Попытка накрутки системы!</center></div>';
}
}else{
echo'<div class="error"><center>Вы незарегистрированы!</center></div>';
}
}else{
echo'<div class="error"><center>Ссылка не является уникальной!</center></div>';
} 

	
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;

################################################################################
case 'enter':
echo '<div class="mybar"><center>Авторизация</center></div>';
echo '<div class="menu">Ваши данные:<br/>
IP: <font color=green>'.utf($user['ip']).'</font><br/>
UA: <font color=green>'.utf($user['ua']).'</font><br/>
Время: <font color=green>'.date('d.m.Y H:i', $user['lasttime']).'</font></div>';
echo'<div class="menu"><img src="'.ROOT.'/img/auth.png" width="16" height="16" class="left" /> <a href="?act=auth">Логи авторизаций</a> ('.$authuser.')</div>';				

echo '<div class="menu"><center> <a href="'.root.'">Войти в кабинет</a></center></div>';	
echo'<div class="menu"><center>Автологин:<br/> <input type="text" value="'.ROOT.'/str/auth.php?login='.$_REQUEST['login'].'&pass=Ваш пароль"/></center></div>';
break;
################################################################################
case 'finance':
echo '<div class="menus menu2"><center>Мои финансы</center></div>';
/*
echo '<div class="menu">
- Всего введено: '.val(mysql_result(mysql_query("SELECT SUM(`summa`) FROM `money_in` WHERE `login`='".$user['login']."'"), 0),1).' руб<br/>
- Всего выведено: '.number_format(mysql_result(mysql_query("SELECT SUM(`money`) FROM `payment` WHERE `user`='".$user['login']."' AND `status`='on'"), 0),2).' руб<br/>
- Всего ожидает вывода: '.number_format(mysql_result(mysql_query("SELECT SUM(`money`) FROM `payment` WHERE `user`='".$user['login']."' AND `status`='moder'"), 0),2).' руб
</div>';
*/

echo '<div class="menu1"><a href="?act=rekv">Заполнить реквизиты</a></div>';
echo '<div class="menu1"><a href="?act=paymoneys">Пополнить счет</a></div>';
echo '<div class="menu1"><a href="?act=minus">Вывод денег</a></div>';
echo '<div class="menu1"><a href="?act=history">История выплат</a></div>';				
//echo '<div class="menu1"><a href="?act=in">История пополнений</a></div>';

echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;
################################################################################
case 'rekv':
echo '<div class="mybar"><center>Заполнить реквизиты</center></div>';
echo '<div class="menu">
- Заполнение реквизитов надо для того что бы выводить деньги из сайта.</br>
- Ваши данные никто не увидит.</div>';
echo'<div class="menu1">- <a href="'.ROOT.'/nomer.php">Заполнить номер телефона</a></div>';
echo'<div class="menu1">- <a href="'.ROOT.'/privatbank.php">Заполнить номер карты ПриватБанк</a></div>';
echo'<div class="menu1">- <a href="'.ROOT.'/wmr.php">Заполнить WebMoney кошелек</a></div>';
break; 
################################################################################
case 'history':
echo'<div class="mybar"><center>История выплат</center></div>';
$k_post = mysql_result(mysql_query("select count(*) from `payment` where `user`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
$sql = mysql_query("select * from `payment` where `user`='".win($user['login'])."' limit ".$start.", 10");
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Выводов не было!</center></div>';
}else{
echo '<table border="1" class="menu" width="100%">
<tr><td>Дата</td><td>Куда</td>
<td>Сумма</td><td>Статус</td></tr>';

while ($row = mysql_fetch_assoc($sql)) {
echo '<tr><td>'.date('d.m.Y H:i', $row['date']).'</td><td>'.($row['wmr'] ? utf($row['wmr']) : ''.$row['number'].'').'</td>
<td>'.word($row['money'], 'рубль', 'рубля', 'рублей').'</td>
<td>'.cost($row['status']).'</td></tr>';

}
echo '</table>';
if ($k_page > 1) navigation(root.'/?act=webmoney&', $k_page, $page);
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;		
################################################################################
case 'in':
echo'<div class="mybar"><center>История вводов</center></div>';
$k_post = mysql_result(mysql_query("select count(*) from `money_in` where `login`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
$sql = mysql_query("select * from `money_in` where `login`='".win($user['login'])."' limit ".$start.", 10");
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Вводов не было!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {

echo'<div class="menu">Дата: '.date('d.m.y H:i', $row['time']).'<br/>Сумма: '.utf($row['summa']).' руб</div>';
}
if ($k_page > 1) navigation(root.'/?act=in&', $k_page, $page);
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">Кабинет</a></div>';
break;			
################################################################################
case 'plus':		
echo '<div class="mybar"><center>Ввод средств</center></div>';
$error = '';
if (isset($_POST['col'])) {
if (empty($_POST['col'])) {
$error.= 'Введите сумму для пополнения баланса!<br/>';
}
elseif (!is_numeric($_POST['col'])) {
$error.= 'Не верно введена сумма!<br/>';
}
elseif ($_POST['col'] < 10) {
$error.= 'Минимальная сумма для пополнения 10 руб!<br/>';
}
elseif (isset($_SESSION['birzha_money_add'])) {
if ($_SESSION['birzha_money_add'] > time() - 10) {
$error.= 'Заявку можно подавать раз в 10 секунд!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
$_SESSION['birzha_money_add'] = time();
mysql_query("insert into `inmoney` set `date`='".time()."', `user`='".win($user['login'])."', `money`=`money`+'".val($_POST['col'], 1)."', `wmr`='".win($user['wmr'])."'");
echo'<div class="menu"><center>Подтверждение: '.round(val($_POST['col'], 1)).' WMR<br> <form action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
<form action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
 <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.round(val($_POST['col'], 1)).'">
 <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="0JLQstC+0LQg0YHRgNC10LTRgdGC0LI=">
 <input type="hidden" name="LMI_PAYEE_PURSE" value="R296967543880">
<input type="submit" class="wmbtn" style="font-famaly:Verdana, Helvetica, sans-serif!important;padding:0 10px;height:30px;font-size:12px!important;border:1px solid #538ec1!important;background:#a4cef4!important;color:#fff!important;" value="&#1086;&#1087;&#1083;&#1072;&#1090;&#1080;&#1090;&#1100; ">
</form>
</div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
exit(include ('inc/foot.php'));
}
}
echo'<div class="menu"><center><span style="color:red">Внимание! За ложный ввод средств БАН на месяц!</span></center>
<form action="" method="post">
Сумма:<br/><input type="text" value="10.00" name="col" maxlength="10"/><br/>
<input type="submit" value="Далее →"/></form></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">Кабинет</a></div>'; 
break; 
################################################################################
case 'minus':
echo '<div class="mybar"><center>Вывод средств</center></div>';
echo'<div class=""></div>';
echo'<div class="menu1">- <a href="'.ROOT.'/cpanel.php?act=vivodbank">Вывод на банковскую карту</a></div>';
echo'<div class="menu1">- <a href="'.ROOT.'/cpanel.php?act=minuswmr">Вывод на WebMoney</a></div>';
echo'<div class="menu1">- <a href="'.ROOT.'/cpanel.php?act=mobile">Вывод на мобильный счет</a></div>';

echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">Кабинет</a></div>';
break;
################################################################################
case 'minuswmr':
echo '<div class="menus menu2"><center>Вывод средств</center></div>';
$error = '';
if (isset($_POST['col'])) {
if (empty($_POST['col'])) {
$error.= 'Введите сумму для вывода средств!<br/>';
}
elseif (empty($user['wmr'])) {
$error.= 'Вы не заполнили свой WMR кошелек!<br/>';
}
elseif (!is_numeric($_POST['col'])) {
$error.= 'Не верно введена сумма!<br/>';
}
elseif ($_POST['col'] < $set['mincost']) {
$error.= 'Минимальная сумма для вывода '.utf($set['mincost']).' руб!<br/>';
}
elseif ($user['moneyigra'] <= 0) {
$error.= 'У вас нет средств на балансе!<br/>';
}
elseif ($user['moneyigra'] < $_POST['col']) {
$error.= 'На вашем лицевом счете нет такой суммы!<br/>';
}
elseif (!isset($_SESSION['birzha_money_false'])) {
if ($_SESSION['birzha_money_false'] > time() - 120) {
$error.= 'Заявку можно подавать раз в 2 минуты!<br/>';
}
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
$_SESSION['birzha_money_false'] = time();
$kom = abs($_POST['col']) / 100 * 90;                                                                                                                  
if (mysql_query("insert into `payment` set `date`='".time()."', `type`='cash', `status`='moder', `user`='".win($user['login'])."', `moneyigra`=`moneyigra`+'".$kom."', `wmr`='".win($user['wmr'])."'")) {
mysql_query("update `users` set `moneyigra`=`moneyigra`-'".win($_POST['col'])."' where `login`='".win($user['login'])."' limit 1");
echo'<div class="ok"><center>
Указанная вами сумма '.$kom.' руб поступит на ваш кошелек '.utf($user['wmr']).' 
в течении 7 дней!</center></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">Кабинет</a></div>';
}
exit(include ('inc/foot.php'));
}
}

	
echo'<div class="wape">Баланс: '.utf($user['moneyigra']).' руб.<br/>Комиссия на вывод 15%<br/>
Минимальная сумма для вывода '.utf($set['mincost']).' руб!</center></div>'; 
$k_post = mysql_result(mysql_query("select count(*) from `ref` where `who`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;			
$contaref = mysql_query("select * from `ref` where `who`='".win($user['login'])."' limit ".$start.", 10");
if (mysql_num_rows($contaref) >4)
if ($user['moneyigra'] <= 0) {
echo '<div class="error"><center>У вас нет средств на балансе!</center></div>';
} else {

echo'<div class="wape">
<form action="" method="post">
Сумма:<br/><input type="text" name="col" maxlength="10"/><br/>
<input type="submit" value="Вывод средств"/></form></div>';

}
 {
echo '<div class="wape menu"><center><font color="red">Для вывода надо набрать 5 рефералов</font></center></div>';
}		






echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">Кабинет</a></div>';
break;
################################################################################

case 'mobile':
echo '<div class="menus menu2"><center>Вывод на мобильный</center></div>';
$error = '';

if (isset($_POST['summa']) && isset($_POST['phone']) && isset($_POST['operator'])) {
if (empty($_POST['summa'])) {
$error.= 'Введите сумму для вывода средств!<br/>';
}
elseif (!is_numeric($_POST['summa'])) {
$error.= 'Не верно введена сумма!<br/>';
}
elseif ($_POST['summa'] < 15) {
$error.= 'Минимальная сумма для вывода 15 руб!<br/>';
}
elseif ($user['moneyigra'] <= 0) {
$error.= 'У вас нет средств на балансе!<br/>';
}
elseif ($user['moneyigra'] < $_POST['summa']) {
$error.= 'На вашем лицевом счете нет такой суммы!<br/>';
}
if (empty($_POST['phone'])) {
$error.= 'Введите номер телефона!<br/>';
}
if (!is_numeric($_POST['phone'])) {
$error.= 'Номер должен быть числом!<br/>';
}
elseif (mb_strlen($_POST['phone'], 'utf8') < 11 or mb_strlen($_POST['phone'], 'utf8') > 11) {
$error.= 'Номер должен содержать 11 символов!<br/>';
}
if (!is_numeric($_POST['operator'])) {
$error.= 'Не выбран оператор!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `payment` set `number`='".abs($_POST['phone'])."',`date`='".time()."', `type`='mobile', `moneyigra`='".val($_POST['summa'],1)."', `operator`='".val($_POST['operator'],1)."', `user`='".win($user['login'])."'")) {
mysql_query("update `users` set `moneyigra`=`moneyigra`-'".val($_POST['summa'],1)."' where `login`='".win($user['login'])."' limit 1");
echo '<div class="ok"><center>Заявка успешно отправлена!</center></div><meta http-equiv="Refresh" content="1; url='.root.'"/>';
} else {
echo '<div class="error">Заявка не отправлена!</div>';
}
}
}

echo'<div class="wape"><center>Минимально 15 рублей,на Российские и Украинские  операторы!По курсу webmoney.ru</center></div>';
$k_post = mysql_result(mysql_query("select count(*) from `ref` where `who`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;			
$contaref = mysql_query("select * from `ref` where `who`='".win($user['login'])."' limit ".$start.", 10");
if (mysql_num_rows($contaref) >4)
echo'<div class="wape"><form name="form" action="" method="post">
Сумма:<br/><input type="text" name="summa" maxlength="10" size="6"/><br/>
Номер:(71234567890)<br/><input type="text" name="phone" maxlength="11" size="12"/><br/>
Оператор:<br/><select name="operator">
<option value="1">Мегафон</option>
<option value="2">TELE2</option>
<option value="3">Билайн</option>
<option value="4">МТС</option>
<option value="5">Башселл GSM</option>
<option value="6">Акос</option>
<option value="7">Vodafone Украина</option>
<option value="8">Киевстар</option>
<option value="9">Лайф</option>
<option value="10">Смартс</option>
<option value="11">Мотив</option>
</select><br/>
<input type="submit" value="Отправить"/></form></div>';
 {
echo '<div class="wape menu"><center><font color="red">Для вывода надо набрать 5 рефералов</font></center></div>';
}		

echo'<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;
################################################################################ 
################################################################################

case 'vivodbank':
echo '<div class="menus menu2"><center>Вывод на Банковскую карту</center></div>';
$error = '';

if (isset($_POST['summa']) && isset($_POST['phone']) && isset($_POST['operator'])) {
if (empty($_POST['summa'])) {
$error.= 'Введите сумму для вывода средств!<br/>';
}
elseif (!is_numeric($_POST['summa'])) {
$error.= 'Не верно введена сумма!<br/>';
}
elseif ($_POST['summa'] < 10) {
$error.= 'Минимальная сумма для вывода 10 руб!<br/>';
}
elseif ($user['moneyigra'] <= 0) {
$error.= 'У вас нет средств на балансе!<br/>';
}
elseif ($user['moneyigra'] < $_POST['summa']) {
$error.= 'На вашем лицевом счете нет такой суммы!<br/>';
}
if (empty($_POST['phone'])) {
$error.= 'Введите номер карты!<br/>';
}
if (!is_numeric($_POST['phone'])) {
$error.= 'Номер должен быть числом!<br/>';
}
elseif (mb_strlen($_POST['phone'], 'utf8') < 16 or mb_strlen($_POST['phone'], 'utf8') > 16) {
$error.= 'Номер должен содержать 16 символов!<br/>';
}
if (!is_numeric($_POST['operator'])) {
$error.= 'Не выбран банк!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("insert into `payment` set `number`='".abs($_POST['phone'])."',`date`='".time()."', `type`='mobile', `moneyigra`='".val($_POST['summa'],1)."', `operator`='".val($_POST['operator'],1)."', `user`='".win($user['login'])."'")) {
mysql_query("update `users` set `moneyigra`=`moneyigra`-'".val($_POST['summa'],1)."' where `login`='".win($user['login'])."' limit 1");
echo '<div class="ok"><center>Заявка успешно отправлена!</center></div><meta http-equiv="Refresh" content="1; url='.root.'"/>';
} else {
echo '<div class="error">Заявка не отправлена!</div>';
}
}
}

echo'<div class="wape"><center>Минимально 15 рублей.</center></div>';
$k_post = mysql_result(mysql_query("select count(*) from `ref` where `who`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;			
$contaref = mysql_query("select * from `ref` where `who`='".win($user['login'])."' limit ".$start.", 10");
if (mysql_num_rows($contaref) >4)

echo'<div class="wape"><form name="form" action="" method="post">
Сумма:<br/><input type="text" name="summa" maxlength="10" size="6"/><br/>
Номер:(Без пробелов)<br/><input type="text" name="phone" maxlength="16" size="16"/><br/>
Выберите свой банк:<br/><select name="operator">
<option value="12">ПриватБанк</option>
<option value="13">Ощадбанк</option>
</select><br/>
<input type="submit" value="Отправить"/></form></div>';
 {
echo '<div class="wape menu"><center><font color="red">Для вывода надо набрать 5 рефералов</font></center></div>';
}	

echo'<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;
################################################################################ 
case 'settings':
echo '<div class="menus menu2"><center>Мои настройки</center></div>';
			
$error = '';
			
if (isset($_POST['name']) && isset($_POST['wmr'])) {

if (!empty($_POST['name']) && mb_strlen($_POST['name'], 'utf8') > 25) {
$error.= 'Имя не должно превышать 25 символов!<br/>';
}
if (!empty($_POST['wmr']) && mb_strlen($_POST['wmr']) < 5 or mb_strlen($_POST['wmr']) > 16 && !is_numeric($_POST['wmr'])) {
$error.= 'Поле wmr заполнено не верно!<br/>';
}

if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("update `users` set `name`='".win($_POST['name'])."', `wmr`='".win($_POST['wmr'])."', `pol`='".val($_POST['pol'], 1)."', `country`='".val($_POST['country'], 1)."', 
 `smiles`='".val($_POST['smiles'], 1)."' where `login`='".win($user['login'])."' limit 1")) {

echo '<div class="ok"><center>Данные сохранены!</center></div><meta http-equiv="Refresh" content="1; "/>';
} else {
echo '<div class="error"><center>Данные не сохранены!</center></div>';
}
}
}
echo'<div class="wape"><div class="wape wape1">';			
echo'• E-mail: '.utf($user['email']).'<br/>';
echo'• R-Кошелек: '.utf($user['wmr']).'</div>';
echo'<form action="" method="post">';
echo'Ваше имя:<br/><input type="text" name="name" value="'.utf($user['name']).'" maxlength="25"/><br/>';
echo'WMR:<br/><input type="text" name="wmr" value="'.utf($user['wmr']).'" maxlength="16"/><br/>';

echo'Ваш пол:<br/><select name="pol">
<option value="0"'.select(0, $user['pol']).'>Женский</option>
<option value="1"'.select(1, $user['pol']).'>Мужской</option>
</select><br/>';
echo'Страна:<br/><select name="country">
<option value="0"'.select(0, $user['country']).'>Россия</option>
<option value="1"'.select(1, $user['country']).'>Украина</option>
<option value="2"'.select(2, $user['country']).'>Беларусь</option>
<option value="3"'.select(3, $user['country']).'>Казахстан</option>
<option value="4"'.select(4, $user['country']).'>Узбекистан</option>
<option value="5"'.select(5, $user['country']).'>Азербайджан</option>
<option value="6"'.select(6, $user['country']).'>Киргизия</option>
<option value="7"'.select(7, $user['country']).'>Эстония</option>
<option value="8"'.select(8, $user['country']).'>Таджикистан</option>
<option value="9"'.select(9, $user['country']).'>Туркменистан</option>
<option value="10"'.select(10, $user['country']).'>Молдавия</option>
<option value="11"'.select(11, $user['country']).'>Армения</option>
<option value="12"'.select(12, $user['country']).'>Грузия</option>
</select><br/>';

echo'Не показывать смайлики: <input type="checkbox" name="smiles" value="1" '.check(1, $user['smiles']).' /><br/>
<input type="submit" value="Сохранить"/></form></div>';
			
echo'<div class="menus menu2"><center>Изменить пароль</center></div>';

$error = '';
			
if (isset($_POST['pass']) && isset($_POST['new_pass']) && isset($_POST['last_pass'])) {
if (empty($_POST['pass'])) {
$error.= 'Введите действующий пароль!<br/>';
}
elseif (md5(md5($_POST['pass'])) != $user['pass']) {
$error.= 'Действующий пароль введен не верно!<br/>';
}
elseif (empty($_POST['new_pass'])) {
$error.= 'Введите новый пароль!<br/>';
}
elseif (mb_strlen($_POST['new_pass']) < 3 or mb_strlen($_POST['new_pass']) > 15) {
$error.= 'Новый пароль должен содержать от 3 до 15 символов!<br/>';
}
elseif (empty($_POST['last_pass'])) {
$error.= 'Введите проверочный пароль!<br/>';
}
elseif ($_POST['last_pass'] != $_POST['new_pass']) {
$error.= 'Проверочный пароль введен не верно!<br/>';
}
elseif (md5(md5($_POST['new_pass'])) == $user['pass']) {
$error.= 'У вас задействован этот пароль!<br/>';
}
if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("update `users` set `pass`='".win(md5(md5($_POST['new_pass'])))."' where `login`='".win($user['login'])."' limit 1")) {
$_SESSION['pass'] = md5(md5($_POST['new_pass']));
echo '<div class="ok"><center>Пароль успешно изменен!</center></div>
<meta http-equiv="Refresh" content="1; "/>';
} else {
echo '<div class="error"><center>Пароль не изменен!</center></div>';
}
}
}

echo'<div class="wape">
<form action="" method="post">
Действующий пароль:<br/><input type="password" name="pass" maxlength="15"/><br/>
Новый пароль:<br/><input type="password" name="new_pass" maxlength="15"/><br/>
Повторите пароль:<br/><input type="password" name="last_pass" maxlength="15"/><br/>
<input type="submit" value="Изменить"/></form></div>';
echo'<div class="menu1"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;		
################################################################################
case 'auth':
echo'<div class="mybar"><center>Логи авторизаций</center></div>';
$k_post = mysql_result(mysql_query("select count(*) from `auth` where `log`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
$sql = mysql_query("select * from `auth` where `log`='".win($user['login'])."' limit ".$start.", 10");
if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Записей лог файлов нет!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
echo'<div class="menu">Время: '.date('d.m.Y H:i', $row['time']).'<br/>IP: '.utf($row['ip']).'<br/> UA: '.utf($row['ua']).'<br/></div>';
}
if ($k_page > 1) navigation(root.'/?act=auth&', $k_page, $page);
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;	
################################################################################
case 'ref':
echo'<div class="mybar"><center>Мои рефералы</center></div>';
echo'<div class="menu">Ссылка для установки:<br/><input type="text" value="'.ROOT.'/?ref='.utf($user['login']).'"/></div>';

echo'<div class="menu"><center>Заработок от реферала '.($set['refpr']).'%</center></div>';

$k_post = mysql_result(mysql_query("select count(*) from `ref` where `who`='".win($user['login'])."'"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;			
$sql = mysql_query("select * from `ref` where `who`='".win($user['login'])."' limit ".$start.", 10");
			

if (mysql_num_rows($sql) == 0) {
echo '<div class="menu"><center>У вас нет ни одного реферала!</center></div>';
} else {
while ($row = mysql_fetch_assoc($sql)) {
echo'<div class="menu">
Логин: <a href="'.ROOT.'/str/user.php?login='.$row['user'].'">'.utf($row['user']).'</a><br/>
Доход: '.$row['count'].' <img src="'.ROOT.'/garden/img/peach.png" width="16" height="16" class="left" /></div>';			
}
if ($k_page > 1) navigation(root.'/?act=ref&', $k_page, $page);
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.root.'">Кабинет</a></div>';
break;		
################################################################################
case 'exit':
session_destroy();
mysql_query("delete from `online` where `user`='".win($user['login'])."'");
header('Location: '.ROOT);
break;

}
} else {
echo'<div class="title">ERROR | Вы не авторизированы</div>
<div class="menu">Для просмотра данной страницы вам необходимо выполнить следующие действия:<br/>
<a href="'.ROOT.'/str/auth.php">Авторизация</a> или <a href="'.ROOT.'/str/reg.php">Регистрация</a></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';
}

include ('inc/foot.php');
?>