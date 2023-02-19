<?php
    if(!session_id()) 
    {
        session_start();
    }

    if(!isset($_SESSION['login'])) 
    {
        echo "<script> alert('로그인을 먼저 해주세요'); </script>";
        echo "<script> window.location.replace('http://localhost/p4c_6/login/login_page.php');</script>";
    }

    else
    {
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

        $comment = $_GET['comment'];
        $user = $_SESSION['login'];
        $num = $_GET['num'];
        
        $insert_comment = "insert into comment(user, posting_num, comment) values('".$user."', ".$num.", '".$comment."')";
        
        mysqli_query($connect, $insert_comment);
        
        mysqli_close($connect);
    }

    $return_page = 'http://localhost/p4c_6/home/paging/show.php?num='.$num;
    echo "<script> window.location.replace('".$return_page."'); </script>";

?>