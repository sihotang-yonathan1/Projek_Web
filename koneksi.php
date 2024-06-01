<?php
session_start(); // Memulai session

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

// Define master password
$master_password = 'ancol'; // Ganti dengan master password Anda

// Pemeriksaan master password
if (isset($_POST['loguser']) && ($_POST['loguser'] === 'pelayan' || $_POST['loguser'] === 'manajer') && isset($_POST['verification_password']) && $_POST['verification_password'] !== $master_password) {
    $_SESSION['error'] = true; // Set session error
    header("Location: index.php"); // Redirect ke halaman index.php
    exit();
} else {
    // Ambil data dari form
    $name = $_POST['logname'];
    $email = $_POST['logemail'];
    $pass = $_POST['logpass'];
    $user = $_POST['loguser'];
    $security = $_POST ['security'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO user_form (nama, email, password, user_type, security) VALUES ('$name', '$email', '$pass', '$user', '$security' )";

    if ($conn->query($sql) === TRUE) {
        // Arahkan pengguna ke halaman yang sesuai
        switch ($user) {
            case 'pelayan':
                header("Location: pelayan_dashboard.php");
                break;
            case 'manajer':
                header("Location: manajer_dashboard.php");
                break;
            case 'pelanggan':
            default:
                header("Location: beranda_dashboard.php");
                break;
        }
    } else {
        $_SESSION['error'] = true; // Set session error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
