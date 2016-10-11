<?php
/*
 * 生成zip需要用到的方法，不需要修改
 */
function addFileToZip($path,$zip){
    $handler=opendir($path); //打开当前文件夹由$path指定。
    while(($filename=readdir($handler))!==false){
        if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                addFileToZip($path."/".$filename, $zip);
            }else{ //将文件加入zip对象
                $zip->addFile($path."/".$filename);
            }
        }
    }
    @closedir($path);
}

/*
 * 生成zip步骤，使用php原生类，需要先生成zip文件，然后写入，个人觉得方法不错
 * 同样以时间戳命名(包括路径)
 */
$name = time();
//记得加zip尾缀
$path = "zip/".$name.".zip";
//首先创建zip文件，用fopen就可以了,记得创建后关闭
$file = fopen($path,'w');
fclose($file);
//还要设置一个需要存入zip中的文件路径
$set_path = "images/";
//初始化zip类
$zip = new ZipArchive();
if($zip->open($path,ZipArchive::OVERWRITE)===TRUE){  //判断是否开启并具有write权限？
    addFileToZip($set_path, $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
    $zip->close();//关闭处理的zip文件
}
//这样zip的路径就成了  zip/??.zip , ??为你设置的时间戳