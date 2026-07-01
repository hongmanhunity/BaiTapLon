<?php
class Login extends Controller {
    
    public $tkModel;

    public function __construct() {
        // Nạp Model Taikhoan để sử dụng
        $this->tkModel = $this->model("TaikhoanModel");
    }

    // Hiển thị giao diện Đăng nhập / Đăng ký
    public function Get_data(){
        // Nếu đã đăng nhập rồi thì đá về Home
        if(isset($_SESSION['user_login'])){
            header("Location: /Baitaplon/Home");
            exit;
        }
        
        // Gọi view Login_V, không cần dùng Master layout
        $this->view("pages/Login_V", []);
    }

    // Xử lý submit Đăng nhập
    public function SubmitLogin(){
        if(isset($_POST['btnLogin'])){
            $user = trim($_POST['txtUser']);
            $pass = trim($_POST['txtPass']);

            $account = $this->tkModel->CheckLogin($user, $pass);
            if($account){
                // Đăng nhập thành công, lưu Session
                $_SESSION['user_login'] = $account['username'];
                $_SESSION['user_role'] = $account['role'];
                $_SESSION['user_name'] = $account['hoten'];
                
                header("Location: /Baitaplon/Home");
                exit;
            } else {
                // Thất bại, quay lại kèm thông báo lỗi
                $_SESSION['login_error'] = "Tài khoản hoặc mật khẩu không chính xác!";
                header("Location: /Baitaplon/Login");
                exit;
            }
        }
    }

    // Xử lý submit Đăng ký
    public function SubmitRegister(){
        if(isset($_POST['btnRegister'])){
            $user = trim($_POST['txtUser']);
            $pass = trim($_POST['txtPass']);
            $hoten = trim($_POST['txtHoTen']);
            $role = 0; // Mặc định đăng ký là User (0)

            $kq = $this->tkModel->Insert($user, $pass, $hoten, $role);
            if($kq){
                $_SESSION['register_success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            } else {
                $_SESSION['register_error'] = "Tên đăng nhập đã tồn tại!";
            }
            header("Location: /Baitaplon/Login");
            exit;
        }
    }

    // Hàm xử lý đăng xuất
    public function Logout(){
        // 1. Hủy bỏ session
        session_unset();
        session_destroy();

        // 2. Chuyển hướng về trang đăng nhập của BaiTapLon
        header("Location: /Baitaplon/Login");
        exit;
    }
}
?>
