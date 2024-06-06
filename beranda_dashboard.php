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
        <link rel="stylesheet" href="users/beranda/style.css">
        <link rel="icon" href="image/img.jpg">
        <link rel="icon" href="image/img.jpg">
    </head>

<body>
<body>
    <header class="container">
        <a href="#hero" class="logo clr-transition">ANCOL</a>
        <a href="#hero" class="logo clr-transition">ANCOL</a>
        <nav class="navbar">
            <ul class="nav-items">
                <li class="nav-item"><a href="#hero" class="nav-link clr-transition">Home</a></li>
                <li class="nav-item"><a href="#products" class="nav-link clr-transition">Tiket</a></li>
                <li class="nav-item"><a href="#products" class="nav-link clr-transition">Tiket</a></li>
                <li class="nav-item"><a href="#about" class="nav-link clr-transition">About</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link clr-transition">Developer</a></li>
                <li class="nav-item"><a href="./reservasi_dashboard.php" class="nav-link clr-transition">Pemesanan</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link clr-transition">Developer</a></li>
                <li class="nav-item"><a href="./reservasi_dashboard.php" class="nav-link clr-transition">Pemesanan</a></li>
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
    <main id="hero" class="main">
        <section class="section-one" style="background: url('./image/bg.jpeg') no-repeat center center fixed ; background-size: cover">
            <div class="container hook-container">
                <h1 class="hook-title clr-transition">Selamat Datang!</h1>
                <h2 class="hook-sub_title clr-transition">Nikmati keindahan, petualangan seru, dan berbagai <br/> atraksi menarik di destinasi rekreasi favorit keluarga.</h2>
                <h2 class="hook-sub_title clr-transition">Nikmati keindahan, petualangan seru, dan berbagai <br/> atraksi menarik di destinasi rekreasi favorit keluarga.</h2>
            </div>
        </section>

        <!-- --- section two --- -->
        <section id="about" class="section-two container">
        <section id="about" class="section-two container">
            <div class="oath-container">
                <h3>Deskripsi</h3>
                <br>
                <p>Ancol adalah sebuah kompleks wisata terkenal yang terletak di Pantai Utara Jakarta, Indonesia. Kompleks ini menawarkan beragam atraksi dan fasilitas rekreasi yang menarik bagi pengunjung dari berbagai kalangan.

Ancol menawarkan pengalaman liburan yang lengkap dengan kombinasi pantai, hiburan, dan rekreasi alam di tengah kesibukan kota Jakarta. Dikelilingi oleh pemandangan laut yang menakjubkan, Ancol menjadi tempat yang ideal untuk bersantai sambil menikmati udara segar pantai.

Salah satu daya tarik utama Ancol adalah Taman Impian Jaya Ancol, yang sering disebut sebagai Ancol Dreamland. Di sini, pengunjung dapat menemukan berbagai wahana hiburan, termasuk Atlantis Water Adventure, Dunia Fantasi (Dufan), SeaWorld Ancol, dan masih banyak lagi. Setiap wahana menawarkan pengalaman yang menyenangkan bagi pengunjung dari segala usia.

Selain wahana hiburan, Ancol juga memiliki fasilitas rekreasi alam yang menarik seperti Pantai Carnaval, tempat pengunjung dapat menikmati keindahan pantai sambil bermain permainan tradisional atau bersantai di tepi pantai. Ada juga pusat perbelanjaan, restoran, dan hotel-hotel yang menyediakan berbagai fasilitas bagi wisatawan yang ingin menginap.

Ancol juga terkenal dengan pantainya yang bersih dan indah, menawarkan pengalaman bersantai yang menyenangkan bagi pengunjung yang ingin menikmati keindahan alam serta aktivitas air seperti berenang atau berlayar.

Secara keseluruhan, Ancol adalah destinasi wisata yang populer di Jakarta yang menawarkan kombinasi sempurna antara hiburan, rekreasi alam, dan keindahan alam pantai yang memukau. Dengan beragam atraksi dan fasilitasnya, Ancol merupakan tempat yang cocok untuk liburan keluarga atau sekadar bersantai bersama teman-teman.</p>
                <br>
                <p>Ancol adalah sebuah kompleks wisata terkenal yang terletak di Pantai Utara Jakarta, Indonesia. Kompleks ini menawarkan beragam atraksi dan fasilitas rekreasi yang menarik bagi pengunjung dari berbagai kalangan.

Ancol menawarkan pengalaman liburan yang lengkap dengan kombinasi pantai, hiburan, dan rekreasi alam di tengah kesibukan kota Jakarta. Dikelilingi oleh pemandangan laut yang menakjubkan, Ancol menjadi tempat yang ideal untuk bersantai sambil menikmati udara segar pantai.

Salah satu daya tarik utama Ancol adalah Taman Impian Jaya Ancol, yang sering disebut sebagai Ancol Dreamland. Di sini, pengunjung dapat menemukan berbagai wahana hiburan, termasuk Atlantis Water Adventure, Dunia Fantasi (Dufan), SeaWorld Ancol, dan masih banyak lagi. Setiap wahana menawarkan pengalaman yang menyenangkan bagi pengunjung dari segala usia.

Selain wahana hiburan, Ancol juga memiliki fasilitas rekreasi alam yang menarik seperti Pantai Carnaval, tempat pengunjung dapat menikmati keindahan pantai sambil bermain permainan tradisional atau bersantai di tepi pantai. Ada juga pusat perbelanjaan, restoran, dan hotel-hotel yang menyediakan berbagai fasilitas bagi wisatawan yang ingin menginap.

Ancol juga terkenal dengan pantainya yang bersih dan indah, menawarkan pengalaman bersantai yang menyenangkan bagi pengunjung yang ingin menikmati keindahan alam serta aktivitas air seperti berenang atau berlayar.

Secara keseluruhan, Ancol adalah destinasi wisata yang populer di Jakarta yang menawarkan kombinasi sempurna antara hiburan, rekreasi alam, dan keindahan alam pantai yang memukau. Dengan beragam atraksi dan fasilitasnya, Ancol merupakan tempat yang cocok untuk liburan keluarga atau sekadar bersantai bersama teman-teman.</p>
                <br>
        </section>

        <!-- section three -->
        <section class="section-three container"
            style="background: url('./image/bg.jpeg') no-repeat center center fixed ; background-size:  cover">
        <section class="section-three container"
            style="background: url('./image/bg.jpeg') no-repeat center center fixed ; background-size:  cover">
            <div class=" s-three-upper-img-container">
                <img src="./image/gg1.jpg" alt="" loading="lazy">
                <img src="./image/gg1.jpg" alt="" loading="lazy">
            </div>
            <div class="s-three-lower-container">
                <h3 class=" s-three-title">Stress out? Silakan coba berlibur ditempat kami.</h3>
                <p class="s-three-desc s-definition">Jadikan Ancol destinasi liburan Anda berikutnya - dengan berbagai wahana hiburan, pantai yang indah, dan suasana menyenangkan, Ancol memiliki segalanya!</p>
                <span class="s-three-price">Ayo pesan tiket sekarang, sebelum kehabisan.</span>
                <h3 class=" s-three-title">Stress out? Silakan coba berlibur ditempat kami.</h3>
                <p class="s-three-desc s-definition">Jadikan Ancol destinasi liburan Anda berikutnya - dengan berbagai wahana hiburan, pantai yang indah, dan suasana menyenangkan, Ancol memiliki segalanya!</p>
                <span class="s-three-price">Ayo pesan tiket sekarang, sebelum kehabisan.</span>
                <a href="reservasi_dashboard.php"> <button class="button ad-buy-btn">Order Now</button></a>
            </div>
        </section>

        <!-- section four -->
        <section id="products" class="section-two container">
        <section id="products" class="section-two container">
            <div class="s-two-upper-info">
                <h2 class="s-two-slogan">Temukan petualangan tanpa batas di Ancol - destinasi liburan terbaik untuk keluarga Anda
                <h2 class="s-two-slogan">Temukan petualangan tanpa batas di Ancol - destinasi liburan terbaik untuk keluarga Anda
                </h2>
                <p class="s-definition">
                Nikmati kelezatan kuliner lokal, dan ciptakan kenangan tak terlupakan di Ancol. Dengan beragam atraksi dan fasilitas untuk segala usia, Ancol adalah pilihan ideal untuk liburan keluarga yang menyenangkan dan bermakna
                <p class="s-definition">
                Nikmati kelezatan kuliner lokal, dan ciptakan kenangan tak terlupakan di Ancol. Dengan beragam atraksi dan fasilitas untuk segala usia, Ancol adalah pilihan ideal untuk liburan keluarga yang menyenangkan dan bermakna
                </p>
            </div>
            <div class="s-two-products">
                <div class="product product-one">
                    <img src="./image/anc.jpeg" loading="lazy">
                    <a href="reservasi_dashboard.php"><button class="buy-btn pos-abs-center" >Order</button></a>
                    <h3 class="name pos-abs-center">Ancol</h3>
                    <img src="./image/anc.jpeg" loading="lazy">
                    <a href="reservasi_dashboard.php"><button class="buy-btn pos-abs-center" >Order</button></a>
                    <h3 class="name pos-abs-center">Ancol</h3>
                </div>
                <div class="product product-two">
                    <img src="./image/duf.jpeg" alt="" loading="lazy">
                    <a href="reservasi_dashboard.php"><button class="buy-btn pos-abs-center" >Order</button></a>
                    <h3 class="name pos-abs-center">Dufan <b>Ancol</b></h3>
                    <img src="./image/duf.jpeg" alt="" loading="lazy">
                    <a href="reservasi_dashboard.php"><button class="buy-btn pos-abs-center" >Order</button></a>
                    <h3 class="name pos-abs-center">Dufan <b>Ancol</b></h3>
                </div>
                <div class="product product-three">
                    <img src="./image/sea.jpeg" alt="ice cream with honey" loading="lazy">
                    <a href="reservasi_dashboard.php"><button class="buy-btn pos-abs-center" >Order</button></a>
                    <h3 class="name pos-abs-center">Sea World <b>Ancol</b></h3>
                    <img src="./image/sea.jpeg" alt="ice cream with honey" loading="lazy">
                    <a href="reservasi_dashboard.php"><button class="buy-btn pos-abs-center" >Order</button></a>
                    <h3 class="name pos-abs-center">Sea World <b>Ancol</b></h3>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->

    <!-- FOOTER -->
    <footer id="contact" class="footer container">
        <div class="lower-footer">
            <span class="lower-footer-elt" id="lower-footer-elt1">copyright ©2024 Ancol</span>
            <span class="lower-footer-elt" id="lower-footer-elt2">Developed by Kelompok 2 Pemrograman Web</span>
            <span class="lower-footer-elt" id="lower-footer-elt3"><a href="#" class="policy-link">Privacy • Policy</a></span>
            <span class="lower-footer-elt" id="lower-footer-elt1">copyright ©2024 Ancol</span>
            <span class="lower-footer-elt" id="lower-footer-elt2">Developed by Kelompok 2 Pemrograman Web</span>
            <span class="lower-footer-elt" id="lower-footer-elt3"><a href="#" class="policy-link">Privacy • Policy</a></span>
        </div>
    </footer>
    <script src="./users/beranda/script.js"></script>
    <script src="./users/beranda/script.js"></script>
</body>

</html>

</html>


</html>
