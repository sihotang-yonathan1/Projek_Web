<?php
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // Ganti dengan username Anda
    $password = ""; // Ganti dengan password Anda
    $dbname = "user_form"; // Ganti dengan nama database Anda

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $email = $_POST['logemail'];
    $pass = $_POST['logpass'];

    // Query untuk memeriksa login
    $sql = "SELECT * FROM user_form WHERE email='$email' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login berhasil, set sesi
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_type'] = $row['user_type'];

        // Arahkan ke halaman sesuai peran (user_type)
        switch ($_SESSION['user_type']) {
            case 'pelanggan':
                header("Location: beranda_dashboard.php");
                break;
            case 'pelayan':
                header("Location: pelayan_dashboard.php");
                break;
            case 'manajer':
                header("Location: manajer_dashboard.php");
                break;
            default:
                header("Location: index.php");
        }
    } else {
        $error = "Login gagal. Periksa kembali email dan password.";
    }

    // Tutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Restauran Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="gambar/img.jpg">
</head>

<body>
    <div class="section">
        <div class="container">
            <h6><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>
            <div class="card-3d-wrap">
                <div class="card-3d-wrapper">
                    <!-- Login Form -->
                    <div class="card-front">
                        <div class="center-wrap">
                            <div class="section-text-center">
                                <h4>Log In</h4>
                                <img class="pp" src="gambar/pp.png" alt="bg" width="100px">
                                <form method="post">
                                    <div class="form-group">
                                        <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail1" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                    </div>
                                    <button type="submit" class="btn">LOGIN</button>
                                    <p><a href="#0" class="link">Forgot your password?</a></p>

                                    <?php if ($error): ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sign Up Form -->
                    <div class="card-back">
                        <div class="center-wrap">
                            <div class="section-text-center">
                                <form action="koneksi.php" method="post">
                                    <h4>Sign Up</h4>
                                    <?php if (isset($errors)) {
                                        foreach ($errors as $error) {
                                            echo '<span class="error-msg">' . $error . '</span>';
                                        }
                                    } ?>
                                    <div class="form-group">
                                        <input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail2" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass2" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <select id="user" name="loguser" required class="form-style">
                                            <option value="pelanggan">Pelanggan</option>
                                            <option value="pelayan">Pelayan</option>
                                            <option value="manajer">Manajer</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
