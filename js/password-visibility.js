"use strict";

// getting the input field for the password
const passwordField = document.querySelector(
  ".form .field input[type='password']"
);
// getting the password visibility icon
const passwordIcon = document.querySelector(".form .field i");

if (passwordIcon) {
  passwordIcon.addEventListener("click", () => {
    if (passwordField.type == "password") {
      passwordField.type = "text";
      passwordIcon.classList.add("active");
    } else {
      passwordField.type = "password";
      passwordIcon.classList.remove("active");
    }
  });
}
