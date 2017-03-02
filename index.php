<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/main.css">
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <form action="upload.php" method="POST" enctype="multipart/form-data" id="uploadform">
            <input type="file" name="file" id="upfile" />

            <div id="dragdrop">
                Для загрузки, перетащите файл сюда.
            </div>

            <input type="submit">
        </form>
    </body>
</html>