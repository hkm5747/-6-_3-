<!DOCTYPE html>
<html>
<head>
    <title>join</title>
    <link rel="stylesheet" href="upload_page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
</head>

<body>
    <a class="logo" href="../home/home.php">P4C 6th</a>

    <hr size="2px" noshade>

    <div class="search">
        <input type="text" placeholder="검색어 입력">
        <button onclick="alert('hello world')">검색</button>
    </div>

    <div class="login_join">
        <a href="/p4c_6/login/login_page.php">로그인</a>
        <a href="/p4c_6/join/join_page.php">회원가입</a>
    </div>

    <?php
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');

        $tmpfile =  $_FILES['uploadfile']['tmp_name'];
        $filename = $_FILES['uploadfile']['name'];
        $folder = "../upload/".$filename;
        move_uploaded_file($tmpfile,$folder);

        $sql = "insert into posting(file) values('test.txt')";

        mysqli_query($connect, $sql);

        mysqli_close($connect);

        header("https://youtube.com");
    ?>

    <script> type="text/javascript">alert("글쓰기 완료되었습니다.");</script>
    <a href="test()"></a>
    
    <?php
        $connect = mysqli_connect('localhost', 'root', 'p@ss12$$', 'p4c_6');
        
        $filename = "미래 리스트.txt";                      
        $reail_filename = urldecode("미래 리스트.txt");    
        $file_dir = "../upload/".$filename;  
        echo filesize($file_dir);
        header('Content-Type: application/octet-stream');
        header('Content-Length: '.filesize($file_dir));
        header('Content-Disposition: attachment; filename='.$reail_filename);
        header('Content-Transfer-Encoding: binary');

        ob_clean();
        readfile($file_dir);
    ?>
</body>
</html>

<!-- mysql에 저장된 파일 이름을 통해 다운로드 페이지 파라미터로 file name을 넘긴다. -->
<!-- mysql 특정 값만 가져오기 : select distinct file from posting where num=48; -->
<!-- ob_clean을 하지 않아 파일이 다운로드 되어도 열리지 않았다 -->