const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");
const phoneInput = document.querySelector("#phone");
const streetInput = document.querySelector("#street");
const zipcodeInput = document.querySelector("#zipcode");
const cityInput = document.querySelector("#city");
const passwordInput = document.querySelector("#password");
const password2Input = document.querySelector("#password2");

const submitBtn = document.querySelector("#submitBtn");
const createAccForm = document.querySelector(".createAcc-form");
const letters = /^[a-öA-Ö]+$/;
const hasNumber = /\d/;

function validate() {
  let went_well = true;

  //function nameVal() {
  if (
    /^[a-öA-Ö\s]*$/.test(nameInput.value) === false ||
    nameInput.value.includes(" ") === false ||
    nameInput.value.length < 3 ||
    nameInput.value.length > 50
  ) {
    document.querySelector(".namePopup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".namePopup").classList.add("hide");
  }
  //}

  //function emailVal() {
  if (
    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailInput.value) ||
    emailInput.value.length < 50
  ) {
    document.querySelector(".emailPopup").classList.add("hide");
    console.log("lagt till hide från emailval");
  } else {
    document.querySelector(".emailPopup").classList.remove("hide");
    went_well = false;
  }
  //}

  //function phoneVal() {
  if (
    phoneInput.value.length < 5 ||
    phoneInput.value.length > 20 ||
    Number.isInteger(parseInt(phoneInput.value)) === false ||
    /^[0-9 ()+-]+$/.test(phoneInput.value) === false
  ) {
    console.log("i phone validerings if");
    document.querySelector(".phonePopup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".phonePopup").classList.add("hide");
  }
  //}

  //function streetVal() {
  if (
    streetInput.value.trim().length < 2 ||
    streetInput.value.trim().length > 50 ||
    /^[a-öA-Ö0-9\s]*$/.test(streetInput.value) === false
  ) {
    document.querySelector(".streetPopup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".streetPopup").classList.add("hide");
  }
  //}

  //function zipcodeVal() {
  if (
    zipcodeInput.value.length !== 5 || //Använda mellanslag?
    Number.isInteger(parseInt(zipcodeInput.value)) === false ||
    zipcodeInput.value.includes("e") ||
    /^[0-9\s]*$/.test(zipcodeInput.value) === false
  ) {
    document.querySelector(".zipcodePopup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".zipcodePopup").classList.add("hide");
  }
  //}

  //function cityVal() {
  if (
    cityInput.value.length < 2 ||
    cityInput.value > 50 ||
    hasNumber.test(cityInput.value) === true ||
    /^[a-öA-Ö\s]*$/.test(cityInput.value) === false
  ) {
    console.log(hasNumber.test(cityInput.value));
    document.querySelector(".cityPopup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".cityPopup").classList.add("hide");
  }
  //}

  //function passwordVal() {
  if (
    passwordInput.value.length < 6 ||
    /^[a-öA-Ö0-9]*$/.test(passwordInput.value) === false ||
    /[A-Öa-ö].*[0-9]|[0-9].*[A-Öa-ö]/.test(passwordInput.value) === false ||
    passwordInput.value.length > 60
  ) {
    document.querySelector(".passwordPopup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".passwordPopup").classList.add("hide");
  }
  //}

  //function password2Val() {
  if (password2Input.value !== passwordInput.value) {
    document.querySelector(".password2Popup").classList.remove("hide");
    went_well = false;
  } else {
    document.querySelector(".password2Popup").classList.add("hide");
  }
  //}

  return went_well;
}

passwordInput.addEventListener("input", function (event) {
  let value = passwordInput.value;
  document.querySelector(".strongPass").classList.add("hide");
  document.querySelector(".okPass").classList.add("hide");
  document.querySelector(".weakPass").classList.add("hide");
  if (
    value.length > 10 &&
    /^[a-öA-Ö0-9]*$/.test(value) &&
    /[A-Öa-ö].*[0-9]|[0-9].*[A-Öa-ö]/.test(value)
  ) {
    document.querySelector(".strongPass").classList.remove("hide");
    document.querySelector(".okPass").classList.add("hide");
    document.querySelector(".weakPass").classList.add("hide");
  } else if (
    value.length >= 6 &&
    /^[a-öA-Ö0-9]*$/.test(value) &&
    /[A-Öa-ö].*[0-9]|[0-9].*[A-Öa-ö]/.test(value)
  ) {
    document.querySelector(".strongPass").classList.add("hide");
    document.querySelector(".okPass").classList.remove("hide");
    document.querySelector(".weakPass").classList.add("hide");
  }
  if (
    value.length < 6 ||
    /^[a-öA-Ö0-9]*$/.test(value) === false ||
    /[A-Öa-ö].*[0-9]|[0-9].*[A-Öa-ö]/.test(value) === false
  ) {
    document.querySelector(".strongPass").classList.add("hide");
    document.querySelector(".okPass").classList.add("hide");
    document.querySelector(".weakPass").classList.remove("hide");
  }

  if (value === "") {
    document.querySelector(".strongPass").classList.add("hide");
    document.querySelector(".okPass").classList.add("hide");
    document.querySelector(".weakPass").classList.add("hide");
  }
});
