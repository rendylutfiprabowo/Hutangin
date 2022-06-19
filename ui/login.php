<?php 
    include '../utils/config.php';

    error_reporting(0);
    session_start();
    
    if (isset($_SESSION['user'])) {
        header("Location: ../index.php");
    }

    if(isset($_POST["login"]))
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password' AND verified='1'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $row['email'];
            echo '<script>alert("Berhasil login!")
                    window.location.href = "../index.php";
                    </script>';
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hutangin</title>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../images/icon-hutang.svg" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center text-center mt-5">
            <div class="col-lg-6">
                <div class="card w-100 border-0 shadow-sm p-4">
                    <div class="card-body">
                        <h2 class="card-title">Login</h2>
                        <form action="" method="post">
                            <div class="mb-3 mt-4">
                                <input type="email" class="form-control form-control-lg" id="email"
                                name="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control form-control-lg" id="password"
                                name="password"
                                    placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="form-control form-control-lg btn btn-primary fw-bold fs-4"
                                    id="btn-login" name="login">Login</button>
                            </div>
                            <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
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