<?php
include 'database/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $cek = $db_ekantin->query($sql);

    if($cek->num_rows>0){
        $data=$cek->fetch_assoc();

        if(password_verify($password, $data['password'])){

        $status = $data['status_aktif'];
            if($status == "aktif"){
                echo "<script>
                    alert('Login Berhasil!');
                    window.location='menu.php';
                    </script>";
                    exit;
                } else {
                 echo "<script>
                    alert('Akun tidak aktif!');
                    window.location='login.php';
                    </script>";
                    exit;
                }

        } else {
            echo "<script>
                    alert('Password salah!');
                    window.location='login.php';
                    </script>";
                    exit;
        }
    } else {
        echo "<script>
                    alert('Username dan Password tidak ditemukan!');
                    window.location='login.php';
                    </script>";
                    exit;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="css/styleRegister.css">
</head>
<body>

<form method="POST">
<div class="containerUtama">

    <div class="kotakLogin2">

        <div class="header">
            <img src="img/LOGO-EKANTIN.png" class="fotoLogo">
        </div>

        <div class="jarakKotak2">

            <div class="input-group">
                <input type="text" class="kotakInput3" name="username" required>
                <div class="tulisan2"><p>Username</p></div>
            </div>

            <div class="input-group">
                <input type="password" class="kotakInput4" name="password" required>
                <div class="tulisan3"><p>Password</p></div>
            </div>

        </div>

        <div class="kotakBawah">
            <input type="submit" class="tombolSubmit" value="Submit">

            <div class="kotakTulisan">
                <a href="register.php">Kembali?</a>
                <span>/</span>
                <a href="menu.php">Lupa Password?</a>
            </div>
        </div>

    </div>

</div>
</form>