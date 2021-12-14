<?php
$title = 'Golden Bird';
include ('../inc/head.php');
define('root', ROOT.'/garden/index.php');

require_once('config.php');
require('functions.php');
if (isset($active) == true) {

switch($act) {        
default:

echo '<div class="menus menu2"><center>'.$title.'</center></div>';

$all = mysql_num_rows(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'"));
echo '<div class="wape"><div class="wape wape1">
<img src="img/tree.png" width="16" height="16" class="left" /> У вас птиц: '.$all.'<br/>
<img src="img/peach.png" width="16" height="16" class="left" /> Яиц на складе: '.$user['fruit'].'<br/>    
<img src="img/money.png" width="16" height="16" class="left" /> Серебра: '.$user['serebro'].'</div>';
?></div><?php


echo '<div class="menu1"><img src="img/tree.png" width="16" height="16" class="left" /> <a href="?act=collecting">Сбор яиц</a><br/></div>
<div class="menu1"><img src="img/shop.png" width="16" height="16" class="left" /> <a href="?act=purchase">Покупка птиц</a></div>
<div class="menu1"><img src="img/birzha.png" width="16" height="16" class="left" /> <a href="?act=sale">Продажа плодов</a></div>
<div class="menu1"><img src="img/bank.png" width="16" height="16" class="left" /> <a href="?act=exchange">Обменный пункт</a></div>'; 
echo '<div class="menu1"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';	
break;
/* Мой сад */
case 'collecting':
echo '<div class="menus menu2"><center>Сбор яиц</center></div>';
echo '<div class="wape"><div class="wape wape1"><font color="red"><b>*</b></font>Доход за каждые <b>10</b> минут.</div>';
?></div><?php
$coll = mysql_result(mysql_query("select sum(`fruit`) from `tree` where `login`='".$user['login']."' order by `id` limit 1"), 0);
echo '<div class="menu1"><img src="img/tree.png" width="16" height="16" class="left" /> <a href="?act=collect&id='.$user['login'].'">Собрать все плоды </a><font color="red">'.$coll.'</font><br/></div>';
if ($_GET['msg'] == 'fruit') {
echo '<div class="ok"><center>Плоды собраны!</center></div>';
}    
$all = mysql_num_rows(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'"));
    
if ($all == 0) {
echo '<div class="error"><center>Птицы не куплены!</center></div>';
} else {
$sql = mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'");
        
while ($tree = mysql_fetch_array($sql)) {
echo '<div class="wape"><div class="wape wape1"><img src="img/level.png" width="16" height="16" class="left" /> Уровень птицы: '.$tree['level'].'<br/>
<img src="img/tree.png" width="16" height="16" class="left" /> Доход от птицы: '.doxod($tree['id']).' <img src="img/peach.png" width="16" height="16" class="left" /> <font color="red"><b>*</b></font><br>
'.($tree['fruit'] > 0 ? ' 
<img src="img/peach.png" width="16" height="16" class="left" /> Яиц для сбора: '.$tree['fruit'].'<br/> <a href="?act=collect&id='.$tree['id'].'" title="Собрать яйца"><img src="img/select.png" width="16" height="16" class="left" /> Собрать яйца</a>' : NULL).'</div>';
?></div><?php

}
}



echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
break;    
/* Магазин */
case 'purchase':
echo '<div class="menus menu2"><center>Покупка птиц</center></div>';
echo '<div class="menu1"><img src="img/add.png" width="16" height="16" class="left" /> <a href="?act=seat">Купить птицу</a> за '.$price.' рублей (У Вас '.$user['money'].' руб.)</div>';
echo '<div class="menu1"><img src="../img/info.png" width="16" height="16" class="left" /> <a href="?act=infoup">Информация по уровням</a></div>';      

if ($_GET['msg'] == 'add') {
echo '<div class="ok"><center>Птица куплена!</center></div>';
}
if ($_GET['msg'] == 'add_up') {
echo '<div class="ok"><center>Уровень повышен!</center></div>';
}
$all = mysql_num_rows(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'"));
    
if ($all == 0) {
echo '<div class="error"><center>Птиц нет!</center></div>';
} else {
$sql = mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'");
    while ($tree = mysql_fetch_array($sql)) {
echo '<div class="wape"><img src="img/level.png" width="16" height="16" class="left" /> Уровень птицы: '.$tree['level'].' <a href="?act=up&id='.$tree['id'].'" title="Повысить уровень">Повысить уровень</a> | <a href="?act=infoup">Инфо</a>
<br/><img src="img/peach.png" width="16" height="16" class="left" /> Доход: '.doxod($tree['id']).' яиц</div>';
}
} 
echo '<div class="menu1"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
break;    
/* Банк */
case 'exchange':
echo '<div class="menus menu2"><center>Обменный пункт</center></div>';
if ($_POST) {
$sereb = abs(intval($_POST['serebro']));
        
if ( empty($sereb) || $sereb > $user['serebro']) {
echo 'Введено не верное значение';
} else {
$resu = $user['moneyigra'] + ($sereb * $cred);
mysql_query("UPDATE `users` SET `moneyigra` = '".$resu."', `serebro` = '".($user['serebro'] - $sereb)."' WHERE `id` = '".$user['id']."'");

echo '<div class="ok"><center>Обмен прошел успешно!</center></div>';
}
}
    
echo '<div class="wape">Курс: 1 <img src="img/money.png" width="16" height="16" class="left" /> = '.$cred.' руб.<br />
У вас: '.$user['serebro'].' <img src="img/money.png" width="16" height="16" class="left" /></div>';
    
if ($user['serebro'] < 1) {
echo '<div class="error"><center>У вас не достаточно серебра для обмена!</center></div>';
} else {
echo '<div class="wape"><form action="#" method="POST">
Отдам серебро: (max. '.$user['serebro'].')<br /><input type="text" name="serebro" /><br/>
<input type="submit" value="Продать" /></form></div>';
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
break;
    
/* Рынок */
case 'sale':
echo '<div class="menus menu2"><center>Продажа плодов</center></div>';
if ($_POST) {
$serebro2 = abs(intval($_POST['serebro']));
        
if ( (floor(($user['fruit']/$serebro)) < $serebro2) || empty($serebro2)) {
echo '<div class="error"><center>Введено неверное значение!</center></div>';
} else {
            
$fruit = $user['fruit'] - ($serebro2 * $serebro);
$ser = $user['serebro'] + $serebro2;
mysql_query("UPDATE `users` SET `fruit` = '".$fruit."', `serebro` = '".$ser."' WHERE `id` = '".$user['id']."'");
echo '<div class="ok"><center>Вы успешно купили серебро!</center></div>'; 
}
}
    
echo '<div class="wape">Курс: '.$serebro.' <img src="img/peach.png" width="16" height="16" class="left" /> = 1 <img src="img/money.png" width="16" height="16" class="left" /><br/>
У вас ' . $user['fruit'] . ' <img src="img/peach.png" width="16" height="16" class="left" /></div>';
    
if (floor(($user['fruit']/$serebro)) < 1) {
echo '<div class="error"><center>У вас не достаточно плодов для обмена!</center></div>';
} else {
echo '<div class="wape"><form action="#" method="POST">
Куплю серебро: (max. '.floor(($user['fruit']/$serebro)).')<br /><input type="text" name="serebro" /><br/>
<input type="submit" value="Купить" /></form></div>';  
}
echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
break;

/*test*/
case 'seats':
echo '<div class="mybar"><center>delete birds</center></div>';
$now_trees = mysql_num_rows(mysql_query("SELECT `id` FROM `tree` WHERE `id_user` = '".$user['id']."'"));
if ($user['money'] < $price) {
echo '<div class="error"><center>У Вас не достаточно средств для покупки птицы!</center></div>';
} else if($now_trees > 15) echo '<div class="error"><center>Достигнут лимит птиц!</center></div>';
else {
mysql_query("INSERT INTO `tree` (`level`, `login`, `id_user`) VALUES ('0', '".$user['login']."', '".$user['id']."')");
mysql_query("UPDATE `users` SET `money` = `money` - '$price' WHERE `login`='".$user['login']."'");  
header("Location: ?act=purchase");      
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
break;
/*end test*/



    
/* Покупка пташок */
case 'seat':
echo '<div class="mybar"><center>Покупка птицы</center></div>';
$now_trees = mysql_num_rows(mysql_query("SELECT `id` FROM `tree` WHERE `id_user` = '".$user['id']."'"));
if ($user['money'] < $price) {
echo '<div class="error"><center>У Вас не достаточно средств для покупки птицы!</center></div>';
} else if($now_trees > 20) echo '<div class="error"><center>Достигнут лимит птиц!</center></div>';
else {
mysql_query("INSERT INTO `tree` (`level`, `login`, `id_user`) VALUES ('1', '".$user['login']."', '".$user['id']."')");
mysql_query("UPDATE `users` SET `money` = `money` - '$price' WHERE `login`='".$user['login']."'");  
header("Location: ?act=purchase");      
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
break;
    
/* Повышение уровня*/
case 'up':
echo '<div class="mybar"><center>Повышение уровня</center></div>';
$id = abs(intval($_GET['id']));
$sql = mysql_num_rows(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."' && `id` = '".$id."'"));
    
if (empty($sql)) {
echo '<div class="error"><center>Птица не найдена!</center></div>';
} else {
$tree = mysql_fetch_array(mysql_query("SELECT * FROM `tree` WHERE `id` = '".$id."'"));
if($tree['level'] == 1) $up = '10';
if($tree['level'] == 2) $up = '40';
if($tree['level'] == 3) $up = '60';
if($tree['level'] == 4) $up = '80';
if($tree['level'] == 5) $up = '100';
if($tree['level'] == 6) $up = '120';
if($tree['level'] == 7) $up = '140';
if($tree['level'] == 8) $up = '160';
if($tree['level'] == 9) $up = '180';
if ($up > $user['money']) {
echo '<div class="error"><center>У вас не достаточно средств. Цена для повышения уровня: <b>'.$up.'</b> рублей</center></div>';
} elseif($tree['level'] > 9){
echo '<div class="error"><center>Ваша птица улучшена до максимума!</center></div>';
} else {
		
if (empty($_GET['go'])) {
echo '<div class="menu">Цена повышения уровня: '.$up.' рублей:<br /><img src="img/add.png" width="16" height="16" class="left" />  <a href="?act=up&id='.$id.'&go=yes">Повысить</a> - <a href="?">Отмена</a></div>';
} else {
$tree = mysql_fetch_array(mysql_query("SELECT * FROM `tree` WHERE `id` = '".$id."'"));
mysql_query("UPDATE `tree` SET `level` = '".(++$tree['level'])."' WHERE `id` = '".$id."'");  
mysql_query("UPDATE `users` SET `money` = `money` - '$up' WHERE `login`='".$user['login']."'"); 
echo'<meta http-equiv="Refresh" content="1; url='.root.'?act=purchase"/>';                     
}
}
}
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';	
break;
	
case 'infoup':
echo '<div class="mybar"><center>Информация по уровням</center></div>';

echo '<div class="menu">

<img src="img/level.png" width="16" height="16" class="left" /> Уровень 2 - Доход: 5 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>10</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 3 - Доход: 7 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>40</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 4 - Доход: 9 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>60</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 5 - Доход: 11 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>80</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 6 - Доход: 13 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>100</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 7 - Доход: 15 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>120</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 8 - Доход: 17 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>140</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 9 - Доход: 19 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>160</b> рублей</b><br/>
<img src="img/level.png" width="16" height="16" class="left" /> Уровень 10 - Доход: 21 <img src="img/peach.png" width="16" height="16" class="left" /> - <b>180</b> рублей</b>
	
</div>';
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';	
break;
	
    
/* Сбор персиков */
case 'collect':
echo '<div class="mybar"><center>Сбор плодов</center></div>';
$id = abs(intval($_GET['id']));
    
if (!empty($id)) {
$tree = mysql_fetch_array(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."' && `id` = '".$id."'"));
        
if (empty($tree)) {
echo '<div class="error"><center>Птица не найдена!</center><meta http-equiv="Refresh" content="1; url='.root.'"/></div>';
} else {

$fruit = $tree['fruit'];
if (mysql_num_rows(mysql_query("select * from `ref` where `user`='".win($user['login'])."' limit 1"))) {
$ref = mysql_fetch_assoc(mysql_query("select * from `ref` where `user`='".win($user['login'])."' limit 1"));
mysql_query("update `ref` set `count`=`count`+'".$tree['fruit'] / 100 * $set['refpr']."' where `user`='".win($user['login'])."' limit 1");
mysql_query("update `users` set `fruit`=`fruit`+'".$tree['fruit'] / 100 * $set['refpr']."' where `login`='".win($ref['who'])."'");
}      
mysql_query("UPDATE `tree` SET `fruit` = '0' WHERE `id` = '".$id."'");  
mysql_query("UPDATE `users` SET `fruit` = '".($user['fruit'] + $fruit)."' WHERE `id` = '".$user['id']."'"); 
echo '<div class="ok"><center>Плоды успешно собраны!</center><meta http-equiv="Refresh" content="1; url='.root.'?act=collecting"/></div>'; 
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">Склад ←</a></div>';
}
} else {
$fruit = mysql_result(mysql_query("SELECT SUM(`fruit`) FROM `tree` WHERE `id_user` = '".$user['id']."'"), 0);
mysql_query("UPDATE `tree` SET `fruit` = '0' WHERE `id_user` = '".$user['id']."'");  
mysql_query("UPDATE `users` SET `fruit` = '".($user['fruit'] + $fruit)."' WHERE `id` = '".$user['id']."'"); 
header('Location: '.root);  
}    

break;
}
} else {
echo'<div class="title">ERROR | Вы не авторизированы</div>
<div class="menu">Для просмотра данной страницы вам необходимо выполнить следующие действия:<br/>
<a href="'.ROOT.'/str/auth.php">Авторизация</a> или <a href="'.ROOT.'/str/reg.php">Регистрация</a></div>
<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'">На главную</a></div>';
}

include ('../inc/foot.php');

?>