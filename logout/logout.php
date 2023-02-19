<?php
    if(!session_id()) 
    {
        session_start();
    }

    if(isset($_SESSION['login'])) 
    {
        $flag = true;
    }

    if($flag)
    {
        session_destroy();
        echo "<script> alert('로그아웃 했습니다.'); </script>";
        echo "<script> window.location.replace('http://localhost/p4c_6/home/home.php'); </script>";
    }
?>