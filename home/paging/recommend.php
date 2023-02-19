<?php
    if(!session_id()) 
    {
        session_start();
    }

    if(isset($_SESSION['login'])) 
    {
        $flag = true;
    }

    if($flag)
    {
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');
        
        $user = $_SESSION['login'];

        $num = $_GET['num'];

        $check_total_recommend = "select * from posting where num = ".$num;
        
        $result = mysqli_query($connect, $check_total_recommend);
        $row = mysqli_fetch_array($result);

        $total_recommend = $row['total_recommend'];


        $check_recommend = "select * from recommend where user = '".$user."' and posting_num =".$num;
        $check_result = mysqli_query($connect, $check_recommend);
        $check_row = mysqli_fetch_array($check_result);

        if(!isset($check_row['user']))
        {
            $total_recommend += 1;

            $recommend = "insert into recommend(user, posting_num, recommend_status) values('".$user."', ".$num.", 1)";
            mysqli_query($connect, $recommend);
            
            $add_recommend = "update posting set total_recommend = ".$total_recommend." where num = ".$num;
            mysqli_query($connect, $add_recommend);
        }

        if(isset($check_row['user']))
        {
            if($check_row['recommend_status'] == 1)
            {
                $total_recommend -= 1;
                
                $no_recommend = "update recommend set recommend_status = 0 where user = '".$user."' and posting_num = ".$num;
                mysqli_query($connect, $no_recommend);

                $sub_recommend = "update posting set total_recommend = ".$total_recommend." where num = ".$num;
                mysqli_query($connect, $sub_recommend);
            }

            else
            {
                $total_recommend += 1;
                
                $no_recommend = "update recommend set recommend_status = 1 where user = '".$user."' and posting_num = ".$num;
                mysqli_query($connect, $no_recommend);

                $sub_recommend = "update posting set total_recommend = ".$total_recommend." where num = ".$num;
                mysqli_query($connect, $sub_recommend);
            }
        }


        $url = "http://localhost/p4c_6/home/paging/show.php?num=".$num;
        echo "<script> window.location.replace('$url'); </script>";

        mysqli_close($connect);
    }
?>