<?php 
    class connectDB{
        public $con;
        function __construct()
        {
            $host = getenv('DB_HOST') ?: 'localhost';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASS') ?: '';
            $dbname = getenv('DB_NAME') ?: 'Baitaplon';

            $this->con = mysqli_connect($host, $user, $pass, $dbname);
            mysqli_query($this->con,"SET NAMES 'utf8'");
        }
    }
?>