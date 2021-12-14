<?php

$title = 'Информация';
include ('../inc/head.php');

define('root', ROOT.'/str/info.php');

switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';

echo'<div class="menu1">• <a href="'.root.'/?act=rules">Правила сайта</a></div>';
echo'<div class="menu1">• <a href="'.root.'/?act=smiles">Справка по смайлам</a></div>';
echo'<div class="menu1">• <a href="'.root.'/?act=bbcode">Справка по BB-Кодам</a></div>';



echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> '.(isset($active) ? '<a href="'.ROOT.'/cpanel.php">В кабинет</a>' : '<a href="'.ROOT.'">На главную</a>').'</div>';
break;

case 'bbcode':
echo '<div class="mybar"><center>Справка по BB-Кодам</center></div>';
echo'<div class="menu"><b>Жирный шрифт</b> - [b]Текст[/b]<br/>
<i>Наклоненный шрифт</i> - [i]Текст[/i]<br/>
<u>Подчеркнутый шрифт</u> - [u]Текст[/u]<br/>
Перенос текста - [br]<br/>
<del>Зачеркнутый шрифт</del> - [del]Текcт[/del]<br/>
<small>Маленький шрифт</small> - [small]Текст[/small]<br/>
<span style="color:red">Цветной шрифт</span> - [color=Цвет]Текст[/color]</div>';

echo'<div class="tfoot"><img src="'.ROOT.'/img/info.png" width="16" height="16" class="left" /> <a href="'.root.'">Информация</a></div>';
break;

case 'smiles':
echo '<div class="mybar"><center>Справка по смайлам</center></div>';
for ($i = 1; $i <= count(glob('../img/smiles/*.gif')); $i++) {
echo '<div class="menu"><img src="'.ROOT.'/img/smiles/'.$i.'.gif" alt=""/> - :'.$i.':</a></div>';
}

echo'<div class="tfoot"><img src="'.ROOT.'/img/info.png" width="16" height="16" class="left" /> <a href="'.root.'">Информация</a></div>';
break;

case 'rules':
echo '<div class="menus menu2"><center>Правила сайта</center></div>';
################################################################################
echo'<div class="wape">';
echo '<div class="wape wape1"><span style="color:green"><b>Права и обязанности сторон.</b></span></div>';
################################################################################
echo'<div class="wape"><span style="color:red">1.1</span>. Принимать участие в игре «msbirds.ru» могут только лица, достигшие гражданской дееспособности по законодательству страны своей резиденции. Все последствия неисполнения данного условия возлагаются на участника.</br>
<span style="color:red">1.2</span>. Степень и способ участия в игре определяются самим участником, но не могут противоречить настоящему Соглашению и правилам игровой площадки.
</div>';

################################################################################
echo '<div class="wape wape1"><span style="color:green"><b>Правила вывода средств:</b></span></div>';
################################################################################
echo'<div class="wape"><span style="color:red">3</span>. Заявку можно подать при наборе минимальной суммы установленной в системе.</br>
<span style="color:red">2.1</span>. Выплата производится строго на кошелек системы webmoney,кредитную карту и на мобильный счет.</br>
<span style="color:red">2.2</span>. Администрация производит вывод в установленные дни.</br>
<span style="color:red">2.3</span>. Администрация вправе взимать комиссию за вывод средств.</br>
<span style="color:red">2.4</span>. При блокировке аккаунта выплаты не производятся.</br>
<span style="color:red">2.5</span>. Выплаты производятся в течении 7 рабочих дней с момента подачи заявки.</div>';


################################################################################
echo '<div class="wape wape1"><span style="color:green"><b>Общие правила системы:</b></span></div>';
################################################################################
echo'<div class="wape">
<span style="color:red">3.1</span>. Запрещено флудить в мини-чате.</br>
<span style="color:red">3.2</span>. Запрещено оскорбление участников системы.</br>
<span style="color:red">3.3</span>. Запрещен спам в личную почту пользователей с просьбой зарегистрироваться где либо.</br>
<span style="color:red">3.4</span>. Запрещен мат в мини-чате в любом контексте</br>
<span style="color:red">3.5</span>. Запрещено оскорблении администрации системы.</br>
<span style="color:red">3.6</span>. Любой обман системы, попытки взлома, использование недостоверных данных при регистрации будут серьёзно наказываться Администрацией, вплоть до удаления всех аккаунтов, причастных к вышеуказанным действиям.</br>
</div>';
?></div><div class="wape"><?php
echo'<div class="wape wape1">
За нарушение Правил, аккаунты блокируются администратором без предупреждения!</div>
<div class="wape"><img src="'.ROOT.'/img/info.png" width="16" height="16" class="left" /> <a href="'.root.'">Информация</a></div>';
echo'</div>';
echo'</div>';
break;

}

include ('../inc/foot.php');
?>