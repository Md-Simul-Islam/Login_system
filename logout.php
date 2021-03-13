<?php
    session_start();
    setcookie('remember','Cookie set',time()-(600));
    session_destroy();
   header('location:login.php');
?>