<?php
    include 'database/koneksi.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $hasil = false;
    $role = $_POST['role'];
    $kode = $_POST['kode'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telepon = $_POST['noTelepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    if($role == 'siswa'){
        $sql = "SELECT * FROM siswa WHERE nisn='$kode'";
        $cek = $db_sekolah->query($sql);

        if($cek->num_rows>0){
            $data = $cek->fetch_assoc();
            $nisn = $data['nisn'];
            $namaLengkap = $data['nama'];
            $kelamin = $data['jenis_kelamin'];
            $kelas = $data['kelas'];
            $jurusan = $data['jurusan'];
            $status = $data['status'];

            if($status=="aktif"){
                $hasil = true;
            } else {
                echo "<script>
                    alert('Siswa tidak aktif!');
                    window.location='register.php';
                    </script>";
                    exit;
            }
        } else {
            echo "<script>
                    alert('NISN tidak ditemukan!');
                    window.location='register.php';
                    </script>";
                    exit;
        }


    } else if($role == 'guru'){
        $sql = "SELECT * FROM guru WHERE kode_guru = '$kode'";
        $result = $db_sekolah->query($sql);

        if($result->num_rows>0){
            $data = $result->fetch_assoc();
            $namaLengkap = $data['nama'];
            $nip = $data['nip'];
            $kodeGuru = $data['kode_guru'];
            $kelamin = $data['jenis_kelamin'];
            $pelajaran = $data['mata_pelajaran'];
            $statusGuru = $data['status_guru'];

            if($statusGuru=='aktif'){
                $hasil = true;
            } else {
                echo "<script>
                    alert('Guru tidak aktif!');
                    window.location='register.php';
                    </script>";
                    exit;
            }
        } else {
             echo "<script>
                alert('ID Guru tidak ditemukan!');
                window.location='register.php';
                </script>";
                exit;
        }

    } else if($role == 'penjual'){
        $sql = "SELECT * FROM penjual WHERE kode_penjual = '$kode'";
        $result = $db_sekolah->query($sql);

        if($result->num_rows>0){
            $data = $result->fetch_assoc();
            $kodePenjual = $data['kode_penjual'];
            $namaLengkap = $data['nama_pemilik'];
            $namaToko = $data['nama_toko'];
            $statusPenjual = $data['status'];

            if($statusPenjual=='Aktif'){
                $hasil = true;
            } else {
                echo "<script>
                    alert('Toko tidak aktif!');
                    window.location='register.php';
                    </script>";
                    exit;
                    
            }
        } else {
            echo "<script>
                alert('ID Penjual tidak ditemukan!');
                window.location='register.php';
                </script>";
                exit;
        }
    }

    if($hasil){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $insert = "INSERT INTO users 
        (nama, username, password, role, no_telepon, email, alamat)
        VALUES 
        ('$namaLengkap','$username','$password_hash','$role','$telepon','$email','$alamat')";

        if($db_ekantin->query($insert)){

            if($role == 'siswa'){

                $cekNisn = $db_ekantin->query("SELECT nisn FROM siswa WHERE nisn='$nisn'"); 

                if($cekNisn->num_rows > 0){
                echo "<script>
                    alert('NISN sudah terdaftar!');
                    window.location='register.php';
                    </script>";
                    exit;
                    }
                    
                $masuk = "INSERT INTO siswa 
                (nisn,nama,kelas,jurusan,no_telepon,email,alamat,status)
                VALUES
                ('$nisn','$namaLengkap','$kelas','$jurusan','$telepon','$email','$alamat','$status')";

                $db_ekantin->query($masuk);
            }

            if($role == 'guru'){

                $cekGuru = $db_ekantin->query("SELECT kode_guru FROM dbguru WHERE kode_guru='$kodeGuru'");

                if($cekGuru->num_rows > 0){
                    echo "<script>alert('Akun Guru sudah terdaftar!');
                        window.location='register.php';
                        </script>";
                        exit;
                }
                $masuk = "INSERT INTO dbguru
                (nip, kode_guru, nama_guru, jenis_kelamin, mata_pelajaran, no_telepon, email, alamat, status)
                VALUES
                ('$nip','$kodeGuru','$namaLengkap','$kelamin','$pelajaran','$telepon','$email','$alamat','$statusGuru')";

                $db_ekantin->query($masuk);
            }

            if($role == 'penjual'){

                $cekNisn = $db_ekantin->query("SELECT kode_penjual FROM dbpenjual WHERE kode_penjual='$kodePenjual'"); 

                if($cekNisn->num_rows > 0){
                echo "<script>
                    alert('Toko sudah terdaftar!');
                    window.location='register.php';
                    </script>";
                    exit;
                    }

                $masuk = "INSERT INTO dbpenjual
                (kode_penjual, nama_penjual, nama_toko, email, no_telepon, alamat, status)
                VALUES 
                ('$kodePenjual','$namaLengkap','$namaToko','$email','$telepon','$alamat','$statusPenjual')";

                $db_ekantin->query($masuk);
            }

            echo "<script>
                    alert('Registrasi berhasil!');
                    window.location='login.php';
                  </script>";
        } else {
            echo "Error: " . $db_sekolah->error;
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
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

            <div class="kotakRadio">
                <label><input type="radio" class="inputRadio" name="role" value="guru"> Guru</label>
                <label><input type="radio" class="inputRadio" name="role" value="siswa"> Siswa</label>
                <label><input type="radio" class="inputRadio" name="role" value="penjual"> Penjual</label>
            </div>

    
            <input type="text" id="inputNama" name="kode" class="kotakInput1" placeholder="Masukkan Role Terlebih Dahulu" disabled required>

            <div class="input-group">
                <input type="text" class="kotakInput3" name="username" required>
                <div class="tulisan2"><p>Username</p></div>
            </div>

            <div class="input-group">
                <input type="password" class="kotakInput4" name="password" required>
                <div class="tulisan3"><p>Password</p></div>
            </div>

            <div class="input-group">
                <input type="text" class="kotakInput4" name="noTelepon" required>
                <div class="tulisan4"><p>No HP</p></div>
            </div>

            <div class="input-group">
                <input type="text" class="kotakInput4" name="email" required>
                <div class="tulisan4"><p>Email</p></div>
            </div>

            <div class="input-group">
                <input type="text" class="kotakInput4" name="alamat" required>
                <div class="tulisan4"><p>Alamat</p></div>
            </div>

        </div>

        <div class="kotakBawah">
            <input type="submit" class="tombolSubmit" value="Submit">

            <div class="kotakTulisan">
                <a href="login.php">Kembali?</a>
            </div>
        </div>

    </div>

</div>
</form>

<script>
const button = document.querySelectorAll('.inputRadio');
const input = document.getElementById('inputNama');

button.forEach(radio => {
    radio.addEventListener('change', function(){

        input.disabled = false;
        if(this.value === 'guru'){
            input.placeholder = "Masukkan ID Guru";
        } else if(this.value === 'siswa'){
            input.placeholder = "Masukkan NISN";
        } else if(this.value === 'penjual'){
            input.placeholder = "Masukkan ID Penjual";
        }
    });
});
</script>

</body>
</html>
