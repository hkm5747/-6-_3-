<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="join_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
</head>

<body>
    <?php
        if(!session_id()) 
        {
            session_start();
        }

        if(isset($_SESSION['login'])) 
        {
            echo "<script> window.location.replace('http://localhost/p4c_6/home/login_home.php');</script>";
        }
    ?>

    <a class="logo" href="../home/home.php">P4C 6th</a>

    <hr size="2px" noshade>

    <div class="search">
        <input type="text" placeholder="검색어 입력">
        <button onclick="alert('hello world')">검색</button>
    </div>

    <form action="check.php" method="post">
        <input name="email" id="email" type="email" autocomplete="off" maxlength='100' placeholder=" 이메일">
        <input name="id" id = "id" type="text" autocomplete="off" maxlength='20' placeholder=" 아이디">
        <input id="pw" name="pw" type="password" maxlength='20' placeholder=" 비밀번호">
        <input id="pw_check" name="pw_check" type="password" maxlength='20' placeholder=" 비밀번호 확인">
        <input type="submit" value='회원가입'>
    </form>
</body>
</html>