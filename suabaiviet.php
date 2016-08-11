<?php
    require('db.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = $conn->prepare("select * from baiviet where id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch();

        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $content = $_POST['content'];

            $micro_time = microtime();
            $micro_time = str_replace(" ","_",$micro_time);
            $micro_time = str_replace(".","_",$micro_time);

            $filename = $_FILES["upload"]["name"];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/";
            $target_file = $target_dir . $micro_time . "." . $extension;

            $uploaded = move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file);
            if($uploaded){
                $result = $conn->prepare("UPDATE baiviet SET title=:title, content=:content, image=:image WHERE id = :id");
                $result->bindParam(':title', $title);
                $result->bindParam(':content', $content);
                $result->bindParam(':image', $target_file);
                $result->bindParam(':id', $id);
                $result->execute();
                header("location: index.php");
            }else{
                $result = $conn->prepare("UPDATE baiviet SET title=:title, content=:content WHERE id = :id");
                $result->bindParam(':title', $title);
                $result->bindParam(':content', $content);
                $result->bindParam(':id', $id);
                $result->execute();
                header("location: index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo upload file</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<?php include 'navbar-layout.php' ?>
<div class="container col-md-6 col-md-offset-3">
    <?php
        if(!isset($_SESSION['user'])){
    ?>
        <div class="alert alert-danger">
            <p class="text-center">Bạn cần đăng nhập để chỉnh sửa bài viết !</p>
        </div>
    <?php
        }else{
    ?>
    <h1 class="text-center">Cập nhật bài viết</h1>

    <form action="" method="post" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" id="title" class="form-control" name="title" value="<?= $result['title'] ?>" />
        </div>
        <div class="form-group">
            <label for="content">Nội dung bài viết</label>
            <textarea id="content" name="content" class="form-control"><?= $result['content'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="title">Hình ảnh cũ: </label><br>
            <img src="<?= $result['image'] ?>" width="80px" height="70px" />
        </div>
        <div class="form-group">
            <label for="upload">Hình ảnh mới: </label>
            <input type="file" id="upload" name="upload" />
        </div>
        <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Cập nhật" />
    </form>
    <?php
        }
    ?>
</div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        if(sessionStorage["user"] == null){
            $('#alert').delay(2000).slideUp();
            setTimeout(function(){
                window.location.href = 'index.php';
            },3000);
        }
    })
</script>