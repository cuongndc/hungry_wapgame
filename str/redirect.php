<?php
include ('../inc/head.php');
$url = isset($_GET['url']) ? win(str_ireplace('http://', '', $_GET['url'])) : $_SERVER['HTTP_HOST'];
$sql = mysql_query("select * from `reklama` where `url`='".win($url)."' limit 1");

if (mysql_num_rows($sql)) {
$row = mysql_fetch_assoc($sql);
if (!isset($_COOKIE['reklama_'.$row['id']])) {
mysql_query("update `reklama` set `count`=`count`+'1', `count_all`=`count_all`+'1' where `url`='".win($url)."' limit 1");
setCookie ('reklama_'.$row['id'], time(), time() + 3600 * 24);
}
//session_destroy();
header('Location: http://'.$row['url']);
} else {
header('Location: http://'.$url);
}

include ('../inc/foot.php');
?>