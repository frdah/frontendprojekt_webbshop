const passwordInput = document.querySelector("#password");
const password2Input = document.querySelector("#password2");

console.log("helluuuu från newpassjs")

const letters = /^[a-öA-Ö]+$/;
const hasNumber = /\d/;
function vaildate(){
    if (
    passwordInput.value.length < 6 ||
    /^[a-öA-Ö0-9]*$/.test(passwordInput.value) === false ||
    /[A-Öa-ö].*[0-9]|[0-9].*[A-Öa-ö]/.test(passwordInput.value) === false) {
        document.querySelector(".passwordPopup").classList.remove("hide");
        return false;
    } 
    else {
        document.querySelector(".passwordPopup").classList.add("hide");
    }
  //}

  //function password2Val() {
  if (password2Input.value !== passwordInput.value) {
    document.querySelector(".password2Popup").classList.remove("hide");
    return false;
  } else {
    document.querySelector(".password2Popup").classList.add("hide");
  }
  //}
  return true;
}


  