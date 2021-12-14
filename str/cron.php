<?php
error_reporting(0);
//include (dirname(__FILE__) . '/inc/config.php');
include ('../inc/config.php');
mysql_connect(HOST, USER, PASS);
mysql_select_db(BASE);


mysql_query("update `ref` set `count_day`='0'");
mysql_query("delete from `reklama` where `date`<='".time()."'");
mysql_query("update `reklama` set `count`='0'");
mysql_query("update `users` set `bonus`='0'");
mysql_query('update `stat` set `update`="'.time().'"');
?>