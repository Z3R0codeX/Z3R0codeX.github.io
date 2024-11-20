
var users = [
    { username: "admin", password: "123", role: "admin" },
    { username: "user", password: "456", role: "user" }, 
];

document.getElementById("login-btn").addEventListener("click", function () {
    var userr = document.getElementById("user").value.trim();
    var password = document.getElementById("pass").value.trim();

    
    var loggedInUser = users.find(
        (user) => user.username === userr && user.password === password
    );

    if (loggedInUser) {
        if (loggedInUser.role === "admin") {
            window.location.href = "./dashboard.html";
        } else if (loggedInUser.role === "user") {
            window.location.href = "./index.html";
        }
    } else {

    showModal("usuario o contaseña incorrectos");
    return;      
        
    }
    
});

function showModal(message) {
    alertBody.textContent = message;
    modal.show();
  }
