<?php

include 'library/QRcode.php';

$text = 'http://www.baidu.com';

// 保存路径
// false 为直接输出图片
// 为区分二维码，以时间戳命名
$name = time();
//记得带上后缀，否则无法生成
$filename = 'images/'.$name.".png";
// 清晰度menu(L(7%), M(15%), Q(25%), H(30%))  正常二维码应该为L ，没有具体调查过
$px = 'M';
// 图片尺寸  （设置为10的时候 图片大小经测试为270*270）；
$size = 10;
// 范围从 0（最差质量，文件更小）到 100（最佳质量，文件最大）。默认为 IJG 默认的质量值（大约 75）。
//这条没动过，没看过效果，正常生成二维码默认就可以
$quality = 1;
//控制是否显示 如果只是想生成二维码到指定文件夹里就设置 false就可以
//如果设置为true，则调用方法时会把二维码显示在页面上。
$set = false;
//最后调用这个方法就可以了，不用进行其它操作
QRcode::png($text, $filename, $px, $size, $quality,$set);
