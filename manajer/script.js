function search() {
  // Ambil nilai dari kotak pencarian
  var input, filter, table1, table2, tr, td, i, txtValue;
  input = document.querySelector(".search_box input");
  filter = input.value.toUpperCase();

  // Ambil tabel yang ingin di-filter
  table1 = document.querySelector(".list1 table");
  table2 = document.querySelector(".list2 table");
  var tables = [table1, table2];

  // Loop melalui semua tabel
  for (var t = 0; t < tables.length; t++) {
    var currentTable = tables[t];
    tr = currentTable.getElementsByTagName("tr");

    // Loop melalui semua baris tabel, sembunyikan yang tidak cocok dengan query pencarian
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td");
      for (var j = 0; j < td.length; j++) {
        if (td[j]) {
          txtValue = td[j].textContent || td[j].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
            break;
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  }
}

// Tambahkan event listener untuk memanggil fungsi search() saat isi kotak pencarian berubah
document.querySelector(".search_box input").addEventListener("input", search);

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
