<?php 
include '../utils/config.php';

$id = $_GET['id'];
 
mysqli_query($conn,"DELETE FROM user where id='$id'");
 
echo '<script>alert("Berhasil menghapus user!")
                    window.location.href = "index.php";
                    </script>';
 
?>