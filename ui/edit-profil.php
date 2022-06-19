<?php
    include '../utils/user-session.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }

    if(isset($_POST["submit"]))
    {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $newPassword= md5($_POST['newPassword']);
        $confNewPassword = md5($_POST['confNewPassword']);
        
        if ($password == $user['password']) {
            $password = $user['password'];
            if ($newPassword != "d41d8cd98f00b204e9800998ecf8427e" && $confNewPassword == $newPassword) {
                $password = $newPassword;
            } else if ($confNewPassword != $newPassword) {
                echo "<script>alert('Gagal memperbarui, password baru Anda salah!')</script>";
            }
            mysqli_query($conn, "UPDATE `user` SET `nama`='$nama',`email`='$email',`password`='$password' WHERE `id`='$userId'");
            // header("location: edit-profil.php");
        } else {
            echo "<script>alert('Gagal memperbarui, password Anda salah!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Hutangin</title>
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
                        <li><a class="dropdown-item" href="">Edit Profil</a></li>
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
        <h1 class="text-center mt-3 mb-3">Edit Profil</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6 fs-4">
                <form action="" method="post">
                    <div class="my-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="nama" name="nama"
                            value="<?php echo $user['nama']; ?>"
                        maxlength="30" required>
                    </div>
                    <div class="my-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                            value="<?php echo $user['email']; ?>"
                        maxlength="30" required>
                    </div>

                    <div class="my-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password"
                         required>
                    </div>

                    <div class="my-3">
                        <label for="newPassword" class="form-label">Password Baru</label>
                        <input type="password" class="form-control form-control-lg" id="newPassword" name="newPassword">
                    </div>

                    <div class="my-3">
                        <label for="confNewPassword" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control form-control-lg" id="confNewPassword" name="confNewPassword">
                    </div>

                    <div class="my-4">
                        <button type="submit" class="form-control form-control-lg btn btn-primary fw-bold fs-4"
                            id="btn-login" name="submit">Submit</button>
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