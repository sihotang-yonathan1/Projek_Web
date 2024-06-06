function searchTable() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.querySelector("table");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    for (var j = 0; j < td.length; j++) {
      cell = tr[i].getElementsByTagName("td")[j];
      if (cell) {
        txtValue = cell.textContent || cell.innerText;
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

function showEditForm(data) {
  document.getElementById("form-modal").style.display = "block";
  document.getElementById("form-action").value = "update";
  document.getElementById("reservation-id").value = data.id;
  document.getElementById("nama").value = data.nama;
  document.getElementById("tanggal").value = data.tanggal;
  document.getElementById("waktu").value = data.waktu;
  document.getElementById("jumlah_tiket").value = data.jumlah_tiket;
  document.getElementById("jenis_tiket").value = data.jenis_tiket;
  document.getElementById("catatan_khusus").value = data.catatan_khusus;
}

function hideForm() {
  document.getElementById("form-modal").style.display = "none";
}

function confirmDelete(id) {
  if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "crud_functions.php";

    var inputId = document.createElement("input");
    inputId.type = "hidden";
    inputId.name = "id";
    inputId.value = id;

    var inputAction = document.createElement("input");
    inputAction.type = "hidden";
    inputAction.name = "action";
    inputAction.value = "delete";

    form.appendChild(inputId);
    form.appendChild(inputAction);
    document.body.appendChild(form);
    form.submit();
  }
}

function confirmReservation(id) {
  if (confirm("Apakah Anda yakin ingin mengkonfirmasi reservasi ini?")) {
    fetch("crud_functions.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "action=confirm&id=" + id,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        // Lakukan penanganan tambahan jika diperlukan, misalnya memperbarui tampilan
        alert("Reservasi telah dikonfirmasi.");
        window.location.reload(); // Untuk me-refresh halaman setelah reservasi dikonfirmasi
      })
      .catch((error) => {
        console.error("There was a problem with your fetch operation:", error);
      });
  }
}

function logout() {
  // Lakukan proses logout di sini
  // Hapus sesi dan arahkan ke halaman login
  window.location.href = "logout.php";
}

function alertFunction() {
  alert("Reservasi berhasil dikonfirmasi!");
}
