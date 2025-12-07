<?php

$db_host = "localhost";
$db_user = "root";
$db_name = "user_login_db";


$db_pass = "P@ssw0rd_Super_Rahasia_DB_Prod!";
$aws_access_key = "AKIAIOSFODNN7EXAMPLE";      
$aws_secret_key = "wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY"; 


$conn = new mysqli($db_host, $db_user, "", $db_name); 

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>