<?php
session_start();

require_once('./config.php');
require_once('./utils/network/http_client.php');

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

// The APi before is using the same table as `reservation_form` but i think
// this variable meant to retrieve data from `pelayan_form` table, i may wrong though
$_result = HttpClient::get("$PROJECT_URL/backend/api/v1/reservasi.php");
$result = json_decode($_result, true);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pelayan</title>
    <link rel="stylesheet" href="pelayan/style.css">
    <link rel="icon" href="image/img.jpg">
</head>

<body>
    <header>
        <form action="pelayan_form.phps">
            <h3>DASHBOARD PELAYAN</h3>
            <section class="webdesigntuts-workshop">
                <form action="" method="">
                    <input type="search" placeholder="Cari Disini">
                    <button>Search</button>
                </form>
            </section>
            <a href="index.php"><button class="cta">Logout</button></a>
        </form>
    </header>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Reservasi</th>
            <th>Waktu Reservasi</th>
            <th>Jumlah Orang</th>
            <th>Meja</th>
            <th>Catatan Khusus</th>
            <th>Status</td>
            </th>
        </tr>
        <?php if (count($result) > 0): ?>
            <?php foreach($result as $data): ?>
                <tr>
                    <td><?= array_search($data, $result) + 1 ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['tanggal'] ?></td>
                    <td><?= $data['waktu'] ?></td>
                    <td><?= $data['jumlah_orang'] ?></td>
                    <td><?= $data['jenis_meja'] ?></td>
                    <td><?= $data['catatan_khusus'] ?? "Tidak ada" ?></td>
                    <td><?= $data['status'] ?? "Tidak ada"?></td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
            <tr>
                <td colspan='8'>Tidak ada data reservasi.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>