<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$host = "localhost";
$username = "root";
$password = "";
$db = "user_db";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

function getAllReservations($conn) {
    $query = "SELECT * FROM reservasi_form";
    return $conn->query($query);
}

function updateReservation($conn, $id, $nama, $tanggal, $waktu, $jumlah_orang, $jenis_meja, $catatan_khusus) {
    $stmt = $conn->prepare("UPDATE reservasi_form SET nama=?, tanggal=?, waktu=?, jumlah_orang=?, jenis_meja=?, catatan_khusus=? WHERE id=?");
    $stmt->bind_param("sssissi", $nama, $tanggal, $waktu, $jumlah_orang, $jenis_meja, $catatan_khusus, $id);
    return $stmt->execute();
}

function deleteReservation($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM reservasi_form WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function confirmReservation($conn, $id) {
    $stmt = $conn->prepare("UPDATE reservasi_form SET status='Dikonfirmasi' WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'update') {
            updateReservation($conn, $_POST['id'], $_POST['nama'], $_POST['tanggal'], $_POST['waktu'], $_POST['jumlah_orang'], $_POST['jenis_meja'], $_POST['catatan_khusus']);
        } elseif ($action == 'delete') {
            deleteReservation($conn, $_POST['id']);
        } elseif ($action == 'confirm') {
            confirmReservation($conn, $_POST['id']);
        }

        header("Location: pelayan_dashboard.php");
        exit();
    }
}

?>
