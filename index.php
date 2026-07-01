<?php
     session_start();

     // Tạm thời tắt kiểm tra đăng nhập để chạy độc lập trên Docker/VM (Vào thẳng trang quản trị)
     // if(!isset($_SESSION['user_login'])){
     //     // Đuổi về trang đăng nhập của Baitaplon
     //     header("Location: http://localhost/Baitaplon/Login");
     //     exit;
     // }
     include_once './MVC/bridge.php';
     $myapp=new app();
?>