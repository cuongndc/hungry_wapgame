<?php

include ('inc/head.php');

$reklama = mysql_query("select * from `reklama` order by `mesto` limit 5");
if (mysql_num_rows($reklama) != 0) {
echo '<div class="title">Реклама:</div><div class="menu">';
while ($rekl = mysql_fetch_assoc($reklama)) {
echo '- <a href="'.ROOT.'/str/redirect.php?url='.$rekl['url'].'">'.(empty($rekl['color']) ? null : '<span style="color:'.$rekl['color'].'">') . utf($rekl['name']) . (empty($rekl['color']) ? null : '</span>').'</a><br/>';
}
echo '</div>';
}

if (isset($active) == false) {
isset($_GET['ref']) ? $_SESSION['ref'] = win($_GET['ref']) : false;

echo'<div class="wape menu1">';
echo'<a href="'.ROOT.'/str/auth.php">Авторизация</a> |<a href="'.ROOT.'/str/reg.php">Регистрация</a> <a href="'.ROOT.'/str/forgot.php">Забыли пароль?</a></div>';
################################################################################		
echo'<div class="wape">';
?>

<?php


echo'<center><img src="http://money-birds.com/img/top_ribbon.png"width="300" height="100" class="left"/></center>';
echo'<img src="http://money-birds.com/img/birds/index_1.png"width="50" height="50" class="left"/>  <font color="blue"><b>Купите птиц, они будут нести вам яйца.</b></font></br> ';
echo'<img src="http://money-birds.com/img/birds/index_2.png"width="50" height="50" class="left"/>  <font color="blue"><b>Яйца будут накапливаться на складе.</b></font></br>  ';
echo'<img src="http://money-birds.com/img/birds/index_3.png"width="50" height="50" class="left"/>  <font color="blue"><b>Продавайте яйца и получайте за них серебро.</b></font></br>  ';
echo'<img src="http://money-birds.com/img/birds/index_4.png"width="50" height="50" class="left"/>  <font color="blue"><b>Обменивайте серебро на реальные деньги, либо покупайте больше птиц, чтобы они приносили вам еще больше прибыли!</b></font></br>';

echo'<img src="'.ROOT.'/img/tree.png"width="50" height="50" class="left"/>  <font color="blue"><b>Уникальная реф.система,приглашая своих друзей по своей реф.ссылке вы будете получать 15% яиц от их зароботка.</b></font></br> ';



echo'</div>';

echo'</div>';
echo'<div class="wape">';
echo'<div class="wape wape1">Статистика</div>';
echo'
- Старт проекта: 01.02.2017 г<br/>
- Выплачено: '.val($max_out, 1).' руб<br/>';
$sql = mysql_query("select * from `payment` where `status`='on' order by `id` desc limit 1");
while ($row = mysql_fetch_assoc($sql)) {
echo'
- Посл.выплата: <font color=green>'.date('d.m.Y H:i', $row['date']).'</font><br/>
- Получил: <font color=green>'.$row['user'].'</font><br/>
- Сумма: <font color=green>'.$row['moneyigra'].'</font> руб</div>';
}

echo'
</div>';

################################################################################
} else {
header('Location: '.ROOT.'/cpanel.php');
}

include ('inc/foot.php');
?>