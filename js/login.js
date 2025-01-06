"use strict";

const loginForm = document.querySelector(".login form");
const loginBtn = document.querySelector(".login .button");
const errorMsg = document.querySelector(".login .error-text");

if (loginForm) {
  loginForm.onsubmit = (e) => {
    e.preventDefault(); // prevent the page form from submitting
  };
}

if (loginBtn) {
  loginBtn.addEventListener("click", () => {
    //let's start ajax and create an xml object
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "authentication/sign-in.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.responseText; // getting the response from the register.php file
          if (data === "Success") {
            // redirecting the user from the register page to the login page
            location.href = "http://localhost/ajaxphp/users.php";
          } else {
            //displaying error messages
            errorMsg.textContent = data;
            errorMsg.style.display = "block";
          }
        }
      }
    };

    // sending form data through ajax to php
    let formData = new FormData(loginForm); // creating new form object
    xhr.send(formData); // sending form data to php
  });
}
