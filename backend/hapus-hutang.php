<?php 
include '../utils/config.php';

$id = $_GET['id'];
 
mysqli_query($conn,"DELETE FROM hutang where id='$id'");

echo '<script>alert("Berhasil menghapus hutang!")
                    window.location.href = "../index.php";
                    </script>';
 
?>