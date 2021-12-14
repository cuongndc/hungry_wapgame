<?php

$title = 'Статистика сайта';
include ('../inc/head.php');
echo'<div class="menus menu2"><center>'.$title.'</center></div>';

echo'<div class="wape">
- Юзеров: '.val($count_users, 1).'<br/>
- Забаненных: '.val($count_ban, 1).'<br/>
- За сегодня: '.val($count_users_new, 1).'<br/>
- Последний: <a href="'.ROOT.'/str/user.php?login='.$user_desc['login'].'"><font color="red">'.utf($user_desc['login']).'</font></a><br/>
- Рефералов: '.val($count_ref_all, 1).'</div>';
echo'<div class="wape">
- Просят вывод: '.val($count_mobile, 1).' чел<br/>
- Выплачено: '.val($max_out, 1).' руб</div>';



$sql = mysql_query("select * from `payment` where `status`='on' order by `id` desc limit 1");
while ($row = mysql_fetch_assoc($sql)) {
echo'<div class="wape">
- Посл.выплата: <font color=green>'.date('d.m.Y H:i', $row['date']).'</font><br/>
- Получил: <font color=green>'.$row['user'].'</font><br/>
- Сумма: <font color=green>'.$row['moneyigra'].'</font> руб</div>';
}


echo'<div class="wape">
- Яиц у юзеров: '.val($count_fruit,1).'<br/>
- Доход от рефералов: '.val($jobs_ref,1).' плодов<br/>

- Серебра у юзеров: '.val($count_serebro,1).'</div>';
$level1 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='1'"), 0);
$level2 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='2'"), 0);
$level3 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='3'"), 0);
$level4 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='4'"), 0);
$level5 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='5'"), 0);
$level6 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='6'"), 0);
$level7 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='7'"), 0);
$level8 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='8'"), 0);
$level9 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='9'"), 0);
$level10 = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='10'"), 0);

echo'<div class="wape">
- Уровень 1: '.val($level1,1).' птиц<br/>
- Уровень 2: '.val($level2,1).' птиц<br/>
- Уровень 3: '.val($level3,1).' птиц<br/>
- Уровень 4: '.val($level4,1).' птиц<br/>
- Уровень 5: '.val($level5,1).' птиц<br/>
- Уровень 6: '.val($level6,1).' птиц<br/>
- Уровень 7: '.val($level7,1).' птиц<br/>
- Уровень 8: '.val($level8,1).' птиц<br/>
- Уровень 9: '.val($level9,1).' птиц<br/>
- Уровень 10: '.val($level10,1).' птиц</div>';



echo '<div class="wape"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> <a href="'.ROOT.'/cpanel.php">В кабинет</a></div>';
include ('../inc/foot.php');
?>