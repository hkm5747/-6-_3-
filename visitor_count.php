<!DOCTYPE html>
<html>
<head>
    <title>P4C_6</title>
</head>


<body>
        <?php
            $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

            $visitor_count = 'select * from posting whare';
            $result = mysqli_query($connect, $visitor_count);            
            $row = mysqli_fetch_array($result);

            $count = $row['total'];

            if(!isset($_COOKIE['visitor']))
            {
                $count += 1;
                $add_visitor = 'update visitor set total = '.$count;
                mysqli_query($connect, $add_visitor);
            }

            setcookie("visitor", "asdfasdf", time() + 3600);
                        
            $result = mysqli_query($connect, $visitor_count);            
            $row = mysqli_fetch_array($result);
            $count = $row['total'];

            mysqli_close($connect);
            
            echo "전체 방문자 : ".$count;
        ?>
</body>
</html>