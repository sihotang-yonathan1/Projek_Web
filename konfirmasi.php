<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

// TODO: encapsulate the DB connection process in one separate file

$host = "localhost";
$username = "root";
$password = "";
$db = "user_db";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);

    // Update status menjadi "Dikonfirmasi"
    $sql = "UPDATE reservasi_form SET status = 'Dikonfirmasi' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Konfirmasi berhasil dilakukan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
