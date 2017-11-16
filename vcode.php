<?php  
session_start();
Header("Content-type: image/PNG");
$im = imagecreate(75,25);
$back = ImageColorAllocate($im, 245,245,245);
imagefill($im,0,0,$back);
$vcodes = "";

$calMethod=str_split('+-');
$cal1=rand(10,30);
$cal2=rand(1,$cal1);
$vcodes=$cal1.$calMethod[rand(0,1)].$cal2;
$randChar=str_split($vcodes.'=?');

for($i=0,$sizev=sizeof($randChar);$i<$sizev;$i++){
$font = ImageColorAllocate($im, rand(50,200),rand(50,200),rand(50,200)); 
imagestring($im, 5, 5+$i*10,8, $randChar[$i], $font);
}

$_SESSION['VCODE']=eval("return $vcodes;");

for($i=0;$i<40;$i++)
{
$randcolor = ImageColorallocate($im,rand(20,200),rand(50,200),rand(50,200));
imagesetpixel($im, rand()%70,rand()%30,$randcolor);
}
ImagePNG($im);
ImageDestroy($im);