// SHOW MENU
const showMenu = (toggleId, navbarId,bodyId) =>{
    const toggle = document.getElementById(toggleId),
    navbar = document.getElementById(navbarId),
    bodypadding = document.getElementById(bodyId)

    if(toggle && navbar){
        toggle.addEventListener('click', ()=>{
            // APARECER MENU
            navbar.classList.toggle('show')
            // ROTATE TOGGLE
            toggle.classList.toggle('rotate')
            // PADDING BODY
            bodypadding.classList.toggle('expander')
        })
    }
}
showMenu('nav-toggle','navbar','body')
// tombol buttom
function logout() {
    window.location.href = "/rpl-project/index.php";
  }
// LINK ACTIVE COLOR
const linkColor = document.querySelectorAll('.nav__link');   
function colorLink(){
    linkColor.forEach(l => l.classList.remove('active'));
    this.classList.add('active');

    const navbar = document.getElementById('navbar');
    const bodypadding = document.getElementById('body');

    navbar.classList.remove('show');
    document.getElementById('nav-toggle').classList.remove('rotate');
    bodypadding.classList.remove('expander');

     // Dapatkan ID bagian berdasarkan item menu yang diklik
     const sectionId = this.getAttribute('data-section-id');
     // Sembunyikan semua bagian
     document.querySelectorAll('.home').forEach(section => {
         section.style.display = 'none';
     });
     // Tampilkan bagian yang dipilih
     document.getElementById(sectionId).style.display = 'block';
}

linkColor.forEach(l => l.addEventListener('click', colorLink));

const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwtich = body.querySelector(".toggle-switch"),
     modeText = body.querySelector(".mode-text");

      toggle.addEventListener("click", () =>{
       sidebar.classList.toggle("close");
     });
      
     searchBtn.addEventListener("click", () =>{
       sidebar.classList.remove("close");
     });

    modeSwtich.addEventListener("click", () =>{
       body.classList.toggle("dark");

       if (body.classList.contains("dark")) {
           modeText.innerText = "Light Mode"
     } else {
           modeText.innerText = "Dark Mode"
       }
    });


    // Variables
const nameInput = document.getElementById("name-input");
const emailInput = document.getElementById("email-input");
const addBtn = document.getElementById("add-btn");
const tableBody = document.getElementById("table-body");
const updateNameInput = document.getElementById("update-name-input");
const updateEmailInput = document.getElementById("update-email-input");
const updateBtn = document.getElementById("update-btn");
const cancelBtn = document.getElementById("cancel-btn");
let users = JSON.parse(localStorage.getItem("users")) || [];
let currentUserId = null;
const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

// Functions
function renderTable() {
  tableBody.innerHTML = "";
  for (let i = 0; i < users.length; i++) {
    const user = users[i];
    const tr = document.createElement("tr");
    const idTd = document.createElement("td");
    const nameTd = document.createElement("td");
    const emailTd = document.createElement("td");
    const actionsTd = document.createElement("td");
    const editBtn = document.createElement("button");
    editBtn.className = "edit-btn";
    const deleteBtn = document.createElement("button");
    deleteBtn.className = "delete-btn";
    idTd.innerText = user.id;
    nameTd.innerText = user.name;
    emailTd.innerText = user.email;
    editBtn.innerText = "Edit";
    deleteBtn.innerText = "Delete";
    editBtn.addEventListener("click", () => {
      showUpdateForm(user.id);
    });
    deleteBtn.addEventListener("click", () => {
      deleteUser(user.id);
    });
    actionsTd.appendChild(editBtn);
    actionsTd.appendChild(deleteBtn);
    tr.appendChild(idTd);
    tr.appendChild(nameTd);
    tr.appendChild(emailTd);
    tr.appendChild(actionsTd);
    tableBody.appendChild(tr);
  }
}

function addUser() {
  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  if(email.match(validRegex)){
    if(name && email != null){
      var id = 1;
      var val = users.map(function(x){return x.id; }).indexOf(id);
      while(val != -1){
	    id++;
	    val = users.map(function(x){return x.id; }).indexOf(id);
  }
      const user = {
        id: id,
        name: name,
        email: email,
      };
      users.push(user);
      localStorage.setItem("users", JSON.stringify(users));
      nameInput.value = "";
      emailInput.value = "";
      renderTable();
    }else{
      alert("Name is Required");
    }
  }else{
    alert("Invalid email address!");
  }
}

function updateUser() {
  const name = updateNameInput.value;
  const email = updateEmailInput.value;
  if(email.match(validRegex)){
    const index = users.findIndex((user) => user.id === currentUserId);
    if (index !== -1) {
      users[index].name = name;
      users[index].email = email;
      localStorage.setItem("users", JSON.stringify(users));
      hideUpdateForm();
      renderTable();
    }
  }else{
    alert("Invalid email address!");
  }
}

function showUpdateForm(userId) {
  const user = users.find((user) => user.id === userId);
  if (user) {
    updateNameInput.value = user.name;
    updateEmailInput.value = user.email;
    currentUserId = user.id;
    updateBtn.addEventListener("click", updateUser);
    cancelBtn.addEventListener("click", hideUpdateForm);
    updateBtn.style.display = "inline-block";
    cancelBtn.style.display = "inline-block";
    updateNameInput.style.display = "inline-block";
    updateEmailInput.style.display = "inline-block";
    document.getElementById("update-container").style.display = "block";
  }
}

function hideUpdateForm() {
  updateNameInput.value = "";
  updateEmailInput.value = "";
  currentUserId = null;
  updateBtn.removeEventListener("click", updateUser);
  cancelBtn.removeEventListener("click", hideUpdateForm);
  updateBtn.style.display = "none";
  cancelBtn.style.display = "none";
  updateNameInput.style.display = "none";
  updateEmailInput.style.display = "none";
  document.getElementById("update-container").style.display = "none";
}

function deleteUser(userId) {
  users = users.filter((user) => user.id !== userId);
  localStorage.setItem("users", JSON.stringify(users));
  if (users.length == 0){
    hideUpdateForm();
  };
  renderTable();
}

// Event Listeners
addBtn.addEventListener("click", addUser);

// Initialize table
renderTable();


/* ----- BASE ------ */
"use strict";

// get required selectors to maniplute menu toggle
const navbar = document.querySelector (".navbar");
const menuTogglersContainer = document.querySelector(".menu-togglers");
const bxMenu = document.querySelector(".bx-menu");

/* -- show/hide menu -- */
menuTogglersContainer.addEventListener("click", () => {
  // if navbar tag have show-nav in as class
  navbar.classList.toggle("show-nav");
});

// tombol buttom
function logout() {
  window.location.href = "/loginPage/index.html";
}


// disable dark mode function
const disableLightMode = () => {
  // remove class dark mode from the body
  document.body.classList.remove("lightmode");
  localStorage.setItem("lightmode", null);
  // change theme toggle styles
  lightIcon.style.display = "block";
  darkIcon.style.display = "none";
};

// active/deactive dark mode
themeTogglers.addEventListener("click", () => {
  lightmode = localStorage.getItem("lightmode");
  if (!lightmode || lightmode !== "enabled") {
    enableLightMode();
  } else {
    disableLightMode();
  }
});


/* -- hide show hero buttons -- */
// delay before showing them
const heroButtonsContainer = document.querySelector(".hero-btns-container");

var delayTime = 1000;

heroButtonsContainer.style.transition = "opacity 1000ms";

setTimeout(() => {
  heroButtonsContainer.style.opacity = 1;
}, delayTime);

// --- prevent form submission on contact section ---
const sendMsgButton = document.querySelector(".send-msg-btn");
sendMsgButton.addEventListener("click", (e) => {
  e.preventDefault();
});


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
