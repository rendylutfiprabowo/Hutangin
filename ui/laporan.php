<?php
    include '../utils/user-session.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Hutangin</title>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../images/icon-hutang.svg" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fs-3 fw-bold" href="../index.php">Hutangin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav fs-5 mx-auto">
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="../index.php">Daftar Hutang</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="riwayat-bayar.php">Daftar Bayar</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="daftar-lunas.php">Daftar Lunas</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link active" href="laporan.php">Laporan</a>
                    </li>
                </ul>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle fs-5 p-0 py-2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, <?php echo $user['nama']?>
                    </button>
                    <ul class="dropdown-menu fs-5">
                        <li><a class="dropdown-item" href="edit-profil.php">Edit Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item link-danger" href="../backend/logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <section class="section-content container">
        <h1 class="text-center mt-3 mb-3">Laporan</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-3">
                <div class="card w-100 bg-secondary h-100 text-white">
                    <div class="card-body">
                        <h5 class="card-title fs-2">Hutang Aktif</h5>
                        <p class="card-text fw-bold fs-3 mt-5">
                            <?php 
                                $hutangAktif = mysqli_query($conn, "SELECT COUNT(*) as total FROM hutang WHERE sisa_hutang > 0 AND id_user='$userId'");
                                $res = mysqli_fetch_assoc($hutangAktif);
                                echo $res['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="card w-100 bg-secondary text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title fs-2">Nominal Hutang Aktif</h5>
                        <p class="card-text fs-3 mt-5 mt-lg-0 fw-bold">
                            <?php 
                                $nominalHutangAktif = mysqli_query($conn, "SELECT SUM(sisa_hutang) as total FROM hutang WHERE sisa_hutang > 0 AND id_user='$userId'");
                                $res = mysqli_fetch_assoc($nominalHutangAktif);
                                echo "Rp. ".$res['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="card w-100 bg-secondary text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title fs-2">Hutang Lunas</h5>
                        <p class="card-text fs-3 mt-5 fw-bold">
                            <?php 
                                $hutangLunas = mysqli_query($conn, "SELECT COUNT(*) as total FROM hutang WHERE sisa_hutang = 0 AND id_user='$userId'");
                                $res = mysqli_fetch_assoc($hutangLunas);
                                echo $res['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="card w-100 bg-secondary text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title fs-2">Nominal Hutang Lunas</h5>
                        <p class="card-text fs-3 fw-bold mt-5 mt-lg-0">
                            <?php 
                                $nominalHutangLunas = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM hutang WHERE sisa_hutang = 0 AND id_user='$userId'");
                                $res = mysqli_fetch_assoc($nominalHutangLunas);
                                echo "Rp. ".$res['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center mt-5 mb-3">Filter Tanggal</h2>
        <form action="" method="post">
            <div class="row mt-5 align-items-center">
                <div class="col-lg">
                    <input type="date" name="fromDate" id="fromDate" class="form-control form-control-lg" required>
                </div>
                <div class="col-lg-1 mt-2 mt-lg-0 text-center">
                    <h6>sampai</h6>
                </div>
                <div class="col-lg mt-2 mt-lg-0">
                    <input type="date" name="toDate" id="toDate" class="form-control form-control-lg" required>
                </div>
                <div class="col-lg-2 mt-3 mt-lg-0">
                    <button type="submit" name="submit" class="w-100 btn btn-primary h-100 fs-5 fw-bold">Cari</button>
                </div>
            </div>
        </form>

        <?php 
        
        if (isset($_POST['submit'])) {
            $fromDate = $_POST['fromDate'];
            $toDate = $_POST['toDate'];
            $dataHutang = mysqli_query($conn, "SELECT COUNT(*) as total FROM hutang WHERE ((tanggal_pinjam >= '$fromDate' AND tanggal_pinjam <= '$toDate') OR (jatuh_tempo >= '$fromDate' AND jatuh_tempo <= '$toDate')) AND id_user='$userId'");
            $resDataHutang = mysqli_fetch_assoc($dataHutang);
            $dataBayar = mysqli_query($conn, "SELECT COUNT(*) as total FROM riwayat_bayar WHERE (tanggal >= '$fromDate' AND tanggal <= '$toDate') AND id_user='$userId'");
            $resDataBayar = mysqli_fetch_assoc($dataBayar);

            echo '<div class="row text-center mt-5">
            <h4>Dari tanggal <span class="text-danger fw-bold">'.$fromDate.'</span> sampai tanggal <span class="text-danger fw-bold">'.$toDate.'</span> </h4>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-lg-3">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title fs-2">
                            '.$resDataHutang["total"].'
                        </h5>
                        <p class="card-text fs-5">Data hutang ditemukan</p>
                        <a href="cetak-data-hutang.php?fromDate='.$fromDate.'&toDate='.$toDate.'" class="btn btn-primary fs-5">Cetak</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title fs-2">'.$resDataBayar["total"].'
                            
                        </h5>
                        <p class="card-text fs-5">Data pembayaran ditemukan</p>
                        <a href="cetak-data-bayar.php?fromDate='.$fromDate.'&toDate='.$toDate.'" class="btn btn-primary fs-5">Cetak</a>
                    </div>
                </div>
            </div>

        </div>';
        }
        ?>



    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>