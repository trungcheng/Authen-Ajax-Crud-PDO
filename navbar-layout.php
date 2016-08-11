<?php
    session_start();
?>
<div class="navbar navbar-default">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Practice</a>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Tất cả bài viết</a></li>
        </ul>
        <?php
            if(isset($_SESSION['user'])){
        ?>
            <ul class="nav navbar-nav pull-right">
                <li><a><?= $_SESSION['user']['username'] ?></a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        <?php
            }else{
        ?>
            <ul class="nav navbar-nav pull-right">
                <li><a>Guest</a></li>
                <li><a href="login.php">Đăng nhập</a></li>
            </ul>
        <?php
            }
        ?>
        
    </div>
</div>