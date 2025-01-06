"use strict";

const form = document.querySelector(".signup form");
const registerBtn = document.querySelector(".signup form .button");
const error_Msg = document.querySelector(".signup form .error-text");

if (form) {
  form.onsubmit = (e) => {
    e.preventDefault(); // prevents the form from submitting
  };
}

if (registerBtn) {
  registerBtn.addEventListener("click", () => {
    //let's start ajax
    let xhr = new XMLHttpRequest(); // creating xml object
    xhr.open("POST", "authentication/register.php", true); // this takes many parameters but we pass only the method, url and async
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.responseText; // getting the response from the register.php file
          if (data === "Success") {
            // redirecting the user from the register page to the login page
            location.href = "http://localhost/ajaxphp/login.php";
          } else {
            //displaying error messages
            error_Msg.textContent = data;
            error_Msg.style.display = "block";
          }
        }
      }
    };

    // sending form data through ajax to php
    let formData = new FormData(form); // creating new form object
    xhr.send(formData); // sending form data to php
  });
}
