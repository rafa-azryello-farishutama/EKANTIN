<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>

<?php
$usernameError = false;
$passwordError = false;
$tulisanUsername = false;
$tulisanPassword = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username !== "rafa") {
        $usernameError = true;
        $tulisanUsername = true;
    }

    if ($password !== "1601") {
        $passwordError = true;
        $tulisanPassword = true;
    }

    if (!$usernameError && !$passwordError) {
        echo "<script>alert('Login Berhasil!');</script>";
    }
}
?>  
    <form method="POST" action="">
    <div class="kotakLogin">
            <img class="logo" src="img/mayers.png">

                <input type="text" class="kotakInput1 <?php if($usernameError) echo 'error'; ?>" name="username">

                <div class="tulisan1 <?php if($tulisanUsername) echo 'error1'; ?>">
                    <p>Username</p>
                </div>
            
            <div class="kotak2">
                <input type="password" class="kotakInput2 <?php if($passwordError) echo 'error'; ?>" name="password">
    
            <div class="tulisan2 <?php if($tulisanPassword) echo 'error1'; ?>">
                <p>Password</p>
            </div>
            </div>

            <div class="kotakbutton">
                <button type="submit" class="tombolSubmit">Login</button>
        </div>

            <div class="jarakTulisan">
                <div class="tulisanAkun">
                    <a href="menu.php">Buat Akun?</a>
                    <span>/</span>
                    <a href="pesan.php">Lupa Password?</a>
                </div>
            </div>
    </div>
</form>

    <script>
    document.querySelectorAll("input").forEach(function(input) {
        input.addEventListener("focus", function() {
            this.classList.remove("error");
            let targetTulisan = this.nextElementSibling;
        
            if (targetTulisan && (targetTulisan.classList.contains('tulisan1') || targetTulisan.classList.contains('tulisan2'))) {
                targetTulisan.classList.remove("error1");
            }
        });
    });
</script>


</body>
</html>