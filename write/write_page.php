<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="write_page.css">
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

    <form action="write.php" method='post' enctype="multipart/form-data">
        <center class="full">
            <input name="title" id = "title" type="text" autocomplete="off" placeholder=" 제목을 입력하세요">
            <br>

            <textarea name="content" id="content" cols="30" rows="10"></textarea>
            <br>

            <label id="upload_button" for="uploadfile">파일 업로드</label>
            <input type="file" name="uploadfile" id="uploadfile">

            <input type="submit" id="write" value='글 쓰기'>
        </center>
    </form>
</body>
</html>