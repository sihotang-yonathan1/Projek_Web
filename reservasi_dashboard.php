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
    <link rel="stylesheet" type="text/css" href="./users/beranda/style.css">

    <link rel="icon" href="./image/img.jpg">
    <!-- TODO: refer this style in external file -->
</head>

<body>
<header class="container">
      <a href="#hero" class="logo clr-transition">ANCOL</a>
      <nav class="navbar">
        <ul class="nav-items">
          <li class="nav-item">
            <a href="beranda_dashboard.php#hero" class="nav-link clr-transition"
              >Home</a
            >
          </li>
          <li class="nav-item">
            <a
              href="beranda_dashboard.php#products"
              class="nav-link clr-transition"
              >Tiket</a
            >
          </li>
          <li class="nav-item">
            <a
              href="beranda_dashboard.php#about"
              class="nav-link clr-transition"
              >About</a
            >
          </li>
          <li class="nav-item">
            <a href="about.html" class="nav-link clr-transition">Developer</a>
          </li>
          <li class="nav-item">
            <a href="reservasi_dashboard.php" class="nav-link clr-transition"
              >Pemesanan</a
            >
          </li>
        </ul>
        <div class="social-links">
                <ul>
                    <li><a class="nav-icon" href="https://www.instagram.com/ancoltamanimpian/"><img class="nav-icon" src="image/instagram.svg" alt="Instagram" /></a></li>
                    <li><a class="nav-icon" href="https://x.com/ancoltmnimpian"><img class="nav-icon" src="image/twitter.svg" alt="Twitter" /></a></li>
                    <li><a class="nav-icon" href="https://www.facebook.com/ancolseaworld/"><img class="nav-icon" src="image/facebook.svg" alt="Facebook" /></a></li>
                </ul>
            </div>
        <button class="tombol" onclick="logout()">Logout</button>
      </nav>
    </header>
    <!-- TODO: set style in external file -->
    <!-- TODO: set the eventListener using js instead of inline in `onclick` -->
    <div class="row-tiket">
      <div class="judul">
        <h1>Pemesanan Tiket </h1>
      </div>

      <div class="pemesanan">
        <form id="reservation-form" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
          
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required><br>
        
        <label for="waktu">Waktu:</label>
        <input type="time" id="waktu" name="waktu" required><br>

        <label for="jumlah-orang">Jumlah Tiket:</label>
        <input type="number" id="jumlah-orang" name="jumlah-orang" min="1" required><br>
        
        <label for="jenis-meja">Tipe Tiket:</label>
            <select id="jenis-meja" name="jenis-meja" required>
              <option value="Ancol">Ancol</option>
              <option value="Dufan Ancol">Dufan Ancol</option>
              <option value="Sea World Ancol">Sea World Ancol</option>
            </select><br>
            <button type="submit" onclick="submitForm()">Pesan</button>
          </form>
        </div>
    </div>
    <script src="./users/reservasi/script.js"></script>
</body>

</html>
