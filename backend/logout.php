<?php 
    session_start();
    session_destroy();
    
    echo '<script>alert("Berhasil logout!")
                    window.location.href = "../ui/login.php";
                    </script>';

?>