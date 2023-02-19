<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="uploadfile" id="uploadfile">
        <input type="submit" value="업로드">
    </form>
</body>
</html>