<?php
    if(!session_id()) 
    {
        session_start();
    }

    if(isset($_SESSION['login'])) 
    {
        $flag = true;
    }
    
    else
    {
        echo "<script> alert('로그인을 먼저 해주세요'); </script>";
        echo "<script> window.location.replace('http://localhost/p4c_6/login/login_page.php'); </script>";
    }
?>