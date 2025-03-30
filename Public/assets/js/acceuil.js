const form = document.querySelector(".contact-form");
const messageBox = document.getElementById("form-message");

form.addEventListener("submit", function () {
  messageBox.style.display = "block";
  setTimeout(() => {
    messageBox.style.display = "none";
  }, 4000);
});
