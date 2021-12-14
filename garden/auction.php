<?php
$title = 'Аукцион';
include ('../inc/head.php');
define('root', ROOT.'/garden/auction.php');

if (isset($active) == true) {

switch($act) {        
default:

echo '<div class="mybar"><center>'.$title.'</center></div>';

$time = time();
$timenext = $time+30*60;


$result = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
//Если еще не было игр:
if(!mysql_num_rows($result)){
mysql_query("INSERT into `auction` VALUES('0','$time','$time','0','0','No gamer','$timenext','0')");
mysql_free_result($result);
$result = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
}
			
$game = mysql_fetch_assoc($result);
$end = $game['timelast']-$time+30*60;
if($end < 0){
mysql_query("UPDATE `users` SET `fruit`=`fruit`+'$game[bank]' WHERE `login`='$game[login]'");
mysql_query("INSERT into `auction` VALUES('0','$time','$time','0','0','No gamer','$timenext','0')");
mysql_free_result($result);
$result = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
$game = mysql_fetch_assoc($result);
}

echo'<div class="menu">- Игра номер: '.$game['gid'].'<br/>';
$datestart = date('d/m/Y H:i',$game['timestart']);
echo'- Начало игры: '.$datestart.'<br/>';
if($game['login']!=$user['login'])
echo'- Текущий игрок: Не вы<br/>';
else
echo'- Текущий игрок: Вы<br/>';
echo'- Банк игры: '.round($game['bank'],2).' пл.<br/>';
echo'- Тек. ставка: '.round($game['stavka'],2).'<br/>';
$end = $game['timelast']-$time+30*60;
if($end>=2*3600){
$chas = ceil($end/3600);
echo'- До завершения аукциона: '.$chas.' часов<br/>';
}
elseif($end>=3600){
$min = ceil(($end-3600)/60);
echo'- До завершения аукциона 1 час,'.$min.' минут <br/>';
}else{
$min = intval(($end)/60);
$sec = $end%60;
echo'- До завершения аукциона '.$min.' минут , '.$sec.' сек<br/>';
}
echo'- Всего ставок: '.$game['allstav'].'</div>';
		
/*$cntwin = 0;
$res_win = mysql_query("SELECT * from auction WHERE gid!=$game[gid] ORDER by gid DESC limit 1");
while($gm = mysql_fetch_assoc($res_win)){
if($gm['login']==$user['login'])
$cntwin++;
} */
//if($cntwin > 1)
echo'<div class="menu">- <a href="?act=new">Добавить ставку</a></div>';
//else
//echo'<div class="error"><center>Вы не можете сделать ставку, дождитесь следующей игры!</center></div>';
echo'<div class="menu">- <a href="?act=stat">Статистика игр</a></div>';
if($user['admin']==1) echo'<div class="menu">- <a href="?act=stav&amp;gid='.$game['gid'].'">Ставки</a></div>';

 
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';	
break;
/* Новая ставка */
case 'new':

$time = time();
$timenext = $time+30*60;
$result = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
//Если еще не было игр:
if(!mysql_num_rows($result)){
mysql_query("INSERT into `auction` VALUES('0','$time','$time','0','0','No gamer','$timenext','0')");
mysql_free_result($result);
$result=mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
}
$game=mysql_fetch_assoc($result);
if($game['timelast']<$time-30*60){
mysql_query("UPDATE `users` SET `fruit`=`fruit`+'$game[bank]' WHERE `login`='$game[login]'");
mysql_query("INSERT into `auction` VALUES('0','$time','$time','0','0','No gamer','$timenext','0')");
mysql_free_result($result);
$result = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1 ");
$game = mysql_fetch_assoc($result);
}
		
if(!isset($_GET['act'])){
//print "ставка в игре: 50.<br />";
}else{
$err='';
$stavka = $game['stavka']+20;
if($stavka>$user['fruit']) 
$err.='Недостаточно плодов!<br />';
$cntwin=0;
$res_win=mysql_query("SELECT * from auction WHERE gid!=$game[gid] ORDER by gid DESC limit 1");
while($gm=mysql_fetch_assoc($res_win)){
if($gm['login']==$user['login'])
$cntwin++;
}
if($cntwin>=1)
$err.='Вы не можете сделать ставку, дождитесь следующей игры<br />';
if($err)
print $err;
else{
mysql_query("UPDATE `users` SET `fruit`=`fruit`-'$stavka' WHERE `id`='$user[id]'");
$tobank = $stavka-10;
mysql_query("UPDATE `auction` SET `bank`=`bank`+'$tobank',`timelast`='$time',`login`='$user[login]',`stavka`='$stavka',`allstav`=`allstav`+1 WHERE `gid`='$game[gid]'");
mysql_query("INSERT into `auctionstav` VALUES('0','$game[gid]','$time','$stavka','$user[login]')");
echo'<center>Ваша ставка успешно добавлена!</center>';
}
}    


echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">В аукцион</a></div>';
break;    
/* Статистика игр */
case 'stat':
echo '<div class="mybar"><center>Статистика игр</center></div>';
$time = time();
$timenext = $time+24*3600*0.5;

$res_count = mysql_query("SELECT count(*),SUM(bank) from auction WHERE allstav>0");
$cnt = mysql_fetch_row($res_count);
echo'<div class="menu">Всего проведено аукционов: '.$cnt[0].'<br/>';
echo'Сумма выигрышей: '.$cnt[1].'<br/>';
$res_cnt = mysql_query("SELECT COUNT(*) from auctionstav");
$cnt = mysql_fetch_row($res_cnt);
echo'Всего ставок: '.$cnt[0].'</div>';

$result = mysql_query("SELECT * from `auction` order by `gid` DESC limit 1,10 ");
while($game = mysql_fetch_assoc($result)){
$date = date('d/m/Y H:i', $game['timelast']);
echo'<div class="menu">Игра номер: '.$game['gid'].'<br/>
Банк: '.$game['bank'].' пл.<br/>
Победитель: '.$game['login'].'<br/>
Дата: '.$date.'<br/>
Всего ставок: '.$game['allstav'].'</div>';

}



echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">В аукцион</a></div>';
break;    
/* Текущие ставки */
case 'stav':
echo '<div class="mybar"><center>Текущие ставки</center></div>';

        
$gid = intval($_GET['gid']);
$result = mysql_query("SELECT * from `auctionstav` WHERE `gid`='$gid'");
@mysql_data_seek($result, $start);
while($rul = mysql_fetch_assoc($result)){
$date = date('d-m-Y H:i',$rul['time']);
echo'<div class="menu">'.$rul['login'].'</a>| '.$date.' |Ставка: '.$rul['stavka'].'</div>';

}


echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a>|<a href="'.root.'">В аукцион</a></div>';
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