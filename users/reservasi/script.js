function submitForm() {
  // Ambil data form
  var nama = document.getElementById("nama").value;
  var tanggal = document.getElementById("tanggal").value;
  var waktu = document.getElementById("waktu").value;
  var jumlahOrang = document.getElementById("jumlah-tiket").value;
  var jenisMeja = document.getElementById("jenis-tiket").value;

  // Validasi form sebelum submit
  if (nama && tanggal && waktu && jumlahOrang && jenisMeja) {
    // Tampilkan pesan sukses menggunakan window.alert()
    window.alert("Reservasi berhasil!");
  }
}

function logout() {
  // Lakukan proses logout di sini
  // Hapus sesi dan arahkan ke halaman login
  window.location.href = "logout.php";
}

