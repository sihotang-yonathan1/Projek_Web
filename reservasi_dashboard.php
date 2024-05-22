<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}

// TODO: encapsulate the DB connection process in one separate file
$host = "localhost";
$username = "root";
$password = "";
$db = "user_db";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO: refactor repeated function
    $name = $conn->real_escape_string($_POST['nama']);
    $date = $conn->real_escape_string($_POST['tanggal']);
    $time = $conn->real_escape_string($_POST['waktu']);
    $user = $conn->real_escape_string($_POST['jumlah-orang']);
    $jenis = $conn->real_escape_string($_POST['jenis-meja']);

    // TODO: set this query string into prepared statement
    $sql = "INSERT INTO reservasi_form (nama, tanggal, waktu, jumlah_orang, jenis_meja) VALUES ('$name', '$date', '$time', '$user', '$jenis')";

    if ($conn->query($sql) === TRUE) {
        $message = "Reservasi berhasil dilakukan!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reservasi Meja Restoran WarongWarem</title>
    <link rel="stylesheet" type="text/css" href="/rpl-project/users/reservasi/style.css">

    <link rel="icon" href="/rpl-project/image/img.jpg">
    <script>
    <?php
        // Output pesan sebagai variabel JavaScript
        echo "var message = '" . $message . "';";
        ?>

    // Tampilkan alert jika pesan tidak kosong
    if (message !== "") {
        alert(message);
    }
    </script>
    <!-- TODO: refer this style in external file -->
    <style>
    .tombol {
        background-color: rgb(103, 202, 45);
        width: 60px;
        height: 30px;
        margin-left: 30px;
        color: #f5fdff;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        border-radius: 12%;
    }

    .tombol:hover {
        background-color: rgb(198, 21, 21);
    }
    </style>
</head>

<body>
    <!-- TODO: set style in external file -->
    <!-- TODO: set the eventListener using js instead of inline in `onclick` -->
    <button class="tombol" onclick="logout()" style="position: relative; left: 1140px; bottom: 265px">Logout</button>
    <h1>Reservasi Meja </h1>
    <form action="" method=" post">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>

        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required><br>

        <label for="waktu">Waktu:</label>
        <input type="time" id="waktu" name="waktu" required><br>

        <label for="jumlah-orang">Jumlah Orang:</label>
        <input type="number" id="jumlah-orang" name="jumlah-orang" required><br>

        <label for="jenis-meja">Jenis Meja:</label>
        <select id="jenis-meja" name="jenis-meja" required>
            <option value="meja-kecil">Meja Kecil</option>
            <option value="meja-panjang">Meja Panjang</option>
            <option value="meja-VIP">Meja VIP</option>
        </select><br>
        <input type="submit" value="Reservasi">
    </form>

    <script src="users/reservasi/script.js"></script>
</body>

</html>