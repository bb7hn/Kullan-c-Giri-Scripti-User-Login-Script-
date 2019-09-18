<?php

session_start();

$kod = substr(md5(uniqid(rand(0, 6))), 0, 6);

$_SESSION['kod'] = $kod;

header('Content-type: image/png');

$kod_uzunluk = strlen($kod);
$genislik = imagefontwidth(20) * $kod_uzunluk;
$yukseklik = imagefontheight(20);

$resim = imagecreate($genislik, $yukseklik);

$arka_renk = imagecolorallocate($resim, 0, 131, 223);
$yazi_renk = imagecolorallocate($resim, 255, 255, 255);
imagefill($resim, 0, 0, $arka_renk);

imagestring($resim, 100, 0, 0, $kod, $yazi_renk);

imagepng($resim);

?>