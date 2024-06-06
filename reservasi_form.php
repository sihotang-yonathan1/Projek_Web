<?php

// TODO: encapsulate the DB connection process in one separate file

// TODO: encapsulate the DB connection process in one separate file

$host = "localhost";
$username = "root";
$password = "";
$db = "user_db";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

$name = $conn->real_escape_string($_POST['nama']);
$date = $conn->real_escape_string($_POST['tanggal']);
$time = $conn->real_escape_string($_POST['waktu']);
$user = $conn->real_escape_string($_POST['jumlah-tiket']);
$jenis = $conn->real_escape_string($_POST['jenis-tiket']);

// Set this query into prepared statement
$sql = "INSERT INTO reservasi_form (nama, tanggal, waktu, jumlah_tiket, jenis_tiket) VALUES ('$name', '$date', '$time', '$user', '$jenis')";

if ($conn->query($sql) === TRUE) {
    echo "Reservasi berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

