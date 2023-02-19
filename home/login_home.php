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

        if(!isset($_SESSION['login'])) 
        {
            echo "<script> alert('로그인을 먼저 해주세요'); </script>";
            echo "<script> window.location.replace('http://localhost/p4c_6/login/login_page.php');</script>";
        }

        else
        { 
    ?>
    <a class="logo" href="home.php">P4C 6th</a>

    <hr size="2px" noshade>

    <form id="search_box" action="login_home.php" method="get">
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
        <li><a href="..//write/write_page.php">글쓰기</a></li>
        <li><a href="./notice.php?page=1">공지</a></li>

    </ol>

    <div class="login_join">
        user: 
        <?php
            if(!session_id()) 
            {
                session_start();
            }

            echo $_SESSION['login'];
        ?>
        |
        <a href="/p4c_6/logout/logout.php">로그아웃</a>
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

    <div id="show_posting">
        <!-- show posting -->
        <table border="1" width="1500" height="500">
            <thead>
                <tr>
                    <th>제목</th>
                    <th>조회수</th>
                    <th>작성일</th> 
                    <th>추천</th>   
                </tr>

            </thead>
            
            <tbody>
                <?php
                    $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

                    $show_posting = 10;

                    if(isset($_GET['search_option']))
                    {
                        $option = $_GET['search_option'];
                        $search = $_GET['search'];

                        if(!isset($_GET['page']))
                        {
                            echo "<script> location.href = 'http://localhost/p4c_6/home/login_home.php?search_option=".$option."&search=".$search."&page=1' </script>";
                        }

                        if($option == 'all')
                        {
                            $search_all = "select * from posting where (title like '%".$search."%' or content like '%".$search."%')";
                            $count_posting = "select count(*) from posting where (title like '%".$search."%' or content like '%".$search."%')";

                        }

                        elseif($option == 'title')
                        {
                            $search_all = "select * from posting where title like '%".$search."%'";
                            $count_posting = "select count(*) from posting where title like '%".$search."%'";

                        }

                        else
                        {
                            $search_all = "select * from posting where content like '%".$search."%'";
                            $count_posting = "select count(*) from posting where content like '%".$search."%'";

                        }

                        $result_count_posting = mysqli_query($connect, $count_posting);
                        $row_count = mysqli_fetch_array($result_count_posting);

                        
                        $total_posting = $row_count['count(*)'];
                        
                        $total_page = floor($total_posting / $show_posting) + 1;
                        
                        if($total_posting % $show_posting == 0)
                        {
                            $total_page = $total_posting / $show_posting;
                        }
                        
                        for($i = 1; $i <= $total_page; $i += 1)
                        {
                            echo "<a id='page_num' href='./login_home.php?search_option=".$option."&search=".$search."&page=".$i."'>".$i."</a>"; 
                        }

                        if($_GET['page'] == $total_page)
                        {
                            $show_posting = $total_posting; 
                        }

                        else
                        {
                            $show_posting = $_GET['page'] * 10;
                        }

                        for($i = ($_GET['page'] - 1) * 10; $i < $show_posting; $i += 1) 
                        { 
                            $bring_posting = $search_all." order by num desc limit ".$i.", 1";

                            $result = mysqli_query($connect, $bring_posting);
                            $row = mysqli_fetch_array($result);
                            
                            if($total_posting == 0)
                            {
                                echo "<script>window.location.replace('http://localhost/p4c_6/home/login_home.php?page=1')</script>";
                            }

                            else
                            {
                                $show = "./paging/show.php?num=".$row['num'];
                            }
                            
                ?>
                            <tr>
                                <td> <?php echo "<a href='".$show."'>".$row['title']."</a>"; ?> </td>
                                <td><?php echo $row['views'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['total_recommend'] ?></td>
                            </tr>
                <?php
                    }}
                ?>
                

                <?php
                    if(!isset($_GET['search_option']))
                    {
                        $count_posting = 'select count(*) from posting';
                        $result = mysqli_query($connect, $count_posting);
                        $row = mysqli_fetch_array($result);
                
                        $total_posting = $row['count(*)'];
                        
                        $total_page = floor($total_posting / $show_posting) + 1;

                        if($total_posting % $show_posting == 0)
                        {
                            $total_page = $total_posting / $show_posting;
                        }

                        for($i = 1; $i <= $total_page; $i += 1)
                        {
                            echo "<a id='page_num' href='./login_home.php?page=".$i."'>".$i."</a>";  
                        }
                    
                        if($_GET['page'] == $total_page)
                        {
                            $show_posting = $total_posting; 
                        }

                        else
                        {
                            $show_posting = $_GET['page'] * 10;
                        }

                        for($i = ($_GET['page'] - 1) * 10; $i < $show_posting; $i += 1) 
                        { 
                            $bring_posting = 'select * from posting order by num desc limit '.$i.', 1';

                            $result = mysqli_query($connect, $bring_posting);
                            $row = mysqli_fetch_array($result);    

                            if($total_posting == 0)
                            {
                                echo "<script> alert('글이 없습니다.'); </script>";
                                echo "<script>window.location.replace('http://localhost/p4c_6/home/login_home.php')</script>";
                            }

                            else
                            {
                                $show = "./paging/show.php?num=".$row['num'];
                            }
                ?>
                        <tr>
                            <td> <?php echo "<a href='".$show."'>".$row['title']."</a>"; ?> </td>
                            <td><?php echo $row['views'] ?></td>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['total_recommend'] ?></td>
                        </tr>
                <?php 
                    }}}

                    mysqli_close($connect);
                ?> 
            </tbody>
        </table>
        <!-- show posting -->
    </div>
</body>
</html>