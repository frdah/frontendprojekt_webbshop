let loginForm = document.querySelector(".login-form");
let emailPop = document.querySelector(".loginEmailPopup");
let passPop = document.querySelector(".loginPasswordPopup");
let forgotPass = document.querySelector(".forgotPass");
let mainDiv = document.querySelector(".mainDiv");

forgotPass.addEventListener("click", function () {
  loginForm.classList.add("hide");
  mainDiv.innerHTML =
    "<h1 class='startpageHeading lastChanceHeading' >Glömt lösenord</h1><form class='forgot-form' method='POST'><div><label for='email'>Ange din E-post</label><input type='email' name='forgotEmail' id='login_emailInput' required></div></form>";
});
