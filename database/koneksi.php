<?php

$hostname = "localhost";
$username = "root";
$password = "";

$db_ekantin = mysqli_connect($hostname,$username,$password,"ekantin");
$db_sekolah = mysqli_connect($hostname,$username,$password,"sekolah");

if($db_ekantin->connect_error){
    echo "Koneksi ke database Kantin rusak";
    die("error!");
}

if($db_sekolah->connect_error){
    echo "Koneksi ke database sekolah rusak";
    die("error!");
}
?>