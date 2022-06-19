<?php 
    include '../utils/config.php';

    $id = $_GET['id'];
    $getUser = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
    $dataUser = mysqli_fetch_assoc($getUser);

    mysqli_query($conn,"UPDATE `user` SET `verified`='1' WHERE id='$id'");

    echo '<script>alert("Berhasil memverifikasi user!")
                    window.location.href = "index.php";
                    </script>';
?>