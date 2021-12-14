<?php

include ('../inc/config.php');
mysql_connect(HOST, USER, PASS) or exit('Немогу подключиться к серверу');
mysql_select_db(BASE) or exit('Немогу подключиться к базе '.BASE);
mysql_query("set names 'utf8'") . mysql_query("set charset 'utf8'");
include ('../inc/function.php');

define('root', ROOT.'/str/rss.php');


header("Content-type:application/rss+xml; charset=utf-8");
echo '<?xml version="1.0" encoding="utf-8" ?>';
echo '<rss version="2.0"><channel>';
echo '<title> My-Bird News</title>';
echo '<link>'.ROOT.'</link>';
echo '<description>Новости RSS</description>';
echo '<title>News</title>';
echo '<link>'.ROOT.'</link>';
echo '<language>ru</language>';
echo '<managingEditor>'.utf($set['mail']).'</managingEditor>';
echo '<webMaster>'.utf($set['mail']).'</webMaster>';
echo '<lastBuildDate>'.date("d.m.Y H:i").'</lastBuildDate>';

$sql = mysql_query("select * from `news` where `news`='' order by `id` desc limit 15");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Новостей еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
echo '<item><title>'.utf($row['name']).'</title>';
echo '<description>'.nl2br(bb(smiles(utf($row['text'])))).'</description><author>NTL</author>';
echo '<pubDate>'.date('r', $row['date']).'</pubDate><category>Новости</category><guid>'.ROOT.'/str/news.php</guid></item>';
}
}
echo '</channel></rss>';
?>