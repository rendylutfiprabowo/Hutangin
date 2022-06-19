<?php
    include '../utils/user-session.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    $resHutang = mysqli_query($conn, "SELECT * FROM hutang WHERE sisa_hutang = 0 AND id_user='$userId'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunas - Hutangin</title>
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
                        <a class="nav-link active" href="daftar-lunas.php">Daftar Lunas</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="laporan.php">Laporan</a>
                    </li>
                </ul>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle fs-5 p-0 py-2" data-bs-toggle="dropdown"
                        aria-expanded="false">
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
        <h1 class="text-center mt-3 mb-3">Daftar Lunas</h1>

        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover table-bordered">
                <thead class="fw-bold">
                
                    <tr>
                        <td>No</td>
                        <td>ID</td>
                        <td>Penghutang</td>
                        <td>Nama Hutang</td>
                        <td>Tanggal Pinjam</td>
                        <td>Jatuh Tempo</td>
                        <td>Tanggal Lunas</td>
                        <td>Jumlah</td>
                    </tr>
                
                </thead>
                <tbody>
                <?php 
                $no = 1;
                
                while($data = mysqli_fetch_array($resHutang)) {
                    $getIdHutang = $data['id'];
                    $resBayar = mysqli_query($conn, "SELECT * FROM riwayat_bayar WHERE id_hutang='$getIdHutang' AND status='Lunas'");
                    $dataBayar = mysqli_fetch_assoc($resBayar);

                    ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['nama_penghutang'] ?></td>
                        <td><?php echo $data['nama_hutang'] ?></td>
                        <td><?php echo $data['tanggal_pinjam'] ?></td>
                        <td><?php echo $data['jatuh_tempo'] ?></td>
                        <td><?php echo $dataBayar['tanggal'] ?></td>
                        <td><?php echo $data['jumlah'] ?></td>

                    </tr>
                <?php 
                    $no++;
                } ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>