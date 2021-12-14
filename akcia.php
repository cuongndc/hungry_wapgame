<?php
$k_post = mysql_result(mysql_query("select count(*) from `news` where `news`=''"),0); 
$k_page = k_page($k_post, 10); 
$page = page($k_page); 
$start = 10 * $page - 10;
			
$sql = mysql_query("select * from `news` where `news`='' order by `id` desc limit ".$start.", 1");

if (mysql_num_rows($sql) == 0) {
echo '<div class="error"><center>Новостей еще нет!</center></div>';
} else {
$count = '';
while ($row = mysql_fetch_assoc($sql)) {
$count ++;
/*
echo'
<a><b>'.utf($row['name']).'</b></a> ('.date('d.m H:i', $row['date']).') '.($row['date'] > time() - 86400 ? '(<span style="color:red">New!</span>)' : null).' ';
echo'<br/>'.nl2br(bb(smiles(utf($row['text'])))).'<br/><img src="'.ROOT.'/img/comments.png" width="16" height="16" class="left" /> <a href="str/news.php?act=comment&id='.$row['id'].'">Коментарии</a> ('.mysql_result(mysql_query("select count(`id`) from `news` where `news`='".$row['id']."'"), 0).')';			
*/
echo''.($row['date'] > time() - 86400 ? '<div class="wape">'.utf($row['name']).'</br>
</a>'.nl2br(bb(smiles(utf($row['text'])))).'<br/><img src="'.ROOT.'/img/comments.png" width="16" height="16" class="left" /> <a href="str/news.php?act=comment&id='.$row['id'].'">Коментарии</a> ('.mysql_result(mysql_query("select count(`id`) from `news` where `news`='".$row['id']."'"), 0).')' : null).'</div>';

}			
if ($k_page > 1) navigation('?', $k_page, $page);
}

?>