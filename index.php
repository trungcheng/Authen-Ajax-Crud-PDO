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
        <div class="container col-md-8 col-md-offset-2">
            <h1 class="text-center">Tất cả bài viết</h1>
            <a href="thembaiviet.php" class="btn btn-success">Thêm mới</a>
            <table class="table table-hover" style="margin-top:30px;">
                <thead>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Hình ảnh</th>
                    <th>Chức năng</th>
                </thead>
                <tbody>
                    <?php
                        require('db.php');

                        if(isset($_GET['id']) && isset($_SESSION['user'])){
                            $id= $_GET['id'];
                            $query = $conn->prepare("UPDATE baiviet SET deleted = 1 WHERE id = :id");
                            $query->bindParam(':id', $id);
                            $query->execute();
                            header('location: index.php');
                        }
                        $query1 = $conn->prepare("SELECT * FROM baiviet WHERE deleted = 0");
                        $query1->execute();
                        $result = $query1->fetchAll();
                        if(count($result)>0){
                            foreach($result as $rows){
                                ?>
                                <tr>
                                    <td><?= $rows['id'] ?></td>
                                    <td><?= $rows['title'] ?></td>
                                    <td><?= $rows['content'] ?></td>
                                    <td><img src="<?= $rows['image'] ?>" width="80px" height="70px;" /></td>
                                    <td>
                                        <a href="suabaiviet.php?id=<?= $rows['id'] ?>" class="btn btn-primary">Sửa</a>
                                        <a onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa bài viết này !')" href="index.php?id=<?= $rows['id'] ?>" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<script type="text/javascript">
    function xacnhanxoa(msg){
        if(sessionStorage["user"] == null){
            window.confirm(msg);
            alert("Bạn cần đăng nhập để xóa được bài viết !");
        }else{
            window.confirm(msg);
        }
    };
</script>

