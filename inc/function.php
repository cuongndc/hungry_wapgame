<?php
/* Корневая папка */
define('ROOT', 'http://'.$_SERVER['HTTP_HOST']);
iconv_set_encoding('internal_encoding', 'UTF-8');

/* Защита от XSS */
function xss($text) {
$text = strip_tags($text);
$text = str_replace('&','', $text);
$text = str_replace('$','', $text);
$text = str_replace('<','&lt;', $text);
$text = str_replace('>','&gt;', $text);
$text = str_replace('~','', $text);
$text = str_replace('`','', $text);
$text = str_replace('#','', $text);
$text = str_replace('*','', $text);
$text = str_replace('%','', $text);
$text = str_replace ('\n',' ', $text);
$text = str_replace ('\r','', $text);
$text = htmlentities($text, ENT_QUOTES, 'utf-8');
return $text;
}
/* Дата и время */
date_default_timezone_set('Europe/Moscow');
/* Функция фильтровки данных при выводе из базы */
function utf($str) {
return htmlspecialchars($str, ENT_QUOTES);
}
/* Функция фильтровки данных при записи в базу */
function win($str) {
return mysql_real_escape_string(trim($str));
}
/* Функция фильтровки чисел */
function val($str, $abs = null) {
if ($abs == null) {
return intval($str);
} else {
return abs(intval($str)); }
}
/* Функция для работы с check формой */
function check($str, $real) {
if ($str == $real) {
return 'checked="checked"';
} else {
return; }
}
/* Функция для работы с select формой */
function select($str, $real) {
if ($str == $real) {
return 'selected="selected"';
} else {
return; }
}
/* Склонение слов */
function word () {
$args = func_get_args();
$num = $args[0] % 100;
if ($num > 19) {
$num = $num % 10;
}
switch ($num) {
case 1:  {return $args[0] . ' ' .$args[1];}
case 2:
case 3:
case 4:  {return $args[0] . ' ' .$args[2];}
default: {return $args[0] . ' ' .$args[3];}
}
}
/* Функция вывода окончаний */
function RUR ($str) {
$explode = explode('.', $str);
$str = word(round($explode[0]), 'рубль', 'рубля', 'рублей');
if ($explode[1] > 0) {
$str .= ' '.word(round($explode[1]), 'копейка', 'копейки', 'копеек');
}
return $str;
}
/* Функция определения кто где */


function where($where) {
if (stripos($where, 'index.php'))           {  return '<a href="'.ROOT.'">Главная</a>';  }
elseif (stripos($where, 'str/reklama.php'))      {  return '<a href="'.ROOT.'/str/reklama.php">Покупка рекламы</a>';  }

elseif (stripos($where, 'panel/'))      {  return 'Админ-Панель';  }
elseif (stripos($where, 'garden/'))      {  return '<a href="'.ROOT.'/garden/index.php">Мой сад</a>';  }
elseif (stripos($where, 'garden/auction.php'))      {  return '<a href="'.ROOT.'/garden/auction.php">Аукцион</a>';  }
elseif (stripos($where, 'str/banlist.php'))      {  return '<a href="'.ROOT.'/str/banlist.php">Список забаненных</a>';         }
elseif (stripos($where, 'str/online.php'))      {  return '<a href="'.ROOT.'/str/online.php">Онлайн</a>';         }
elseif (stripos($where, 'str/forgot.php'))      {  return '<a href="'.ROOT.'/str/forgot.php">Забыли пароль</a>';  }
elseif (stripos($where, 'str/reg.php'))         {  return '<a href="'.ROOT.'/str/reg.php">Регистрация</a>';       }
elseif (stripos($where, 'str/news.php'))        {  return '<a href="'.ROOT.'/str/news.php">Новости</a>';          }
elseif (stripos($where, 'str/guest.php'))       {  return '<a href="'.ROOT.'/str/guest.php">Гостевая</a>';        }
elseif (stripos($where, 'str/stat.php'))        {  return '<a href="'.ROOT.'/str/stat.php">Статистика</a>';       }
elseif (stripos($where, 'str/auth.php'))        {  return '<a href="'.ROOT.'/str/auth.php">Авторизация</a>';      }
elseif (stripos($where, 'cpanel.php'))      {  return '<a href="'.ROOT.'/cpanel.php">Кабинет</a>';                }
elseif (stripos($where, 'str/rate.php'))        {  return '<a href="'.ROOT.'/str/rate.php">Рейтинги сайта</a>'; }
elseif (stripos($where, 'str/user.php'))        {  return '<a href="'.ROOT.'/str/user.php">Пользователи</a>'; }
elseif (stripos($where, 'str/mail.php'))        {  return '<a href="'.ROOT.'/str/mail.php">Моя почта</a>';  }
else                                        {  return 'Не определено';                                  }
}
/* Определяем реальный ip*/
/*function ip() {
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
$ip = $_SERVER['HTTP_CLIENT_IP'];}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
$ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;
}  */
function daytime($var) {
if ($var == NULL) $var = time();
$full_time = date('d.m.Y в H:i', $var);
$date = date('d.m.Y', $var);
$time = date('H:i', $var);
if ($date == date('d.m.Y')) $full_time = date('Сегодня в H:i', $var);
if ($date == date('d.m.Y', time()-60*60*24)) $full_time = date('Вчера в H:i', $var);
return $full_time;  }

/* Функция ББ кодов */
function bb($str) {
/* Жирный шрифт */
$str = preg_replace('#\[b\](.*?)\[/b\]#si', '<b>\1</b>', $str);
/* Наклоненный шрифт */
$str = preg_replace('#\[i\](.*?)\[/i\]#si', '<i>\1</i>', $str);
/* Подчеркнутый шрифт */
$str = preg_replace('#\[u\](.*?)\[/u\]#si', '<u>\1</u>', $str);
/* Перенос текста */
$str = preg_replace('#\[br\]#si', '<br/>', $str);
/* Зачеркнутый шрифт */
$str = preg_replace('#\[del\](.*?)\[/del\]#si', '<del>\1</del>', $str);
/* Маленький шрифт */
$str = preg_replace('#\[small\](.*?)\[/small\]#si', '<small>\1</small>', $str);
/* Цветной шрифт */
$str = preg_replace('#\[color=(.*?)\](.*?)\[/color\]#si', '<span style="color:\1">\2</span>', $str);
/* Цитата */
$str = preg_replace('#\[quote\](.*?)\[/quote\]#si', '<div class="tabl2">Цитата:<br/><div class="tabl">\1</div></div>', $str);

$str = preg_replace('#\[code\](.*?)\[/code\]#ie', 'highlight_code("\1")', $str);

return $str;
}
function url_replace($m) {
if (!isset($m[3])) {
return '<a href="' . $m[1] . '">' . $m[2] . '</a>';
} else {
return '<a href="' . $m[3] . '">' . $m[3] . '</a>'; }
}

function bblinks($link) {
$link = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-z\.\-]+\.[0-9a-z]{2,6}[0-9a-zA-Z/\?\.\-\~&;_=%:#\+]*)~', 'url_replace', $link);
return $link; }
////////////////////////////////////////////////////////////////////////////////







/* Функция отправки почты на email */
function mailto($mail, $theme, $text, $str) {
$utf = "From: ".$str." \n";
$utf.= "X-sender: < ".$str." >\n";
$utf.= "Content-Type: text/html; charset=utf-8\n";
return mail($mail, $theme, $text, $utf);
}

/* Функция вывода смайлов */
function smiles($str) {
global $user;
if ($user['smiles'] == 0) {
for($i = 1; $i <= count(glob('../img/smiles/*.gif')); $i++) {
$str = str_replace(':'.$i.':', '<img src="'.ROOT.'/img/smiles/'.$i.'.gif" alt=""/>', $str);
}
} 
return $str;
}

/* Функция генерации пароля */
function gen_pass($col = 6) {
$row = 'abcdefghijklmnopqrstuvwxvzABCDEFGHIJKLMNOPQRSTUVWXVZ0123456789';
$str = '';
for($i= 0 ; $i < $col; $i++) {
$str.= $row[rand(0, 61)];
}
return $str;
}
/* Пол пользователя иконкой */
function sexicon($user){
$result = mysql_query("SELECT `pol` FROM `users` WHERE `login` = '".$user."'");
$rows = mysql_fetch_array($result);
if($rows['pol']==1) {
$pol = '<img src="'.ROOT.'/img/man.png" width="16" height="16" class="left" />';
} else {
$pol = '<img src="'.ROOT.'/img/woman.png" width="16" height="16" class="left" />';
}
return $pol;
} 
/* Пол пользователя */
function sex($user){
$result = mysql_query("SELECT `pol` FROM `users` WHERE `login` = '".$user."'");
$rowws = mysql_fetch_array($result);
if($rowws['pol']==1) {
$pols = "Мужской";
} else {
$pols = "Женский";
}
return $pols;
} 
/* Статус онлайн */
function online($user){
$result = mysql_query("SELECT `date` FROM `online` WHERE `user` = '".$user."'");
$rows = mysql_fetch_array($result);
if($rows['date'] < time()-300) {
$online = "<font color='#F00000'>OFF</font>";
} else {
$online = "<font color='#00F000'>ON</font>";
}
return $online;
} 

/* Функция определения реального браузера */
if(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])) {
$_ua = win($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']);
} else {
$_ua = win($_SERVER['HTTP_USER_AGENT']);
}


/* Тип вывода средств */
function cost_type($money) {
switch ($money) {
default:
return 'Webmoney';
break;
case 'mobile':
return 'Mobile';
break;
}
}
/* Статус вывода средств */
function cost($money) {
switch ($money) {
default:
return '<span style="color: blue">Ожидается</span>';
break;
case 'lock':
return '<span style="color: red">Отменена</span>';
break;
case 'on':
return '<span style="color: green">Выплачено</span>';
break;
}
}
/* Функция авторизации */
if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
$sql = mysql_query("select * from `users` where `login`='".utf($_SESSION['login'])."' limit 1");

if (mysql_num_rows($sql) != 0) {
$user = mysql_fetch_assoc($sql);
if ($user['login'] == strtolower($_SESSION['login']) || strtoupper($_SESSION['login']) && $user['pass'] == $_SESSION['pass']) {
$active = true;
			
/* Онлайн */
if (!mysql_num_rows(mysql_query("select (`user`) from `online` where `user`='".$user['login']."'"))) {
mysql_query("insert into `online` set `user`='".utf($user['login'])."', `ip`='".utf($_SERVER['REMOTE_ADDR'])."', `ua`='".strtok($_ua, ' (')."', `date`='".time()."', `where`='".utf($_SERVER['PHP_SELF'])."'");
} else {
mysql_query("update `online` set `date`='".time()."', `where`='".utf($_SERVER['PHP_SELF'])."' where `user`='".$user['login']."' limit 1");
}
} else {
session_destroy();
}
} else {
session_destroy();
}
}
/* Функции извлечения настроек с базы */
$systema = mysql_query("SELECT * FROM `settings`");
$set = array();
while ($query = mysql_fetch_array($systema)){
$set[$query[0]] = $query[1]; }

/* Функции постраничной навигации */
function page($k_page = 1) {
$page = 1;
if (isset($_GET['page'])) {
if ($_GET['page'] == 'end') {
$page = intval($k_page); 
}
elseif(is_numeric($_GET['page'])) {
$page = intval($_GET['page']);
}
if ($page < 1) {
$page = 1;
}
if ($page > $k_page) {
$page = $k_page;
}
}
return $page;
}

function k_page($k_post = 0, $k_p_str = 10) {
if ($k_post != 0) { 
$v_pages = ceil($k_post / $k_p_str); 
return $v_pages; 
} else {
return 1;
}
}

function navigation($link = '?', $k_page = 1, $page = 1) {
if ($page < 1) {
$page = 1;
}
echo '<div class="menu">';
if ($page != 1) {
echo 'Стр: <a href="'.$link.'page=1"><span class="panel">1</span></a>';
} else {
echo 'Стр: <span class="rand">1</span>';
}
for ($i =- 3; $i <= 3; $i++) {
if ($page + $i > 1 && $page + $i < $k_page) {
if ($i ==- 3 && $page + $i > 2) {
echo ' ..'; 
}
if ($i != 0) {
echo '<a href="'.$link.'page='.($page + $i).'"><span class="panel">'.($page + $i).'</span></a>';
} else {
echo ' <span class="menu">'.($page + $i).'</span>';
}
if ($i == 3 && $page + $i < $k_page - 1) {
echo ' ..';
}
}
}
if ($page != $k_page) {
echo ' <a href="'.$link.'page=end"><span class="panel">'.$k_page.'</span></a>';
}
elseif ($k_page > 1) {
echo ' <span class="menu">'.$k_page.'</span>';
}
echo '</div>';
}
/* Различные счетчики модулей */
################################################################################
$count_reklama = mysql_result(mysql_query("select count(`id`) from `reklama` where `user`='".$user['login']."'"), 0);
/* Подсчитываем кол-во новых личных сообщений */
$count_mail_new = mysql_result(mysql_query("select count(`id`) from `mail` where `to`='".$user['login']."' and `status`='1'"), 0);
/* Подсчитываем кол-во личных сообщений */
$count_mail_me = mysql_result(mysql_query("select count(`id`) from `mail` where `to`='".$user['login']."'"), 0);
/* Подсчитываем забаненных пользователей */
$count_ban = mysql_result(mysql_query("select count(`id`) from `ban`"), 0);
/* Подсчитываем кол-во пользователей */
$count_users = mysql_result(mysql_query("select count(`id`) from `users`"), 0);
/* Подсчитываем кол-во пользователей онлайн */
$count_online_user = mysql_result(mysql_query("select count(`id`) from `online` where `user`<>'' and `date`>'".(time() - 300)."'"), 0);
/* Подсчитываем кол-во писем */
$cntmail = mysql_result(mysql_query("select count(`id`) from `mail`"), 0);				
/* Подсчитываем кол-во логов вводов */
$cntin = mysql_result(mysql_query("select count(`id`) from `money_in`"), 0);				
/* Последний зарегистрированный пользователь */
$user_desc = mysql_fetch_assoc(mysql_query("select (`login`) from `users` order by `id` desc limit 1"));
/* Подсчитываем кол-во рефералов*/
$count_ref_all = mysql_result(mysql_query("select count(`id`) from `ref`"), 0);
/* Подсчитываем кол-во комментариев к новостям */
$count_news_comment = mysql_result(mysql_query("select count(`id`) from `news` where `news`<>''"), 0);
/* Подсчитываем кол-во зарегистрированных пользователей сегодня */
$count_users_new = mysql_result(mysql_query("select count(`id`) from `users` where `datereg`>'".mktime(0, 0, 1, date('m'), date('d'), date('Y'))."'"), 0);
/* Подсчитываем кол-во денег на бирже */
$count_birzha_money = mysql_result(mysql_query("select sum(`money`) from `users`"),0);
/* Подсчитываем кол-во введенного */
$max_in = mysql_result(mysql_query("select sum(`summa`) from `money_in`"),0);
/* Подсчитываем кол-во рекламных ссылок у пользователя */
$count_reklama = mysql_result(mysql_query("select count(`id`) from `reklama` where `user`='".$user['login']."'"), 0);
/* Подсчитываем кол-во отправленных сообщений */
$count_mail_to = mysql_result(mysql_query("select count(`id`) from `mail` where `who`='".$user['login']."'"), 0);
/* Подсчитываем кол-во отправленных непрочитанных сообщений */
$count_mail_to_false = mysql_result(mysql_query("select count(`id`) from `mail` where `who`='".$user['login']."' and `status`='1'"), 0);
/* Подсчитываем кол-во новостей */
$count_news = mysql_result(mysql_query("select count(`id`) from `news` where `news`=''"), 0);
/* Подсчитываем кол-во сообщений в гостевой */
$count_guest = mysql_result(mysql_query("select count(`id`) from `guest`"), 0);
/* Подсчитываем кол-во новых новостей за сутки */
$count_news_new = mysql_result(mysql_query("select count(*) from `news` where `date`>'".(time() - 86400)."' and `news`=''"), 0);
if($count_news_new > 0) {
$count_new_news = '/<span style="color:red">+'.$count_news_new.'</span>';}
/* Подсчитываем кол-во девушек */
$count_woman = mysql_result(mysql_query("select count(`id`) from `users` where `pol`='0'"), 0);
/* Подсчитываем кол-во парней */
$count_man = mysql_result(mysql_query("select count(`id`) from `users` where `pol`='1'"), 0);
/* Подсчитываем кол-во авторизаций юзера */
$authuser = mysql_result(mysql_query("select count(`id`) from `auth` where `log`='".$user['login']."'"), 0);
/* Подсчитываем кол-во авторизаций */
$count_auth = mysql_result(mysql_query("select count(`id`) from `auth`"), 0);
/* Подсчитываем ошибочные входы */
$count_error = mysql_result(mysql_query("select count(`id`) from `auth_err`"), 0);
/* Подсчитываем кол-во новых сообщений в гостевой за сутки */
$count_new_guest = mysql_result(mysql_query("select count(*) from `guest` where `date`>'".(time() - 86400)."'"), 0);
if($count_new_guest > 0) {
$count_guest_new = '/<span style="color:red">+'.$count_new_guest.'</span>'; }
/* Подсчитываем кол-во просящих ввод средств */
$count_in = mysql_result(mysql_query("select count(`id`) from `inmoney`"), 0);
/* Подсчитываем кол-во рефералов у пользователя */
$count_ref = mysql_result(mysql_query("select count(`id`) from `ref` where `who`='".$user['login']."'"), 0);
/* Подсчитываем кол-во просящих вывод средств */
$count_mobile = mysql_result(mysql_query("select count(`id`) from `payment` where `status`='moder'"), 0);
/* Подсчитываем кол-во просящих вывод средств */
$max_out = mysql_result(mysql_query("select  sum(`money`) from `payment` where `status`='on'"), 0);
/* Подсчитываем кол-во денег */
$count_fruit = mysql_result(mysql_query("select sum(`fruit`) from `users`"),0);
/* Подсчитываем кол-во  */
$count_serebro = mysql_result(mysql_query("select sum(`serebro`) from `users`"),0);
/* Подсчитываем кол-во денег на бирже */
$jobs_ref = mysql_result(mysql_query("select sum(`count`) from `ref`"),0);
/* Подсчитываем кол-во просящих вывод средств */
$out_many = mysql_result(mysql_query("select  count(`id`) from `payment` where `status`='on'"), 0);

$count_smss = mysql_result(mysql_query("select count(`id`) from `guest` where `user`='".$user['login']."'"), 0);

//$count_sms_chats = mysql_result(mysql_query("select count(`id`) from `guest` where `who`='".$user['id']."'"), 0);



?>