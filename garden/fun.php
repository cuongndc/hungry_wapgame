<?php
error_reporting(0);
include (dirname(__FILE__) . '/inc/config.php');
mysql_connect(HOST, USER, PASS);
mysql_select_db(BASE);

function doxod ($id) {
$tree = mysql_fetch_array(mysql_query("SELECT * FROM `tree` WHERE `id` = '".$id."'"));
if ($tree['level'] == 1) {
return 1;
} else {
$a = (int)$tree['level'] * 2 + 1;
return $a;
}
}

$sql = mysql_query("SELECT * FROM `tree`");
while ($tree = mysql_fetch_array($sql)) {
$result = $tree['fruit'] + doxod($tree['id']);
mysql_query("UPDATE `tree` SET `fruit` = '".$result."' WHERE `id` = '".$tree['id']."'");  
}
?>