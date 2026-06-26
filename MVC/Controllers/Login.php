<?php
class Login extends Controller {
    
    // Hàm xử lý đăng xuất
    public function Logout(){
        // 1. Hủy bỏ session
        session_unset();
        session_destroy();

        // 2. Chuyển hướng về trang đăng nhập của WinmartMVC (User)
        header("Location: /WinmartMVC/Login");
        exit;
    }
}
?>
