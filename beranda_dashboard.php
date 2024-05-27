<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Beranda User</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./users/beranda/style.css">
        <link rel="icon" href="./image/img.jpg">
    </head>

<body>
    <header class="container">
        <a href="#hero" class="logo clr-transition">Restaurant</a>
        <nav class="navbar">
            <ul class="nav-items">
                <li class="nav-item"><a href="#hero" class="nav-link clr-transition">Home</a></li>
                <li class="nav-item"><a href="#products" class="nav-link clr-transition">Product</a></li>
                <li class="nav-item"><a href="#about" class="nav-link clr-transition">About</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link clr-transition">Developer</a></li>
                <li class="nav-item"><a href="./reservasi_dashboard.php" class="nav-link clr-transition">Reservasi</a></li>
            </ul>
            <div class="social-links">
                <ul>
                    <li><i class='bx bxl-instagram nav-icon'></i></li>
                    <li><i class='bx bxl-twitter nav-icon'></i></li>
                    <li><i class='bx bxl-facebook nav-icon'></i></li>
                </ul>
            </div>
            <button class="tombol" onclick="logout()">Logout</button>
        </nav>
    </header>
    <main id="hero" class="main">
        <section class="section-one">
            <div class="container hook-container">
                <h1 class="hook-title clr-transition">Selamat Datang!</h1>
                <h2 class="hook-sub_title clr-transition">Warongwarem Restaurant.</h2>
            </div>
        </section>

        <!-- --- section two --- -->
        <section id="about" class="section-two container">
            <div class="oath-container">
                <h3>Deskripsi</h3>
                <br>
                <p>Warongwarem adalah destinasi kuliner yang menghadirkan pengalaman makan tak terlupakan dengan
                    berbagai keunggulan. Dengan konsep warung tradisional yang dirancang modern, tempat ini memadukan
                    nuansa hangat dan suasana ramah untuk menciptakan ruang bersantap yang nyaman. Menu Warongwarem
                    Reservasi menawarkan seleksi hidangan autentik Indonesia, dari nasi goreng yang gurih hingga rendang
                    yang lezat, memanjakan lidah para pelanggan.

                    Keistimewaan Warongwarem terletak pada kemudahan pemesanan. Dengan sistem reservasi yang canggih,
                    pelanggan dapat dengan mudah memesan meja secara online, memastikan pengalaman makan yang lancar dan
                    tanpa hambatan. Sebagai tambahan, pilihan tempat duduk yang nyaman dan privasi yang dijaga
                    membuatnya cocok untuk acara keluarga, pertemuan bisnis, atau perayaan khusus.

                    Warongwarem Reservasi hanya memanjakan selera dengan hidangan lezat, tetapi juga menawarkan layanan
                    pelanggan yang unggul. Dengan staf yang profesional dan ramah, pengunjung merasa dihargai dan
                    dilayani dengan baik sejak saat pertama kali masuk. Tempat ini juga sering mengadakan acara khusus,
                    seperti pameran seni, pertunjukan musik, atau tema kuliner tertentu, menambahkan dimensi hiburan dan
                    keunikan pada pengalaman makan.

                    Dengan perpaduan antara citra tradisional dan layanan modern, Warongwarem Reservasi tidak hanya
                    menjadi tempat makan, tetapi juga destinasi untuk menciptakan kenangan berharga. Dari masakan lezat
                    hingga atmosfer yang mengundang, Warongwarem menjadi pilihan utama bagi mereka yang mencari
                    kombinasi sempurna antara tradisi dan kemudahan dalam menyajikan pengalaman kuliner yang tak
                    terlupakan.</p>
                <br>
        </section>

        <!-- section three -->
        <section class="section-three container"
            style="background: url('./image/bg.jpg') no-repeat center center fixed ; background-size:  cover">
            <div class=" s-three-upper-img-container">
                <img src="./image/Nasi-Goreng-Seafood.jpg" alt="" loading="lazy">
            </div>
            <div class="s-three-lower-container">
                <h3 class=" s-three-title">Stress out? Silakan coba makan ditempat kami.</h3>
                <p class="s-three-desc s-definition">Makanan kami autentik Indonesia, dari nasi goreng yang gurih hingga
                    rendang yang lezat, memanjakan lidah para pelanggan.</p>
                <span class="s-three-price">Ayo pesan tempat sekarang, sebelum kehabisan.</span>
                <a href="reservasi_dashboard.php"> <button class="button ad-buy-btn">Order Now</button></a>
            </div>
        </section>

        <!-- section four -->
        <section id="products" class="section-two container">
            <div class="s-two-upper-info">
                <h2 class="s-two-slogan">WarongWarem Restorant, Tempat Nyaman, Makan Lezat, Kenangan Tak Terlupakan!.
                </h2>
                <p class="s-definition">
                    Makanan kami autentik Indonesia, dari nasi goreng yang gurih hingga rendang yang lezat, memanjakan
                    lidah para pelanggan.
                </p>
            </div>
            <div class="s-two-products">
                <div class="product product-one">
                    <img src="./image/dinner-table-444797_1280.jpg" loading="lazy">
                    <h3 class="buy-btn pos-abs-center">Order</h3>
                    <h3 class="name pos-abs-center">Meja <b>VIP</b></h3>
                </div>
                <div class="product product-two">
                    <img src="./image/mejaPanjang.png" alt="" loading="lazy">
                    <h3 class="buy-btn pos-abs-center">Order</h3>
                    <h3 class="name pos-abs-center">Meja <b>Panjang</b></h3>
                </div>
                <div class="product product-three">
                    <img src="./image/restaurant-766050_1280.jpg" alt="ice cream with honey" loading="lazy">
                    <h3 class="buy-btn pos-abs-center">Order</h3>
                    <h3 class="name pos-abs-center">Meja <b>Kecil</b></h3>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer id="contact" class="footer container">
        <div class="lower-footer">
            <span class="lower-footer-elt" id="lower-footer-elt1">copyright ©2024 Reservasi</span>
            <span class="lower-footer-elt" id="lower-footer-elt2">Developed by Kelompok 2 Pemrograman Web</span>
            <span class="lower-footer-elt" id="lower-footer-elt3"><a href="#" class="policy-link">Privacy • Policy</a></span>
        </div>
    </footer>
    <link href=' https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="./users/beranda/script.js"></script>
</body>

</html>

</html>
