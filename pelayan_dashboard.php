<?php
require 'crud_functions.php';
$reservasiData = getAllReservations($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pelayan</title>
    <link rel="stylesheet" href="pelayan/style.css">
    <link rel="icon" href="gambar/img.jpg">
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

        <?php
        if ($reservasiData->num_rows > 0) {
            $no = 1;
            while ($row = $reservasiData->fetch_assoc()) {
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['nama'] . "</td>
                    <td>" . $row['tanggal'] . "</td>
                    <td>" . $row['waktu'] . "</td>
                    <td>" . $row['jumlah_orang'] . "</td>
                    <td>" . $row['jenis_meja'] . "</td>
                    <td>" . ($row['catatan_khusus'] ?? 'Tidak ada') . "</td>
                    <td>" . ($row['status'] ?? 'Tidak ada') . "</td>
                    <td class='action-icons' id='action-icons'>
                        <a href='javascript:void(0)' onclick='showEditForm(" . json_encode($row) . ")'>
                            <img src='gambar/edit.svg' alt='Edit'>
                        </a>
                        <a href='javascript:void(0)' onclick='confirmDelete(" . $row['id'] . ")'>
                            <img src='gambar/trash.svg' alt='Delete'>
                        </a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr>
                <td colspan='9'>Tidak ada data reservasi.</td>
            </tr>";
        }
        ?>
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
            <select id="jenis-meja" name="jenis-meja" required>
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

    <script src="pelayan/script.js"></script>
</body>

</html>
