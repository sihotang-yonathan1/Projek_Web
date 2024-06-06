<?php

require_once('crud_functions.php');
require_once('./config.php');
require_once('./utils/network/http_client.php');

require_once('crud_functions.php');
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
// The APi before is using the same table as `reservation_form` but i think
// this variable meant to retrieve data from `pelayan_form` table, i may wrong though
$_result = HttpClient::get("$PROJECT_URL/backend/api/v1/reservasi.php");
$result = json_decode($_result, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pelayan</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="pelayan/style.css">
    <link rel="icon" href="image/img.jpg">
</head>
<body>
    <header>
        <h3>DASHBOARD PELAYAN</h3>
        <form action="" method="post">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari...">
        <h3>DASHBOARD PELAYAN</h3>
        <form action="" method="post">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari...">
        </form>
        <a href="index.php"><button class="cta">Logout</button></a>
    </header>

    <div class="table-container">
        <table>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Kedatangan</th>
                <th>Waktu Kedatangan</th>
                <th>Jumlah Tiket</th>
                <th>Tipe Tiket</th>
                <th>Catatan Khusus</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (count($result) > 0): ?>
                <?php foreach($result as $data): ?>
                    <tr>
                        <?php $id_data = $data['id']; ?>
                        <td><?= $id_data ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><?= $data['waktu'] ?></td>
                        <td><?= $data['jumlah_tiket'] ?></td>
                        <td><?= $data['jenis_tiket'] ?></td>
                        <td><?= $data['catatan_khusus'] ?></td>
                        <td><?= $data['status'] ?? "Belum Konfirmasi"?></td>
                        <td class='action-icons' id='action-icons'>
                            <a href='javascript:void(0)' onclick='showEditForm(<?= json_encode($data) ?>)'>
                                <img src='./image/edit.svg' alt='Edit'>
                            </a>
                            <a href='javascript:void(0)' onclick='confirmDelete(<?= $id_data ?>)'>
                                <img src='./image/trash.svg' alt='Delete'>
                            </a>
                            <a href='javascript:void(0)' onclick='confirmReservation(<?= $id_data ?>)'>
                                <img src='./image/check-square.svg' alt='Confirm'>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else: ?>
                <tr>
                    <td colspan='9'>Tidak ada data reservasi.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div id="form-modal" style="display:none;">
        <form id="reservation-form" method="post">
            <input type="hidden" name="id" id="reservation-id">
            <input type="hidden" name="action" id="form-action">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required><br>
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required><br>
            <label for="waktu">Waktu:</label>
            <input type="time" id="waktu" name="waktu" required><br>
            <label for="jumlah_tiket">Jumlah Tiket:</label>
            <input type="number" id="jumlah_tiket" name="jumlah_tiket" min="1" required><br>
            <label for="jenis_tiket">Tipe Tiket:</label>
            <select id="jenis_tiket" name="jenis_tiket" required>
            <option value="Ancol">Ancol</option>
            <option value="Dufan Ancol">Dufan Ancol</option>
            <option value="Sea World Ancol">Sea World Ancol</option>
            </select>
            <label for="catatan_khusus">Catatan Khusus:</label>
            <textarea id="catatan_khusus" name="catatan_khusus"></textarea><br>
            <button class="submit" type="submit">Submit</button>
            <button class="cancel" type="submit" onclick="hideForm()">Cancel</button>
        </form>
    </div>

    <script src="./pelayan/script.js"></script>
</body>
</html>