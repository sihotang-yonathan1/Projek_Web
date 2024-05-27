<?php
session_start();

require_once('./config.php');
require_once('./utils/network/http_client.php');

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

$_result = HttpClient::get("$PROJECT_URL/backend/api/v1/reservasi.php");
$result = json_decode($_result, true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajer</title>
    <link rel="stylesheet" href="./manajer/manajemen_meja/style.css">
    <link rel="icon" href="image/img.jpg">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="#">ANCOL</a>
            <div class="search_box">
                <input type="text" placeholder="Search ">
            </div>
        </div>

        <button class="tombol" onclick="logout()">Logout</button>
        </div>
    </header>
    <div class="container">
        <nav>
            <div class="side_navbar">
                <span>Main Menu</span>
                <a href="manajer_dashboard.php" class="active">Dashboard</a>
                <a href=" laporan_reservasi.php" class="active">Laporan Tiket</a>
                <a href="manejemen_meja.php" class="active">Manajemen Tiket</a>
            </div>
        </nav>
        <div class=" history_lists">
            <div class="list1">
                <div class="row">
                    <h4>Manajemen Tiket</h4>
                </div>
                <table>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach($result as $data): ?>
                        <tr>
                            <td><?= $data['nama']?></td>
                            <td><?= $data['status'] ?? 'Belum Konfirmasi' ?> </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
    <script src="manajer/manajemen_meja/script.js"></script>
</body>

</html>
