<?php
session_start();

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
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pelayan</title>
    <link rel="stylesheet" href="pelayan/style.css">
    <link rel="icon" href="./image/img.jpg">
</head>

<body>
    <header>
        <h3>DASHBOARD PELAYAN</h3>
        <form action="" method="post">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari...">
        </form>



        <a href="index.php"><button class="cta">Logout</button></a>
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
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php if (count($result) > 0): ?>
            <!-- Ref: https://stackoverflow.com/questions/3560757/php-equivalent-to-pythons-enumerate -->
            <?php foreach($result as $data): ?>
                <tr>
                    <?php $id_data = $data['id']; ?>
                    <td><?= $id_data ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['tanggal'] ?></td>
                    <td><?= $data['waktu'] ?></td>
                    <td><?= $data['jumlah_orang'] ?></td>
                    <td><?= $data['jenis_meja'] ?></td>
                    <td><?= $data['catatan_khusus'] ?? "Tidak ada" ?></td>
                    <td><?= $data['status'] ?? "Tidak ada"?></td>
                    <td class='action-icons' id='action-icons'>
                        <!-- TODO: set in separate js file -->
                        <a href='javascript:void(0)' onclick='showEditForm(<?= json_encode($data) ?>)'>
                            <img src='./image/edit.svg' alt='Edit'>
                        </a>
                        <!-- TODO: set in separate js file -->
                        <a href='javascript:void(0)' onclick='confirmDelete(<?= $id_data ?>)'>
                            <img src='./image/trash.svg' alt='Delete'>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
            <tr>
                <td colspan='8'>Tidak ada data reservasi.</td>
            </tr>
        <?php endif; ?>
    </table>

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

            <label for="jumlah_orang">Jumlah Orang:</label>
            <input type="number" id="jumlah_orang" name="jumlah_orang" required><br>

            <label for="jenis_meja">Jenis Meja:</label>
            <select id="jenis_meja" name="jenis_meja" required>
            <option value="meja-kecil">Meja Kecil</option>
            <option value="meja-panjang">Meja Panjang</option>
            <option value="meja-VIP">Meja VIP</option>
            </select>

            <label for="catatan_khusus">Catatan Khusus:</label>
            <textarea id="catatan_khusus" name="catatan_khusus"></textarea><br>

            <button class="submit" type="submit">Submit</button>
            <button class="cancel" type="button" onclick="hideForm()">Cancel</button>
        </form>
    </div>

    <script src="./pelayan/script.js"></script>
</body>

</html>
