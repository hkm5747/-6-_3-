<?php
    $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');
    
    $filename = $_GET['filename'];                      
    // $reail_filename = urldecode("미래 리스트.txt");    
    $file_dir = "../upload/".$filename;  
    
    
    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize($file_dir));
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');

    ob_clean();
    
    readfile($file_dir);

    mysqli_close($connect);
?>