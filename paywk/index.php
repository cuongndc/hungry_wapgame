<?
include ('../inc/head.php');
//-----Создаем титл страницы-----//
$title = 'Пополнить счёт';
//-----Подключаем функции-----//
include ('../inc/config.php');
include_once '../paywk/sett.php';


if (isset($_POST['summa']))
{
if (wk_summ($_POST['summa'])!='0.00')
{?>
<form method="POST" action="https://wapkassa.ru/merchant/oplata.php">
<input type="hidden" name="WK_PAYMENT_SITE" value="<?=wk_id?>">
<input type="hidden" name="WK_PAYMENT_AMOUNT" value="<?=wk_summ($_POST['summa'])?>">
<input type="hidden" name="WK_PAYMENT_COMM" value="Пополнение баланса ID<?=$user['id']?>">
<input type="hidden" name="WK_PAYMENT_HASH" value="<?=strtoupper(hash("sha256",wk_id.wk_summ($_POST['summa']).wk_code))?>">
<input type="hidden" name="WK_PAYMENT_ID" value="<?=$user['id']?>">
<input type="submit" value="Перейти к оплате">
</form>
<?}
else
{
$err.='Неверная сумма';
}
}
echo '<div class="podmenu"><center><b>'.$err.'</b></center></div>';
echo 'Ваш баланс '.$user['money'].' Rub<br/>
Пополнить на:<br/>
<form method="post">
<input name="summa" type="text" value="1.00"/> RUB<br/>
<input type="submit" value="Пополнить"/>
</form>';
include ('../inc/foot.php');
?>