<?php
include("database/koneksi.php");

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $saldo = $_POST['saldo'];

    $sql = "INSERT INTO users (nama,username,password,role,saldo) VALUES 
            ('$nama','$username','$password','$role','$saldo')";

    if($db->query($sql)){
        echo "DATA MASUK";
    } else {
        echo "DATA TIDAK MASUK";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    link
</head>
<body>
    <section class="containerUtama">

    <form method="POST" action="register.php">
        <div class="kotak1">
            <input type="text" name="nama" placeholder="nama">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            

            <label><input type="radio" name="role" value="murid" required> Murid</label>
            <label><input type="radio" name="role" value="guru"> Guru</label>
            <label><input type="radio" name="role" value="penjual"> Penjual</label>

            <input type="number" name="saldo" placeholder="saldo lu berapa bos">
            <input type="submit" name="register">
        </div>

        <div class="kotak2">


        </div>
</form>

    </section>
</body>
</html>