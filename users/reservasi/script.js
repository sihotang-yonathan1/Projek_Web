document.getElementById("reservation-form").addEventListener("submit", function(event) {
    event.preventDefault();

    // Mengambil nilai input dari form
    var nama = document.getElementById("nama").value;
    var tanggal = document.getElementById("tanggal").value;
    var waktu = document.getElementById("waktu").value;
    var jumlahOrang = document.getElementById("jumlah-orang").value;
    var jenisMeja = document.getElementById("jenis-meja").value;

    // Mengirim data reservasi ke server atau melakukan operasi lainnya
    // ...
    
    // Menampilkan pesan sukses
    alert("Reservasi berhasil!");
});

function logout() {
    // Lakukan proses logout di sini
    // Hapus sesi dan arahkan ke halaman login
    window.location.href = "logout.php";
}
