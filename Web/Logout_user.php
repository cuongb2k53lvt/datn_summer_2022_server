<?php
    require "../dbconnect.php";
    session_start();
    session_unset();
    session_destroy();
    echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
?>