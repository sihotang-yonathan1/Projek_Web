/* ----- BASE ------ */
"use strict";

// tombol buttom
function logout() {
  window.location.href = "index.php";
}

function logout() {
  // Lakukan proses logout di sini
  // Hapus sesi dan arahkan ke halaman login
  window.location.href = "logout.php";
}

document.querySelectorAll(".nav-link").forEach((item) => {
  item.addEventListener("click", (event) => {
    // Periksa apakah tautan memiliki hash dalam href
    if (item.getAttribute("href").charAt(0) === "#") {
      event.preventDefault(); // Mencegah perilaku default dari tautan

      const targetId = item.getAttribute("href"); // Ambil id target dari href
      const target = document.querySelector(targetId);
      const headerHeight = document.querySelector("header").offsetHeight; // Tinggi header

      if (target) {
        // Gulir halaman ke bagian awal elemen target dengan memperhitungkan tinggi header
        window.scrollTo({
          top: target.offsetTop - headerHeight,
          behavior: "smooth", // Efek gulir halus
        });
      }
    }
  });
});
