<?php
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

$name = $_POST['logname'];
    $email = $_POST['logemail'];
    $pass = $_POST['logpass'];
    $user = $_POST['loguser'];

// Query untuk menyimpan data ke database
$sql = "INSERT INTO user_form (nama, email, password, user_type) VALUES ('$name', '$email', '$pass', '$user')";

if ($conn->query($sql) === TRUE) {
    echo "Sign Up berhasil!";
    // Arahkan pengguna ke halaman login
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
