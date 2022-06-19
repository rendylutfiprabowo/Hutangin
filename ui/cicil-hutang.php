<?php
    include '../utils/user-session.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    $getID = $_GET['id'];

    if(isset($_POST["submit"]))
    {
        $sisaHutang = $_POST['sisaHutang'];
        $bayarCicilan = $_POST['bayarCicilan'];
        $sisaHutang = $sisaHutang - $bayarCicilan;
        mysqli_query($conn,"UPDATE `hutang` SET `sisa_hutang`='$sisaHutang' WHERE id='$getID'");
        date_default_timezone_set('Asia/Jakarta');
        $date = date('y-m-d');
        $date = "20".$date;
        
        if ($sisaHutang > 0) {
            $status = "Belum Lunas";
        } else {
            $status = "Lunas";
        }
        mysqli_query($conn, "INSERT INTO `riwayat_bayar`(`id`, `id_hutang`, `id_user`, `jumlah_bayar`, `status`, `tanggal`) VALUES ('','$getID', '$userId', '$bayarCicilan','$status','$date')");
        echo '<script>alert("Berhasil mengupdate cicilan!")
                    window.location.href = "../index.php";
                    </script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cicil Hutang - Hutangin</title>
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
        <h1 class="text-center mt-3 mb-3">Cicil Hutang</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6 fs-4">
                <?php
                $resHutang = mysqli_query($conn, "SELECT * FROM hutang WHERE id='$getID' AND id_user='$userId'");
                $data = mysqli_fetch_array($resHutang)
                ?>
                <form action="" method="post">
                    <div class="my-3">
                        <label for="sisaHutang" class="form-label">Sisa Hutang</label>
                        <input type="number" class="form-control form-control-lg" id="sisaHutang" name="sisaHutang" step="1000"
                            required
                            value="<?php echo $data['sisa_hutang']?>" readonly>
                    </div>
                    <div class="my-3">
                        <label for="bayarCicilan" class="form-label">Jumlah Cicilan</label>
                        <input type="number" class="form-control form-control-lg" id="bayarCicilan" name="bayarCicilan" step="1000"
                            required
                            value="<?php echo $data['sisa_hutang']?>" min="1000" max="<?php echo $data['sisa_hutang']?>">
                    </div>
                    <div class="my-4">
                        <button type="submit" class="form-control form-control-lg btn btn-primary fw-bold fs-4"
                            id="btn-login" name="submit">Cicil</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>