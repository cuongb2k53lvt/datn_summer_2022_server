<?php
    require "../dbconnect.php";
    session_start();
    session_unset();
    session_destroy();
    echo '<script type="text/JavaScript"> 
        window.open("http://datn4.000webhostapp.com/Web/Login_web.html","_self");
      </script>';
?>