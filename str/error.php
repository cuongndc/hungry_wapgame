<?php

$title = 'Ошибка системы';
include ('../inc/head.php');

define('root', ROOT.'/str/error.php');

echo '<div class="mybar"><center>'.$title.'</center></div>';

echo '<div class="error"><center>Документ не найден!</center></div>';

echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> '.(isset($active) ? '<a href="'.ROOT.'/cpanel.php">В кабинет</a>' : '<a href="'.ROOT.'">На главную</a>').'</div>';


include ('../inc/foot.php');
?>