<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập & Đăng ký - Quản lý Bán Hàng</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #ff416c;
            background: -webkit-linear-gradient(to right, #ff4b2b, #ff416c);
            background: linear-gradient(to right, #ff4b2b, #ff416c);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        h1 {
            font-weight: bold;
            margin: 0 0 20px;
            color: #333;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
            margin-bottom: 15px;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        button {
            border-radius: 20px;
            border: 1px solid #ff4b2b;
            background-color: #ff4b2b;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
            margin-top: 15px;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }
        
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            width: 100%;
            font-size: 13px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

<div class="container" id="container">
    <!-- KHUNG ĐĂNG KÝ -->
    <div class="form-container sign-up-container">
        <form action="/Baitaplon/Login/SubmitRegister" method="POST">
            <h1>Tạo Tài Khoản</h1>
            <span>hoặc sử dụng email của bạn để đăng ký</span>
            
            <?php if(isset($_SESSION['register_error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['register_error']; 
                        unset($_SESSION['register_error']);
                    ?>
                </div>
            <?php endif; ?>

            <input type="text" name="txtHoTen" placeholder="Họ và Tên" required />
            <input type="text" name="txtUser" placeholder="Tên đăng nhập" required />
            <input type="password" name="txtPass" placeholder="Mật khẩu" required />
            <button type="submit" name="btnRegister">Đăng Ký</button>
        </form>
    </div>

    <!-- KHUNG ĐĂNG NHẬP -->
    <div class="form-container sign-in-container">
        <form action="/Baitaplon/Login/SubmitLogin" method="POST">
            <h1>Đăng Nhập</h1>
            <span>sử dụng tài khoản của bạn</span>

            <?php if(isset($_SESSION['login_error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['login_error']; 
                        unset($_SESSION['login_error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['register_success'])): ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['register_success']; 
                        unset($_SESSION['register_success']);
                    ?>
                </div>
            <?php endif; ?>

            <input type="text" name="txtUser" placeholder="Tên đăng nhập" required />
            <input type="password" name="txtPass" placeholder="Mật khẩu" required />
            <button type="submit" name="btnLogin">Đăng Nhập</button>
        </form>
    </div>

    <!-- KHUNG HIỆU ỨNG TRƯỢT -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Chào mừng trở lại!</h1>
                <p>Để tiếp tục kết nối với hệ thống, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                <button class="ghost" id="signIn">Đăng Nhập</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Xin chào, Bạn Mới!</h1>
                <p>Hãy nhập thông tin cá nhân và bắt đầu hành trình quản lý cùng chúng tôi</p>
                <button class="ghost" id="signUp">Đăng Ký</button>
            </div>
        </div>
    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

</body>
</html>
