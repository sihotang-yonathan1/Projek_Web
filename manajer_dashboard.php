<?php
session_start();

require_once('./config.php');
require_once('./utils/network/http_client.php');

require_once('./config.php');
require_once('./utils/network/http_client.php');

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}
$max_items_number = 3;
$_result = HttpClient::get("$PROJECT_URL/backend/api/v1/reservasi.php?max_items_number=$max_items_number");
$result = json_decode($_result, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Manajer</title>
    <link rel="stylesheet" href="./manajer/style.css" />
    <link rel="icon" href="image/img.jpg">
    <link rel="stylesheet" href="./manajer/style.css" />
    <link rel="icon" href="image/img.jpg">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="#">ANCOL</a>
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
                <a href=" laporan_reservasi.php" class="active">Laporan Tiket</a>
                <a href="manejemen_meja.php" class="active">Manajemen Tiket</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Dashboard</h2>

            <div class="promo_card" style="height: 125px; margin: 12px;">
            <div class="promo_card" style="height: 125px; margin: 12px;">
                <h1>Welcome </h1>
                <span>Manajer Ancol</span>
                <span>Manajer Ancol</span>
            </div>

            <div class=" history_lists">
                <div class="list1">
                    <div class="row">
                        <h4>Laporan Tiket</h4>
                    </div>
                    <table>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Jumlah Tiket</th>
                            <th>Tipe Tiket</th>
                            <th>Jumlah Tiket</th>
                            <th>Tipe Tiket</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($result as $data): ?>
                            <tr>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['waktu'] ?></td>
                                <td><?= $data['jumlah_tiket'] ?></td>
                                <td><?= $data['jenis_tiket'] ?></td>
                                <td><?= $data['status'] ?? 'Belum konfirmasi' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>

                <div class="list2">
                    <div class="row">
                        <h4>Manajemen Tiket</h4>
                    </div>
                    <table>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($result as $data): ?>
                            <tr>
                                <td><?= $data['nama']?></td>
                                <td><?= $data['status'] ?? 'Belum Konfirmasi' ?></td>
                            </tr>
                        <?php endforeach ?>
                        <?php foreach ($result as $data): ?>
                            <tr>
                                <td><?= $data['nama']?></td>
                                <td><?= $data['status'] ?? 'Belum Konfirmasi' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="./manajer/script.js"></script>
</body>

</html>