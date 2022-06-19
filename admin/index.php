<?php
    include '../utils/config.php';

    error_reporting(0);
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
    }

    $resUser = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Hutangin</title>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../images/icon-hutang.svg" type="image/x-icon">
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
                
                <div class="btn-group ms-auto">
                    <button type="button" class="btn btn-primary dropdown-toggle fs-5 p-0 py-2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi, Admin
                    </button>
                    <ul class="dropdown-menu fs-5">
                        <li><a class="dropdown-item link-danger" href="logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <section class="section-content container">
        <h1 class="text-center mt-3 mb-3">Kelola User</h1>

        <div class="table-responsive mt-5">
            <table class="table table-striped table-hover table-bordered">
                <thead class="fw-bold">
                
                    <tr>
                        <td>No</td>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Verified</td>
                        <td>Aksi</td>
                    </tr>
                
                </thead>
                <tbody>
                <?php 
                $no = 1;
                while($data = mysqli_fetch_array($resUser)) {?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td><?php 
                            if ($data['verified'] == 0) {
                                echo "Tidak";
                            } else {
                                echo "Ya";
                            }
                        ?></td>
                        <td>
                            <?php if ($data['verified'] == 0) {
                                echo '<a href="verifikasi.php?id='.$data['id'].'" class="btn btn-outline-success"
                                >Verifikasi</a>';
                            }?>
                                
                            <a href="hapus-user.php?id=<?php echo $data['id'];?>" class="btn btn-outline-danger">Hapus</a>
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