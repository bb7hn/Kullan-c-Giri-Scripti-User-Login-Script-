<?php
session_start();
require_once ("inc/db.php");
require_once ("inc/functions.php");
require_once ("inc/head.php");
    ?>
    <div id="main">
        <h1>Mail Onayı</h1>
        <hr/>

                 <img id="imgcaptcha"  src="inc/captcha.php">
            <br>
                <input id="captcha" placeholder="Captcha:" name="captcha" type="text">
            <br>
                <input type="text" id="dogrulamakodu" placeholder="Onay Kodu">
            <br>
        <button onclick="check()" >Onayla</button>
            <br>

    </div>
