<?php
session_name('SID') . session_start();
$_SESSION['code'] = rand(1111,9999);
for($i=0;$i < 4;$i++)
$arr[$i]=substr($_SESSION['code'],$i,1); 
$im=imagecreate(80,20);
imagecolorallocate($im,255,255,255); 
$a=1; 
for($i=0;$i < 4;$i++){ 
$color=imagecolorallocate($im,0,0,0); 
imagestring($im,2,$a+=15,2,$arr[$i],$color); 
} 
header("Content-type: image/jpeg"); 
imagejpeg($im,'',100);

?>