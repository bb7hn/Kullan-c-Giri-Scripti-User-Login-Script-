<?php
session_start();
require_once ("inc/db.php");
require_once ("inc/functions.php");
if($_POST)
{
    $captcha        =  $_POST["captcha"];
    $dogrulamakodu  =  $_POST["dogrulamakodu"];

    if($_SESSION["kod"]==$captcha)
    {
        $dogrulama=mysqli_query($conn,"UPDATE uyeler SET dogrulamadurumu ='1' where dogrulamakodu='$dogrulamakodu'");
        if($dogrulama)
        {
            echo '0';
        }
        else
        {
            echo '1';
            if(file_exists("./inc/log.txt"))
            {
                $dosya = fopen('./inc/log.txt', 'a');
                fwrite($dosya, '\n'+mysqli_error($conn));
                fclose($dosya);
            }
            else
            {
                touch('./inc/log.txt');
                $dosya = fopen('./inc/log.txt', 'a');
                fwrite($dosya, '\n'+mysqli_error($conn));
                fclose($dosya);
            }
        }
    }
    else
    {
        echo '2';
    }
}
