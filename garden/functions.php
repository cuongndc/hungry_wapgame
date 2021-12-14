<?php

function doxod ($id) {
$tree = mysql_fetch_array(mysql_query("SELECT * FROM `tree` WHERE `id` = '".$id."'"));
if ($tree['level'] == 1) {
return 1;
} else {
$a = (int)$tree['level'] * 2 + 1;
return $a;

}
}

?>