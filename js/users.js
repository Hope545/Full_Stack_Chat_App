"use strict";

// showing and hiding the search bar when the search icon is clicked
const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const userList = document.querySelector(".users .users-list");

if (searchBar) {
  searchBtn.addEventListener("click", () => {
    searchBar.classList.toggle("active");
    searchBtn.classList.toggle("active");
  });

  // working on the search bar
  searchBar.onkeyup = () => {
    let searchTerm = searchBar.value; // storing the value of the search bar in a variable
    if (searchTerm != "") {
      searchBar.classList.add("active");
    } else {
      searchBar.classList.remove("active");
    }
    // lets start ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "authentication/search.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          userList.innerHTML = data;
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm); // sending user search term to the search.php file
  };
}

setInterval(() => {
  // lets start ajax
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "authentication/user.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (searchBar) {
          if (!searchBar.classList.contains("active")) {
            userList.innerHTML = data;
          }
        }
      }
    }
  };
  xhr.send();
}, 500); // this function will keep running at an interval of 500ms
