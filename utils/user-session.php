<?php
    include 'config.php';

    error_reporting(0);
    session_start();
    
    $email = $_SESSION['user'];
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $userId = $user['id'];
?>