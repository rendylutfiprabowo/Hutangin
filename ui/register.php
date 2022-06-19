<?php 
    include '../utils/config.php';

    error_reporting(0);
    session_start();
    
    if (isset($_SESSION['user'])) {
        header("Location: ../index.php");
    }

    if(isset($_POST["register"]))
    {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $conpassword = md5($_POST['conpassword']);

        if ($password == $conpassword) {
            $sql = "SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $sql);

            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO `user`(`id`, `nama`, `email`, `password`, `verified`) VALUES ('','$nama','$email','$password','0')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<script>alert("Berhasil! Untuk bisa login, silakan tunggu Admin kami memeverifikasi akun Anda")
                    window.location.href = "login.php";
                    </script>';
                    
                    $nama = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['conpassword'] = "";
                } else {
                    echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                }
            } else {
                echo "<script>alert('Sepertinya Anda sudah terdaftar')</script>";
            }
        } else {
            echo "<script>alert('Password Anda tidak sama!')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hutangin</title>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../images/icon-hutang.svg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center text-center mt-5">
            <div class="col-lg-6">
                <div class="card w-100 border-0 shadow-sm p-4">
                    <div class="card-body">
                        <h2 class="card-title">Daftar Hutangin</h2>
                        <form action="" method="post">
                            <div class="mb-3 mt-4">
                                <input type="text" class="form-control form-control-lg" id="nama" name="nama"
                                    placeholder="Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control form-control-lg" id="password"
                                    name="password" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control form-control-lg" id="conpassword"
                                    name="conpassword" placeholder="Konfrimasi Password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="form-control form-control-lg btn btn-primary fw-bold fs-4"
                                    id="register" name="register">Daftar</button>
                            </div>
                            <p>Sudah punya akun? <a href="login.php">Masuk sekarang</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>