<?php
session_start();

require_once('./config.php');
require_once('./utils/network/http_client.php');

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

$_response = HttpClient::get("$PROJECT_URL/backend/api/v1/reservasi.php");
$response = json_decode($_response, true);

?>

<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./manajer/laporan_reservasi/style.css">
<link rel="icon" href="image/img.jpg">
<title>Dashboard Manajer</title>
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
                    <h4>Laporan Tiket</h4>
                </div>
                <table>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jumlah Tiket</th>
                        <th>Tipe Tiket</th>
                        <th>Status</th>
                    </tr>

                    <?php foreach ($response as $data): ?>
                        <tr>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['waktu'] ?></td>
                            <td><?= $data['jumlah_tiket'] ?></td>
                            <td><?= $data['jenis_meja'] ?></td>
                            <td><?= $data['status'] ?? "Belum Konfirmasi" ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
    <script src="./manajer/laporan_reservasi/script.js"></script>
</body>

</html>
