<?
include ('../inc/head.php');
if (isset($_POST['WK_PAY_AMOUNT']) && isset($_POST['WK_PAY_TIME']) && isset($_POST['WK_PAY_HASH']))
{
	include ('../inc/config.php');
include_once '../paywk/sett.php';

$common_string = wk_id.$_POST['WK_PAY_AMOUNT'].$_POST['WK_PAY_TIME'].wk_code;
$hash = strtoupper(hash("sha256",$common_string));
if($hash!=$_POST['WK_PAY_HASH']) exit('NO HACK!');

$summ = wk_summ($_POST['WK_PAY_AMOUNT']);
$id = abs(intval($_POST['WK_PAY_ID']));

mysql_query("UPDATE `users` SET `money` = `money`+".$summ." WHERE `id` = '".$id."'");

exit('YES');
}
?>