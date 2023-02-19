<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
</head>

<body>
    <a class="logo" href="../home/home.php">P4C 6th</a>

    <br><br><br>
    <hr size="2px" noshade>

    <div class="search">
        <input type="text" placeholder="검색어 입력">
        <button onclick="alert('hello world')">검색</button>
    </div>

    <div class="login_join">
        <a href="/p4c_6/login/login_page.php">로그인</a>
        |
        <a href="/p4c_6/join/join_page.php">회원가입</a>
    </div>

    <?php
        if(!session_id()) 
        {
            session_start();
        }

        if(isset($_SESSION['login'])) 
        {
            $flag = true;
        }

        if(isset($flag))
        {
            echo "<script> window.location.replace('http://localhost/p4c_6/logout/logout_page.php'); </script>";
        }
    ?>

    <form action="login.php" method='post'>
        <center>
            <div class="login">
                <input name="id" id="id" type="text" autocomplete="off" placeholder=" 아이디"><br>
                <input name="pw" id="pw" type="password" placeholder=" 비밀번호"><br>
                <input id="login_button" type="submit" value='로그인'>
            </div>
        </center>
    </form>
</body>
</html>