document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.querySelector("form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    loginForm.addEventListener("submit", function(event) {
        if (usernameInput.value.trim() === "" || passwordInput.value.trim() === "") {
            alert("Username dan password harus diisi!");
            event.preventDefault();
        }
    });
});
