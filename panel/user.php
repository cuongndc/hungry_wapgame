<?php

$title = 'Пользователи';
include ('../inc/head.php');
define('root', ROOT.'/panel/user.php');

if (isset($active) && $user['admin'] == 1) {

if (!isset($_GET['login'])) {
echo '<div class="mybar"><center>'.$title.'</center></div>';
		
$k_post = mysql_result(mysql_query("select count(*) from `users`"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10; 
	
$sql = mysql_query("select * from `users` order by `id` limit ".$start.", 10");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Пользователей нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo'<div class="menu">'.sexicon($row['login']).' <a href="'.root.'/?login='.$row['login'].'">'.utf($row['login']).'</a>
 ('.online($row['login']).') ('.date('d.m.y H:i', $row['datereg']).')<br/></div>';
}
if ($k_page > 1) navigation(root.'/?', $k_page, $page);
}		
echo '<div class="tfoot"><img src="'.ROOT.'/img/home.png" width="16" height="16" class="left" /> '.(isset($active) ? '<a href="'.ROOT.'/cpanel.php">В кабинет</a>' : '<a href="'.ROOT.'">На главную</a>').'</div>';
} else {
$sql = mysql_query("select * from `users` where `login`='".win($_GET['login'])."' limit 1");

if (!mysql_num_rows($sql)) {
header('Location: '.root);
} else {
$row = mysql_fetch_assoc($sql);
echo '<div class="mybar"><center>Анкета '.utf($row['login']).'</center></div>';
		
$error = '';
			
if (isset($_POST['name']) && isset($_POST['icq']) && isset($_POST['wmr']) && isset($_POST['wmid'])) {
if (!empty($_POST['wmr']) && !preg_match("#^R[0-9]{12}$#i", $_POST['wmr'])) {
$error.= 'Не верно введен WMR кошелек!<br/>';
}
if (!empty($_POST['name']) && mb_strlen($_POST['name'], 'utf8') > 25) {
$error.= 'Имя не должно превышать 25 символов!<br/>';
}
if (!empty($_POST['icq']) && mb_strlen($_POST['icq']) < 5 or mb_strlen($_POST['icq']) > 9 && !is_numeric($_POST['icq'])) {
$error.= 'Поле ICQ заполнено не верно!<br/>';
}

if ($error) {
echo '<div class="error"><center>'.$error.'</center></div>';
} else {
if (mysql_query("update `users` set `name`='".win($_POST['name'])."', `icq`='".win($_POST['icq'])."', `wmr`='".win($_POST['wmr'])."', 
 `wmid`='".win($_POST['wmid'])."', `pol`='".val($_POST['pol'], 1)."', `country`='".val($_POST['country'], 1)."', 
 `smiles`='".val($_POST['smiles'], 1)."' where `login`='".$row['login']."' limit 1")) {

echo '<div class="ok"><center>Данные сохранены!</center></div><meta http-equiv="Refresh" content="1; "/>';
} else {
echo '<div class="error"><center>Данные не сохранены!</center></div>';
}
}
}
			
echo'<div class="menu">';
echo'• Логин: <b>'.utf($row['login']).'</b><br/>';
echo'• E-mail: '.utf($row['email']).'</div>';
echo'<div class="menu"><form action="" method="post">';
echo'Ваше имя:<br/><input type="text" name="name" value="'.utf($row['name']).'" maxlength="25"/><br/>';
echo'ICQ:<br/><input type="text" name="icq" value="'.utf($row['icq']).'" maxlength="9"/><br/>';
echo'WMR кошелек:<br/><input type="text" name="wmr" value="'.utf($row['wmr']).'" maxlength="13"/><br/>';
echo'WMID:<br/><input type="text" name="wmid" value="'.utf($row['wmid']).'" maxlength="12"/><br/>';
echo'Ваш пол:<br/><select name="pol">
<option value="0"'.select(0, $row['pol']).'>Женский</option>
<option value="1"'.select(1, $row['pol']).'>Мужской</option>
</select><br/>';
echo'Страна:<br/><select name="country">
<option value="0"'.select(0, $row['country']).'>Россия</option>
<option value="1"'.select(1, $row['country']).'>Украина</option>
<option value="2"'.select(2, $row['country']).'>Беларусь</option>
<option value="3"'.select(3, $row['country']).'>Казахстан</option>
<option value="4"'.select(4, $row['country']).'>Узбекистан</option>
<option value="5"'.select(5, $row['country']).'>Азербайджан</option>
<option value="6"'.select(6, $row['country']).'>Киргизия</option>
<option value="7"'.select(7, $row['country']).'>Эстония</option>
<option value="8"'.select(8, $row['country']).'>Таджикистан</option>
<option value="9"'.select(9, $row['country']).'>Туркменистан</option>
<option value="10"'.select(10, $row['country']).'>Молдавия</option>
<option value="11"'.select(11, $row['country']).'>Армения</option>
<option value="12"'.select(12, $row['country']).'>Грузия</option>
</select><br/>';
echo'Не показывать смайлики: <input type="checkbox" name="smiles" value="1" '.check(1, $user['smiles']).' /><br/>
<input type="submit" value="Сохранить"/></form></div>';


}
echo'<div class="tfoot"><a href="'.ROOT.'/cpanel.php">Кабинет</a>|<a href="'.ROOT.'/panel/">Админ панель</a></div>';
}
} else {

echo '<div class="thead"><center>Доступ запрещен!</center></div>';
echo '<meta http-equiv="Refresh" content="2; url='.ROOT.'"/>';

}
include ('../inc/foot.php');
?>