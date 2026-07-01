<?php
     session_start();

      if(!isset($_SESSION['user_login'])){
    // Chuyển hướng về trang đăng nhập của BaiTapLon
    header("Location: /Baitaplon/Login");
    exit;
}
     include_once './MVC/bridge.php';
     $myapp=new app();
?>
