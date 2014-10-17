<?php
    //download.txt保存下载的次数
    $fp = fopen("download.txt","r+");
    if($fp) 
    {
        $number = fgets($fp);
        $number += 1;
        file_put_contents("download.txt",$number);

    }
    else 
    { 
        echo "打开文件失败"; 
    } 

    fclose($fp); 
?>
