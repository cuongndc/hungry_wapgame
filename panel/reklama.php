<?php

$title = 'Реклама на главной';
include ('../inc/head.php');

define('root', ROOT.'/panel/reklama.php');

if (isset($active) && $user['admin'] == 1) {
switch($act){
default:
echo '<div class="mybar"><center>'.$title.'</center></div>';
$sql = mysql_query("select * from `reklama` where `id`;");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Рекламы нет!</center></div>';
} else {

if (isset($_GET['del'])) {
if (mysql_num_rows(mysql_query("select * from `reklama` where `id`='".val($_GET['del'], 1)."'"))) {
						
if (isset($_POST['yes'])) {
$row = mysql_fetch_assoc($sql);
if (mysql_query("delete from `reklama` where `id`='".val($_GET['del'], 1)."' limit 1")) {
header('Location: '.root);
} else {
echo '<div class="error"><center>Ссылка не удалена!</center></div>';
}
}
elseif ($_POST['no']) {
header('Location: '.root);
}
echo'<div class="menu">
<form name="del_ref" action="" method="post">
Вы действительно хотите удалить ссылку?<br/>
<input type="submit" name="yes" value="Да"/> 
<input type="submit" name="no" value="Нет"/></div></form>';

} else {
header('Location: '.root);
}
}
				
while ($row = mysql_fetch_assoc($sql)) {
echo '<div class="menu">
Название: '.utf($row['name']).'<br/>
Ссылка: <a href="http://'.$row['url'].'">'.utf($row['url']).'</a><br/>
Место: '.val($row['mesto'], 1).' строка<br/>
Переходов сегодня: '.val($row['count']).'<br/>
Переходов всего: '.val($row['count_all']).'<br/>
Жить до: '.date('d.m.y H:i', $row['date']).'<br/>
• <a href="'.root.'/?del='.$row['id'].'">Удалить</a></div>';
}
}
echo '<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ-панель</a></div>';
break;
}

} else {

echo'<div class="title">ERROR | Вы не авторизированы</div>
<div class="menu">Для просмотра данной страницы вам необходимо выполнить следующие действия:<br/>
<a href="'.ROOT.'/auth.php">Авторизация</a> или <a href="'.ROOT.'/reg.php">Регистрация</a></div>
<div class="tfoot"><a href="'.ROOT.'">На главную</a></div>';

}

include ('../inc/foot.php');
?>