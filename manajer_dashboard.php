<?php
session_start();

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

<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard Manajer</title>
    <link rel="stylesheet" href="./manajer/style.css" />
    <link rel="icon" href="gambar/img.jpg">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="#">WarongWarem</a>
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
                <a href=" laporan_reservasi.php" class="active">Laporan Reservasi</a>
                <a href="manejemen_meja.php" class="active">Manajemen Meja</a>
            </div>
        </nav>

        <div class="main-body">
            <h2>Dashboard</h2>

            <div class="promo_card" style="height: 125px; margin: 20px;">
                <h1>Welcome </h1>
                <span>Manajer WarongWarem</span>
            </div>

            <div class=" history_lists">
                <div class="list1">
                    <div class="row" style="margin: 1rem 40px;">
                        <h4>Laporan Reservasi</h4>
                    </div>
                    <table style="margin: 0 40px;">
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Jumlah Orang</th>
                            <th>Jenis Meja</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($result as $data): ?>
                            <tr>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['waktu'] ?></td>
                                <td><?= $data['jumlah_orang'] ?></td>
                                <td><?= $data['jenis_meja'] ?></td>
                                <td><?= $data['status'] ?? 'Belum konfigurasi' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>

                <div class="list2">
                    <div class="row">
                        <h4>Manajemen Meja</h4>
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
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="./manajer/script.js"></script>
</body>

</html>
