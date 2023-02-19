<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="paging.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
</head>

<body>
    <a class="logo" href="../home/home.php">P4C 6th</a>

    <hr size="2px" noshade>

    <?php
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

        $num = $_GET['num'];

        $bring_posting = 'select * from posting where num = '.$num;
        $result = mysqli_query($connect, $bring_posting);
        $row = mysqli_fetch_array($result);

        $filename = "download.php?filename=".$row['file'];

        echo $row['title']."<br>";
        echo $row['content']."<br>";
        echo "<a href='".$filename."'>".$row['file']."</a>";

        $view = 'select * from posting where num = '.$num;
        $result = mysqli_query($connect, $view);            
        $row = mysqli_fetch_array($result);
        
        $cookie = "views".$num;

        $count = $row['views'];
        $session = 'view'.$num;

        if(!isset($_COOKIE[$cookie]) || $_COOKIE[$cookie] != $num)
        {
            setcookie($cookie, $num, time() + 3600);
            $count += 1;
            $add_visitor = 'update posting set views = '.$count.' where num = '.$num;
            mysqli_query($connect, $add_visitor);
        }
                
        $result = mysqli_query($connect, $view);            
        $row = mysqli_fetch_array($result);
        $count = $row['views'];
            
        echo "<br><br>조회수 : ".$count;

        //button text
        if(!session_id()) 
        {
            session_start();
        }

        if(isset($_SESSION['login']))
        {
            $user = $_SESSION['login'];
            $check_recommend = "select * from recommend where user = '".$user."' and posting_num =".$num;
            $check_result = mysqli_query($connect, $check_recommend);
            $check_row = mysqli_fetch_array($check_result);
        }

        if(isset($check_row['user']))
        {
            if($check_row['recommend_status'] == 1)
            {
                $button_text = "추천중";
            }
            else
            {
                $button_text = "추천";
            }
        }
        else
        {
            $button_text = "추천";
        }

        mysqli_close($connect);
    ?>

    <br><br>
    <button id="recommend_button" type="submit" onclick="call_recommend();"><?php echo $button_text ?></button>
    

    <br>
    <br>
    <br>
    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
    <br>
    <input type="submit" id="comment_button" value="댓글 작성" onclick="call_comment()">
    <br>

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
            
            $user = $_SESSION['login'];
            
            $comment_count = "select count(*) from comment where user = '".$user."' and posting_num = ".$num;

            $count_comment_sql = mysqli_query($connect, $comment_count);
            $count_row = mysqli_fetch_array($count_comment_sql);
            
            $total_comment = $count_row['count(*)'];

            if($total_comment > 0)
            {
                for($i = 0; $i < $total_comment; $i += 1)
                {
                    $bring_comment = "select * from comment order by id desc limit ".$i.", 1";

                    $bring_comment_sql = mysqli_query($connect, $bring_comment);
                    $bring_row = mysqli_fetch_array($bring_comment_sql);

                    echo "<br>".$bring_row['comment'];
                }
            }

            else
            {
                echo "<br><br>아직 댓글이 없습니다.";
            }
            
        }
    ?>

</body>
</html>

<script>
        function call_recommend()
        {
            var url = new URL(location.href).searchParams;
            var num = url.get('num');

            var recommend_page = 'http://localhost/p4c_6/home/paging/recommend.php?num=' + num;

            window.location.replace(recommend_page);
        }

        function call_comment()
        {
            var url = new URL(location.href).searchParams;
            var num = url.get('num');
            var comment = document.getElementById('comment').value;

            if(!comment)
            {
                alert("댓글을 입력해 주세요.");
                window.location.replace("http://localhost/p4c_6/home/paging/show.php?num="+num);
            }

            else
            {
                var comment_page = 'http://localhost/p4c_6/home/paging/comment.php?num=' + num + '&comment=' + comment;

                window.location.replace(comment_page);
            }
            
        }
</script>