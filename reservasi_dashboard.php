<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

require_once('./config.php');
require_once('./utils/network/http_client.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_response = HttpClient::post("$PROJECT_URL/backend/api/v1/reservasi.php", [
        "nama" => $_POST['nama'],
        "tanggal" => $_POST['tanggal'],
        "waktu" => $_POST['waktu'],
        "jumlah_orang" => $_POST['jumlah-orang'],
        "jenis_meja" => $_POST['jenis-meja']
    ]);
    if (!is_null(json_decode($_response))){
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reservasi Meja Restoran WarongWarem</title>
    <link rel="stylesheet" type="text/css" href="./users/reservasi/style.css">

    <link rel="icon" href="./image/img.jpg">
    <!-- TODO: refer this style in external file -->
    <style>
    .tombol {
        background-color: rgb(103, 202, 45);
        width: 60px;
        height: 30px;
        margin-left: 30px;
        color: #f5fdff;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        border-radius: 12%;
    }

    .tombol:hover {
        background-color: rgb(198, 21, 21);
    }
    </style>
</head>

<body>
    <!-- TODO: set style in external file -->
    <!-- TODO: set the eventListener using js instead of inline in `onclick` -->
    <button class="tombol" onclick="logout()" style="position: relative; left: 1140px; bottom: 265px">Logout</button>
    <h1>Reservasi Meja </h1>
    <form id="reservation-form" method="POST" action="<?php $_SERVER['PHP_SELF']?>">

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required><br>

        <label for="waktu">Waktu:</label>
        <input type="time" id="waktu" name="waktu" required><br>

        <label for="jumlah-orang">Jumlah Orang:</label>
        <input type="number" id="jumlah-orang" name="jumlah-orang" required><br>

        <label for="jenis-meja">Jenis Meja:</label>
        <select id="jenis-meja" name="jenis-meja" required>
            <option value="meja-kecil">Meja Kecil</option>
            <option value="meja-panjang">Meja Panjang</option>
            <option value="meja-VIP">Meja VIP</option>
        </select><br>
        <button type="submit">Reservasi</button>
    </form>

    <!-- <script src="./users/reservasi/script.js"></script> -->
</body>

</html>
