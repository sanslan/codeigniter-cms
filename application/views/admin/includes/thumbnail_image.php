<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <style>
        .media-wrapper img{
            max-width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }
        .media-wrapper{
            width: 180px;
            display: inline-block;
            height: 180px;
        }
    </style>
</head>
<body>
    <div class="gallery">
        <?php foreach($files as $file): ?>
            <div data-file="<?php echo $file->name; ?>" class="media-wrapper" data-toggle="modal" data-target="#myModal<?php echo $file->id;?>">
                <img src="http://ci-blog.loc/<?php echo $file->name ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        $(document).ready(function(){
            $(".media-wrapper").click(function(){
                window.opener.replaceThumbnail($(this).data('file'))
                window.close()
            })
        });
    </script>
</body>
</html>