<!DOCTYPE html>
<html>

</html>

<body>
    <?php
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');
        
        $id = $_POST['id'];
        $pw = $_POST['pw'];

        $check_id_sql = 'select * from members where id = '.'\''.$id.'\'';

        $result = mysqli_query($connect, $check_id_sql);
        $row = mysqli_fetch_array($result);

        if($id == isset($row['id']) and $pw == $row['pw'])
        {
            echo "<script> alert('로그인 성공'); </script>";

            if(!session_id()) 
            {
                session_start();
            }
            
            $_SESSION['login'] = $id;

            echo "<script>window.location.replace('http://localhost/p4c_6/home/login_home.php?page=1')</script>";
        }

        else
        {
            echo "<script>alert('로그인 실패');</script>";
            $logout = 'update members set login_status = 0 where id = "'.$id.'"';
            echo "<script>window.location.replace('http://localhost/p4c_6/login/login_page.php')</script>";
        }

        mysqli_close($connect);
    ?>  
</body>
