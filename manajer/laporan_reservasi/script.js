function search() {
  // Ambil nilai dari kotak pencarian
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.querySelector(".search_box input");
  filter = input.value.toUpperCase();

  // Ambil tabel yang ingin di-filter
  table = document.querySelector(".history_lists .list1 table");
  tr = table.getElementsByTagName("tr");

  // Loop melalui semua baris tabel, sembunyikan yang tidak cocok dengan query pencarian
  for (i = 0; i < tr.length; i++) {
    var found = false;
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }
    if (found) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}

// Tambahkan event listener untuk memanggil fungsi search() saat isi kotak pencarian berubah
document.querySelector(".search_box input").addEventListener("input", search);

function logout() {
  // Lakukan proses logout di sini
  // Hapus sesi dan arahkan ke halaman login
  window.location.href = "logout.php";
}

// Event Listeners
addBtn.addEventListener("click", addUser);

// Initialize table
renderTable();
