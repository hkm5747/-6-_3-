<!DOCTYPE html>
<html>
    
</html>

<body>
    <?php
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');
        
        $id = $_POST['id'];
        $pw = $_POST['pw'];
        $email = $_POST['email'];

        $check_id = 'select * from members where id = '.'\''.$id.'\'';

        $result_id = mysqli_query($connect, $check_id);
        $id_row = mysqli_fetch_array($result_id);

        $check_email = 'select * from members where email = '.'\''.$email.'\'';
        $result_email = mysqli_query($connect, $check_email);
        $email_row = mysqli_fetch_array($result_email);

        if(!$id or !$pw or !$email)
        {
            if(!$id or !$pw)
            {
                echo "<script> alert('id 또는 pw를 입력해주세요.'); </script>";
            }
            else
            {
                echo "<script> alert('email을 입력해주세요.'); </script>";
            }

            echo "<script> window.location.replace('http://localhost/p4c_6/join/join_page.php'); </script>";
        }

        if(isset($id_row['id']))
        {
            echo "<script> alert('이미 있는 아이디 입니다.'); </script>";
            echo "<script> window.location.replace('http://localhost/p4c_6/join/join_page.php'); </script>";
        }

        if(isset($email_row['email']))
        {
            echo "<script> alert('이미 가입하셨습니다.'); </script>";
            echo "<script> window.location.replace('http://localhost/p4c_6/join/join_page.php'); </script>";
        }

        else
        {
            $pw = $_POST['pw'];
            $pw_check = $_POST['pw_check'];

            if($pw != $pw_check)
            {
                echo "<script> alert('비밀번호가 틀립니다.'); </script>";
                echo "<script> window.location.replace('http://localhost/p4c_6/join/join_page.php'); </script>";
            }

            else
            {
                echo "<script> window.location.replace('http://localhost/p4c_6/join/email/email.php?email=".$email."&id=".$id."&pw=".$pw."'); </script>";
            }
    
        }

        mysqli_close($connect);
    ?>  
</body>
