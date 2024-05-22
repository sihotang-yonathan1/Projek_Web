<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // Ganti dengan username Anda
    $password = ""; // Ganti dengan password Anda
    $dbname = "user_db"; // Ganti dengan nama database Anda

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
            // Tambahkan case sesuai peran lainnya jika diperlukan
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
