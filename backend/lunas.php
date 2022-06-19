<?php 
    include '../utils/user-session.php';

    $id = $_GET['id'];
    $resHutang = mysqli_query($conn, "SELECT * FROM hutang WHERE id='$id'");
    $data = mysqli_fetch_assoc($resHutang);
    $sisaHutang = $data['sisa_hutang'];

    mysqli_query($conn,"UPDATE `hutang` SET `sisa_hutang`='0' WHERE id='$id'");

    date_default_timezone_set('Asia/Jakarta');
    $date = date('y-m-d');
    $date = "20".$date;

    mysqli_query($conn, "INSERT INTO `riwayat_bayar`(`id`, `id_hutang`, `id_user`, `jumlah_bayar`, `status`, `tanggal`) VALUES ('','$id', '$userId', '$sisaHutang','Lunas','$date')");

    echo '<script>alert("Hutang Lunas!")
                    window.location.href = "../index.php";
                    </script>';
?>