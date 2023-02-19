<?php

?>
<!DOCTYPE html>
<html>

</html>

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
            $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');
            
            $title = $_POST['title'];
            $content = $_POST['content'];

            if(!$title or !$content)
            {
                echo "<script> alert('제목 또는 내용을 입력해 주세요.'); </script>";
                echo "<script> history.back(); </script>";
            }

            else
            {
                date_default_timezone_set('Asia/Seoul');
                $date = date("Y/m/d");
                $title = iconv("UTF-8", "EUC-KR", $title);
                $content = iconv("UTF-8", "EUC-KR", $content);

                if(isset($_FILES['uploadfile']['name']))
                {
                    $tmpfile =  $_FILES['uploadfile']['tmp_name'];
                    $filename = $_FILES['uploadfile']['name'];
                    $folder = "../upload/".$filename;
                        
                    move_uploaded_file($tmpfile,$folder);

                    $write = 'insert into posting(title, content, file, date) values("'.$title.'","'.$content.'","'.$filename.'","'.$date.'")';
                }

                else
                {
                    $write = 'insert into posting(title, content, date) values("'.$title.'","'.$content.'","'.$date.'")';
                }

                mysqli_query($connect, $write);

                mysqli_close($connect);

                echo "<script> alert('게시물 작성 완료.'); </script>";
                echo "<script> window.location.replace('http://localhost/p4c_6/home/home.php'); </script>";
            }
        }

    ?>  
</body>