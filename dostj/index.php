<?php
/*menu dostj*/
include ('../inc/head.php');
/*Подгружаем стили*/
include_once 'style.php'; 
include_once 'style1.php'; 
include_once 'style2.php';  
/******************END  =)) */
define('root', ROOT.'/dostj/index.php');
/* ==== майн современня функция by_denikoua===== */
function back() {
echo '<div class="overfl_hid t-bg2 light_border_bottom">
<a class="t-block_item t-light_link t-link_no_underline overfl_hid t-padd_left  " href="/dostj"><span class="t-block_item stnd_padd t-bg_arrow_prev"><span class="t-padd_left"> Назад </span></span></a>
</div>';
}
/* END */
$act = isset ($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
/* ========================default страничка)======================= */
default:
if (!mysql_num_rows($sql)) {
header('Location: '.root);
} else {
$row = mysql_fetch_assoc($sql);
echo '<div class="menus menu2"><center>Достижения '.utf($user['login']).'</center></div>';
}
echo '</td><td>';
echo '<div class="oh wape">
<div>
<a class="rate_arrow" href="/dostj/?id='.utf($user['id']).'">
    Рейтинг: '.utf($user['reitsbydenikoua']).' <div class="rate_arrow_end"></div>
</a></div>
</div>
';
/* Выводим задания */
if ($user['z1'] <= 2) {
/* ЗАДАНИЕ #1 */
echo '<div class="wape">
<a href="?act=zadanka1" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="att_it mt_0 oh">
<img src="/dostj/img/1b.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh">
<b class="t-link_item_hover light_grey"> Хороший друг</b>
<small class="light_grey"> (Рейтинг +0.2) </small>
<br>
<span class="light_grey"> Набрать 5 рефералов </span>
</div>
</div>
</a>
';
}else{
echo '<div class="wape">
<a href="?act=zadanka1" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="pos_block round_corners oh">
<img src="img/1.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh ">
<img src="img/check.png" alt="" class="right"> <div class="right>"><font color="red">Выполнено</font></div>
<b class="t-strong_item t-link_item_hover"> Хороший друг</b>
<small> (Рейтинг +0.2) </small>
<br>
<span> Набрать 5 рефералов </span>
</div>
</div>
</a>';
}
echo '</div>';
if ($user['z2'] <= 2) {
/* ЗАДАНИЕ #2 */
echo '<div class="wape">
<a href="?act=zadanka2" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="att_it mt_0 oh">
<img src="/dostj/img/2b.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh">
<b class="t-link_item_hover light_grey"> Мастер общения</b>
<small class="light_grey"> (Рейтинг +0.1) </small>
<br>
<span class="light_grey"> Написать минимум 10 сообщений в мини-чат,не нарушая правила общения </span>
</div>
</div>
</a>
';
}else{
echo '<div class="wape">
<a href="?act=zadanka2" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="pos_block round_corners oh">
<img src="img/2.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh ">
<img src="img/check.png" alt="" class="right"> <div class="right>"><font color="red">Выполнено</font></div>
<b class="t-strong_item t-link_item_hover"> Мастер общения</b>
<small> (Рейтинг +0.1) </small>
<br>
<span> Написать минимум 10 сообщений в мини-чат,не нарушая правила общения </span>
</div>
</div>
</a>';
}
/* КОНЕЦ ЗАДАНИЯ #2 */
echo'</div>';

if ($user['z3'] <= 2) {
/* ЗАДАНИЕ #2 */
echo '<div class="wape">
<a href="?act=zadanka3" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="att_it mt_0 oh">
<img src="/dostj/img/3b.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh">
<b class="t-link_item_hover light_grey"> Работающий</b>
<small class="light_grey"> (Рейтинг +0.5) </small>
<br>
<span class="light_grey"> Для достижения Вам надо купить птиц  <font color="red">3</font> . </span>
</div>
</div>
</a>
';

}else{
echo '<div class="wape">
<a href="?act=zadanka3" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="pos_block round_corners oh">
<img src="img/3.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh ">
<img src="img/check.png" alt="" class="right"> <div class="right>"><font color="red">Выполнено</font></div>
<b class="t-strong_item t-link_item_hover"> Работающий</b>
<small> (Рейтинг +0.5) </small>
<br>
<span> Для достижения Вам надо купить птиц  <font color="red">3</font> . </span>
</div>
</div>
</a>';
}
/* КОНЕЦ ЗАДАНИЯ #3 */
echo'</div>';
if ($user['z4'] <= 2) {
/* ЗАДАНИЕ #4 */
echo '<div class="wape">
<a href="?act=zadanka4" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="att_it mt_0 oh">
<img src="/dostj/img/4b.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh">
<b class="t-link_item_hover light_grey"> Продвинутый</b>
<small class="light_grey"> (Рейтинг +0.6) </small>
<br>
<span class="light_grey"> Повысить уровень 1 птицы до 5 уровня </span>
</div>
</div>
</a>
';
}else{
echo '<div class="wape">
<a href="?act=zadanka4" class="stnd_padd pdb t-block_item t-link_no_underline_block">
<div class="pos_block round_corners oh">
<img src="img/4.png" width="40" height="40 alt="" class="left dot_pic">
<div class="oh ">
<img src="img/check.png" alt="" class="right"> <div class="right>"><font color="red">Выполнено</font></div>
<b class="t-strong_item t-link_item_hover"> Продвинутый</b>
<small> (Рейтинг +0.6) </small>
<br>
<span> Повысить уровень 1 птицы до 5 уровня </span>
</div>
</div>
</a>';
}
/* КОНЕЦ ЗАДАНИЯ #4 */
break;
echo'</div>';
/* ====== completezd2 ====== */
case 'completezd2' :
				  $count_gsms = mysql_result(mysql_query("select count(`id`) from `guest` where `user`='".$user['login']."'"), 0);//Считаем количество сообщений в мини-чате у юзера

			    $lock_2 = $user['z2_lock'];
				if ($lock_2 < 2) {
				if ($count_gsms >9){
				
				mysql_query("update `users` set `z2_lock`=`z2_lock`+'3', `reitsbydenikoua`=`reitsbydenikoua`+'0.1', `z2`=`z2`+'3' where `login`='".win($user['login'])."' limit 1");
				echo '<div class="wape">Задание "<b>Мастер общения </b>" выполнено!<br />Рейтинг: <b>+0.1</b></div>';
				back();
				}else{
				echo '<div class="error">Задание еще не выполнено! Ты не можешь получить награду!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
				back();
				}
				}else{
				echo '<div class="error">Ты уже получал награду за это задание!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
				back();
				}
				break;
				/* end */
echo '</div>';
/* ====== completezd4 ====== */
case 'completezd4' :
				$count_bird = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='5' and `id_user` = '".$user['id']."'"), 0);//уровень птицы
			    $lock_4 = $user['z4_lock'];
				if ($lock_4 < 2) {
				if ($count_bird['user'] >0){
				
				mysql_query("update `users` set `z4_lock`=`z4_lock`+'3', `reitsbydenikoua`=`reitsbydenikoua`+'0.6', `z4`=`z4`+'3' where `login`='".win($user['login'])."' limit 1");
				echo '<div class="wape">Задание "<b>Продвинутый </b>" выполнено!<br />Рейтинг: <b>+0.6</b></div>';
				back();
				}else{
				echo '<div class="error">Задание еще не выполнено! Ты не можешь получить награду!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
				back();
				}
				}else{
				echo '<div class="error">Ты уже получал награду за это задание!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
				back();
				}
				break;
				/* end */
echo '</div>';
/* ====== completezd3 ====== */
case 'completezd3' :
				$count_bird = mysql_num_rows(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'"));//Считаем количество птиц у юзера
			    $lock_3 = $user['z3_lock'];
				if ($lock_3 < 2) {
				if ($count_bird >2){
				
				mysql_query("update `users` set `z3_lock`=`z3_lock`+'3', `reitsbydenikoua`=`reitsbydenikoua`+'0.5', `z3`=`z3`+'3' where `login`='".win($user['login'])."' limit 1");
				echo '<div class="wape">Задание "<b>Работающий </b>" выполнено!<br />Рейтинг: <b>+0.5</b></div>';
				back();
				}else{
				echo '<div class="error">Задание еще не выполнено! Ты не можешь получить награду!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
				back();
				}
				}else{
				echo '<div class="error">Ты уже получал награду за это задание!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
				back();
				}
				break;
				/* end */
echo '</div>';
/* ====== completezd1 ====== */
								case 'completezd1' :
								$count_refuser = mysql_result(mysql_query("select count(`id`) from `ref` where `who`='".$user['login']."'"), 0);
								$lock_1 = $user['z1_lock'];
								if ($lock_1 < 2) {
								if ($count_refuser['login'] >4){
								
								mysql_query("update `users` set `z1_lock`=`z1_lock`+'3', `reitsbydenikoua`=`reitsbydenikoua`+'0.2', `z1`=`z1`+'3' where `login`='".win($user['login'])."' limit 1");
								echo '<div class="wape">Задание "<b>Хороший друг</b>" выполнено!<br />Рейтинг: <b>+0.2</b></div>';
								back();
								}else{
								echo '<div class="error">Задание еще не выполнено! Ты не можешь получить награду!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
								back();
								}
								}else{
									echo '<div class="error">Ты уже получал награду за это задание!<img src="http://bymas.ru/modules/smiles/smiles/nastav.gif"></div>';
									back();
								}
								break;

								/* end */
									echo '</div>';
									break;
						/******************************Завдання 2*************************************************/
								case 'zadanka2':	
								echo '<div class="menus menu2"><center>Достижения '.utf($user['login']).'</center></div>';
							echo '<div class="main_zd">';
							$lock2 = $user['z2_lock'];
							if ($lock2 > 2) {
							echo '<div class="list_item">
							<img src="img/2.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Мастер общения (Рейтинг +0.1)  <br>
							<b class="service_item"> Статус: </b> Выполнено. <br>
							<b class="service_item"> Описание: </b> Набрать 10 сообщений в мини-чате.
							</div>';


							}else{
							echo '
							<div class="list_item">';

							echo '<div class="list_item">
							<img src="img/2b.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Мастер общения (Рейтинг +0.1)  <br>
							<b class="service_item"> Статус: </b> Не выполнено <br>';
							
							
                            $count_gsms = mysql_result(mysql_query("select count(`id`) from `guest` where `user`='".$user['login']."'"), 0);//Считаем количество сообщений в мини-чате у юзера

	
							
								if ($count_gsms >9)
								
										echo '<br /><br /><a href="'.ROOT.'/dostj/?act=completezd2" style="border: 2px dotted navy; padding: 2px; text-decoration: none; color: red;">Получить 0.1 рейтинга</a>';

								else {
									 
										echo'
										<b class="service_item"> Описание: </b>Для достижения Вам надо набрать <font color="red">10</font> сообщений в мини-чате. У вас '.$count_smss.' сообщений.
										</div>
										<div class="m">
										Чтобы написаить в мини-чат перейдите по ссылке  своих друзей по вашей реф.ссылке <a href="'.ROOT.'/str/guest.php">Мини-Чат.</a>';
										
											echo'</div>';	echo'</div>';
										back();
								}
								
							}
							echo'</div>';
								break;
								
				/******************************конец Завдання 2*************************************************/	

				
			/******************************Завдання 3*************************************************/
								case 'zadanka3':	
								echo '<div class="menus menu2"><center>Достижения '.utf($user['login']).'</center></div>';
							echo '<div class="main_zd">';
							$lock3 = $user['z3_lock'];
							if ($lock3 > 2) {
							echo '<div class="list_item">
							<img src="img/3.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Работающий (Рейтинг +0.5)  <br>
							<b class="service_item"> Статус: </b> Выполнено. <br>
							<b class="service_item"> Описание: </b> Купить 3 птицы любого уровня.
							</div>';

							}else{
							echo '
							<div class="list_item">';

							echo '<div class="list_item">
							<img src="img/3b.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Работающий (Рейтинг +0.5)  <br>
							<b class="service_item"> Статус: </b> Не выполнено <br>';
							
							$count_bird = mysql_num_rows(mysql_query("SELECT * FROM `tree` WHERE `id_user` = '".$user['id']."'"));//Считаем количество птиц у юзера
                          
	
							
								if ($count_bird >2)
								
										echo '<br /><br /><a href="'.ROOT.'/dostj/?act=completezd3" style="border: 2px dotted navy; padding: 2px; text-decoration: none; color: red;">Получить 0.5 рейтинга</a>';

								else {
									 
										echo'
										<b class="service_item"> Описание: </b>Для достижения Вам надо купить птиц  <font color="red">3</font> . У вас '.$count_bird.' птиц.
										</div>
										<div class="m">
										Чтобы купить птиц перейдите по ссылке <a href="'.ROOT.'/garden/?act=purchase">Купить птиц.</a>';
										
											echo'</div>';	echo'</div>';
										back();
								}
								
							}
							echo'</div>';
								break;
								
				/******************************конец Завдання 3*************************************************/		


/******************************Завдання 4*************************************************/
								case 'zadanka4':	
								echo '<div class="menus menu2"><center>Достижения '.utf($user['login']).'</center></div>';
							echo '<div class="main_zd">';
							$lock4 = $user['z4_lock'];
							if ($lock4 > 2) {
							echo '<div class="list_item">
							<img src="img/4.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Продвинутый (Рейтинг +0.6)  <br>
							<b class="service_item"> Статус: </b> Выполнено. <br>
							<b class="service_item"> Описание: </b> Повысить уровень 1 птицы до 5 уровня.
							</div>';

							}else{
							echo '
							<div class="list_item">';

							echo '<div class="list_item">
							<img src="img/4b.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Продвинутый (Рейтинг +0.6)  <br>
							<b class="service_item"> Статус: </b> Не выполнено <br>';
							
                          $count_bird = mysql_result(mysql_query("select count(`id`) from `tree` where `level`='5' and `id_user` = '".$user['id']."'"), 0);//уровень птицы 
	
									if ($count_bird['user'] >0)
								
										echo '<br /><br /><a href="'.ROOT.'/dostj/?act=completezd4" style="border: 2px dotted navy; padding: 2px; text-decoration: none; color: red;">Получить 0.5 рейтинга</a>
										
										</br>
										
										';

								else {
									 
										echo'
										<b class="service_item"> Описание: </b>Для достижения Вам надо минимум <font color="red">1</font> птицу 5 уровня . У вас '.$count_bird.' птиц 5 уровня.
										</div>
										<div class="m">
										Чтобы повысить уровень птицы перейдите по ссылке <a href="'.ROOT.'/garden/?act=purchase">Мои птицы.</a>';
										
											echo'</div>';	echo'</div>';
										back();
								}
								
							}
							echo'</div>';
								break;
								
				/******************************конец Завдання 4*************************************************/	

				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
/******************************Завдання 1*************************************************/				
							case 'zadanka1':
							echo '<div class="menus menu2"><center>Достижения '.utf($user['login']).'</center></div>';
							echo '<div class="main_zd">';
							$lock1 = $user['z1_lock'];
							if ($lock1 > 2) {
							echo '<div class="list_item">
							<img src="img/1.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Хороший друг (Рейтинг +0.2)  <br>
							<b class="service_item"> Статус: </b> Выполнено <br>
							<b class="service_item"> Описание: </b> Набрать 5 рефералов
							</div>';


							}else{
							echo '
							<div class="list_item">';

							echo '<div class="list_item">
							<img src="img/1b.png" width="40" height="40 alt=""><br>
							<b class="service_item"> Название: </b> Хороший друг (Рейтинг +0.2)  <br>
							<b class="service_item"> Статус: </b> Не выполнено <br>';
							$count_refuser = mysql_result(mysql_query("select count(`id`) from `ref` where `who`='".$user['login']."'"), 0);
							?></br><?php
							if ($count_refuser['login'] >4)
								
										echo '<br /><br /><a href="'.ROOT.'/dostj/?act=completezd1" style="border: 2px dotted navy; padding: 2px; text-decoration: none; color: red;">Получить 0.2 рейтинга</a>';

								else {
										echo'
										<b class="service_item"> Описание: </b>Для достижения Вам надо набрать <font color="red">5</font> рефералов. У вас '.$count_ref.' рефералов.
										</div>
										<div class="m">
										Чтобы пригласить своих друзей по вашей реф.ссылке , скопируйте вашу реф.ссылку и отправьте ее своим друзьям.</br>
										Ваша реф.ссылка: <input type="text" value="'.ROOT.'/?ref='.utf($user['login']).'"/></br>
										<b>'.ROOT.'/?ref='.utf($user['login']).'</b> ';
										}

	}
echo '</div>';
echo '
</div>';
back();
break;
}
echo'</div>';


include ('../inc/foot.php');