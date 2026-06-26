<?php 
    class connectDB{
        public $con;
        function __construct()
        {
            // Đọc biến môi trường từ Docker, nếu không có thì chạy mặc định của XAMPP
            $host = getenv('DB_HOST') ?: 'localhost';
            $password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
            
            $this->con=mysqli_connect($host,'root',$password,'Baitaplon');
            mysqli_query($this->con,"SET NAMES 'utf8'");
        }
    }
?>