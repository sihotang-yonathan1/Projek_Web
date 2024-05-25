<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

// Koneksi ke database (ganti dengan detail koneksi Anda)
$host = "localhost";
$username = "root";
$password = "";
$db = "reservasi_form";

$conn = new mysqli($host, $username, $password, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data reservasi
$query = "SELECT * FROM reservasi_form";
$result = $conn->query($query);
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

        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['nama'] . "</td>
                    <td>" . $row['tanggal'] . "</td>
                    <td>" . $row['waktu'] . "</td>
                    <td>" . $row['jumlah_orang'] . "</td>
                    <td>" . $row['jenis_meja'] . "</td>
                    <td>" . ($row['catatan_khusus'] ?? 'Tidak ada') . "</td>
                    <td>" . ($row['status'] ?? 'Tidak ada') . "</td> 
            </tr>";
        }
        } else {
        echo "<tr>
            <td colspan='8'>Tidak ada data reservasi.</td>
        </tr>";
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </table>
</body>

</html>
