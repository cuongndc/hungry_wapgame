<?php

$title = 'My menu';
include ('inc/head.php');
define('root', ROOT.'/kabinet.php');
include_once 'dostj/style.php'; ////// доп. стили для рейтинга
include_once 'dostj/style1.php';  /////// ^^^
/* =================== */
if (isset($active) == true) {
switch($act) {
default:


echo'<div class="menus menu2"><center>Кабинет '.utf($user['login']).' | '.date('d.m.Y H:i').'</center></div>';
include ('akcia.php');
echo'<div class="wape">';
echo'<img src="img/cash.png" width="16" height="16" class="left" /> Игровой Баланс: '.$user['money'].' руб</br>';
echo'<img src="img/cash.png" width="16" height="16" class="left" /> Баланс для вывода: '.$user['moneyigra'].' руб</br>';
echo '</td><td>';
echo '<div class="oh">
<div>
<img src="/dostj/img/about.gif" width="16" height="16" class="left" />  <a class="rate_arrow" href="/dostj/">
    Рейтинг: '.utf($user['reitsbydenikoua']).' <div class="rate_arrow_end"></div>
</a></div>
</div></div>
';
echo' <div class="menu1"><img src="img/select.png" width="16" height="16" class="left" /> <a href="cpanel.php?act=paymoneys">Пополнить баланс </a></div>';
echo'<div class="menu1"><img src="img/select.png" width="16" height="16" class="left" /> <a href="cpanel.php?act=finance">Мои финансы</a></div>';
echo'<div class="menu1"><img src="img/referal.png" width="16" height="16" class="left" /> <a href="cpanel.php?act=ref">Мои рефералы</a> ('.$count_ref.') </div>';
echo'<div class="menu1"><img src="img/referal.png" width="16" height="16" class="left" /> <a href="/dostj">Мои достижения</a></div>';

echo'</div>';echo'</div>';













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