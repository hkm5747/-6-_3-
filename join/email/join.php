<?php
    $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

    $id = $_GET['id'];
    $pw = $_GET['pw'];
    $email = $_GET['email'];

    $insert_member = "insert into members(id, pw, email) values('".$id."'".","."'".$pw."'".","."'".$email."')";
    
    mysqli_query($connect, $insert_member);
    
    echo "<script> alert('회원가입 성공'); </script>";
    
    $_GET['id'] = null;
    
    echo "<script> window.close(); </script>";

    mysqli_close($connect);
?>