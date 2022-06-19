<?php
    include '../utils/user-session.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    $getFromDate = $_GET['fromDate'];
    $getToDate = $_GET['toDate'];

    $dataBayar = mysqli_query($conn, "SELECT * FROM riwayat_bayar WHERE (tanggal >= '$getFromDate' AND tanggal <= '$getToDate') AND id_user='$userId'");

    echo '<script>window.print()</script>';
    echo '<script>alert("Klik OK untuk kembali!")
                    window.location.href = "laporan.php";
                    </script>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bayar</title>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../images/icon-hutang.svg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5 mt-4">Data Bayar</h1>
        <h3>Tanggal: <span class="text-danger"><?php echo $getFromDate?></span> sampai <span
                class="text-danger"><?php echo $getToDate ?></span></h3>
        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover table-bordered">
                <thead class="fw-bold">

                    <tr>
                        <td>No</td>
                        <td>ID Hutang</td>
                        <td>Jumlah Bayar</td>
                        <td>Tanggal Bayar</td>
                        <td>Status</td>
                    </tr>

                </thead>
                <tbody>
                    <?php 
                $no = 1;
                while($data = mysqli_fetch_array($dataBayar)) {?>
                    <tr>
                    <td><?php echo $no ?></td>
                        <td><?php echo $data['id_hutang'] ?></td>
                        <td><?php echo $data['jumlah_bayar'] ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['status'] ?></td>
                    </tr>
                    <?php 
                    $no++;
                } ?>
                </tbody>
            </table>
            <div class="text-start d-print-none mt-5">
                <a href="laporan.php" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>