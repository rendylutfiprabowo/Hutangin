<?php
    include 'utils/user-session.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: ui/login.php");
    }

    $userId = $user['id'];
    $resHutang = mysqli_query($conn, "SELECT * FROM hutang WHERE sisa_hutang > 0 AND id_user='$userId'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hutangin</title>
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="images/icon-hutang.svg" type="image/x-icon">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fs-3 fw-bold" href="">Hutangin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav fs-5 mx-auto">
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link active" href="">Daftar Hutang</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="ui/riwayat-bayar.php">Daftar Bayar</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="ui/daftar-lunas.php">Daftar Lunas</a>
                    </li>
                    <li class="nav-item mx-lg-3">
                        <a class="nav-link" href="ui/laporan.php">Laporan</a>
                    </li>
                </ul>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle fs-5 p-0 py-2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi, <?php echo $user['nama']?>
                    </button>
                    <ul class="dropdown-menu fs-5">
                        <li><a class="dropdown-item" href="ui/edit-profil.php">Edit Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item link-danger" href="backend/logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <section class="section-content container">
        <h1 class="text-center mt-3 mb-3">Daftar Hutang</h1>

        <div class="btn-tambah text-end mb-3">
            <a href="ui/tambah-hutang.php" class="btn btn-primary align-items-center fs-5 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-square-fill m-0 p-0 mb-1 me-2" viewBox="0 0 16 16">
                    <path
                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                </svg>
                Tambah Hutang
            </a>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="fw-bold">
                
                    <tr>
                        <td>No</td>
                        <td>ID</td>
                        <td>Penghutang</td>
                        <td>Nama Hutang</td>
                        <td>Tanggal Pinjam</td>
                        <td>Jatuh Tempo</td>
                        <td>Jumlah</td>
                        <td>Sisa Hutang</td>
                        <td>Aksi</td>
                    </tr>
                
                </thead>
                <tbody>
                <?php 
                $no = 1;
                while($data = mysqli_fetch_array($resHutang)) {?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['nama_penghutang'] ?></td>
                        <td><?php echo $data['nama_hutang'] ?></td>
                        <td><?php echo $data['tanggal_pinjam'] ?></td>
                        <td><?php echo $data['jatuh_tempo'] ?></td>
                        <td><?php echo $data['jumlah'] ?></td>
                        <td><?php echo $data['sisa_hutang'] ?></td>
                        <td>
                            <a href="backend/lunas.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-success">Lunas</a>    
                            <a href="ui/cicil-hutang.php?id=<?php echo $data['id'];?>" class="btn btn-outline-primary">Cicil</a>
                            <a href="ui/edit-hutang.php?id=<?php echo $data['id'];?>" class="btn btn-outline-warning">Edit</a>
                            <a href="backend/hapus-hutang.php?id=<?php echo $data['id'];?>" class="btn btn-outline-danger">Hapus</a>
                        </td>
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