<?php
     session_start();

     // Kiểm tra xem người dùng đang cố gắng vào trang nào
     $url = isset($_GET['url']) ? $_GET['url'] : '';
     $urlParts = explode('/', filter_var(trim($url), FILTER_DEFAULT));
     $controller = isset($urlParts[0]) ? strtolower($urlParts[0]) : '';

     // Nếu chưa đăng nhập VÀ trang hiện tại không phải là trang Login -> Đuổi về Login
     if(!isset($_SESSION['user_login']) && $controller != 'login'){
         header("Location: /Baitaplon/Login");
         exit;
     }
     include_once './MVC/bridge.php';
     $myapp=new app();
?>
