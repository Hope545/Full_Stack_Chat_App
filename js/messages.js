"use strict";

const typingArea = document.querySelector("form .typing-area input");
const sendMsgBtn = document.querySelector("form .typing-area button");
const messageForm = document.querySelector(".chat-area form");
const chatBox = document.querySelector(".chat-box");

if (messageForm) {
  messageForm.onsubmit = (e) => {
    e.preventDefault(); // prevent the form from submitting
  };
}

if (sendMsgBtn) {
  sendMsgBtn.addEventListener("click", () => {
    // starting ajax
    let xhr = new XMLHttpRequest(); // creating a new xml object
    xhr.open("POST", "authentication/messages.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          console.log(data);
          typingArea.value = "";
          scrollToBottom();
        }
      }
    };

    // creating a form object
    let formData = new FormData(messageForm);
    xhr.send(formData); // sending form data to messages.php file
  });
}

// displaying messages dynamically
setInterval(() => {
  // starting ajax
  let xhr = new XMLHttpRequest(); // creating a new xml object
  xhr.open("POST", "authentication/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (chatBox) {
          chatBox.innerHTML = data;
          if (!chatBox.classList.contains("active")) {
            scrollToBottom();
          }
        }
      }
    }
  };

  xhr.send();
}, 500);

// scrolling messages automatically to the bottom
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

chatBox.addEventListener("mouseenter", () => {
  chatBox.classList.add("active");
});
chatBox.addEventListener("mouseleave", () => {
  chatBox.classList.remove("active");
});
