<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="home.css">
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
            echo "<script> window.location.replace('http://localhost/p4c_6/home/login_home.php?page=1');</script>";
        }
    ?>

    <a class="logo" href="home.php">P4C 6th</a>

    <hr size="2px" noshade>

    <form id="search_box" action="paging.php?" method="get">
        <select name="search_option" id="search_option">
            <option value=all>전체</option>
            <option value=title>제목</option>
            <option value=content>내용</option>
        </select>
            
        <input id="search" type="text" id="search" name="search" placeholder="검색어 입력">
        <button type="submit">검색</button>
    </form>

    <div class="v_line"></div>

    <ol class="menu">
        <li><a href="../write/write_page.php">글쓰기</a></li>
        <li><a href="../paging/paging.php?page=1">전체 보기</a></li>
    </ol>
    

    <div class="login_join">
        <a href="/p4c_6/login/login_page.php">로그인</a>
        |
        <a href="/p4c_6/join/join_page.php">회원가입</a>
    </div>

    <?php
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

        $sql = 'select * from visitor';
        $result = mysqli_query($connect, $sql);            
        $row = mysqli_fetch_array($result);

        $count = $row['total'];

        if(!isset($_COOKIE['visitor']))
        {
            $count += 1;
            $add_visitor = 'update visitor set total='.$count;
            mysqli_query($connect, $add_visitor);
        }

        setcookie("visitor", "asdfasdf", time() + 3600);
                        
        $result = mysqli_query($connect, $sql);            
        $row = mysqli_fetch_array($result);
        $count = $row['total'];

        mysqli_close($connect);
    ?>

    <div class="visitor">
        <?php
            echo "전체 방문자: ".$count;
        ?>
    </div>

    
</body>
</html>