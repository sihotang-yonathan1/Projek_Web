function showVerification() {
  var selectBox = document.getElementById("user");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var verificationField = document.getElementById("verification_field");
  var cardBack = document.querySelector(".card-back");
  var centerWrap = document.querySelector(".center-wrap");

  if (selectedValue === "manajer" || selectedValue === "pelayan") {
    verificationField.style.display = "block";
    cardBack.classList.add("active");
    centerWrap.classList.add("active");
  } else {
    verificationField.style.display = "none";
    cardBack.classList.remove("active");
    centerWrap.classList.remove("active");
  }
}
