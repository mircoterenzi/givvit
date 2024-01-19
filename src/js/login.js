
document.querySelector("#login-form").addEventListener("submit", function (event) {
    event.preventDefault()
    login()
    event.target.reset()
});

function login() {
    const formData = new FormData()
    formData.append('username', document.querySelector("#username").value)
    formData.append('password', document.querySelector("#password").value)
    axios.post('./api/login.php', formData).then(response => {
        if (response.data["logineseguito"]) {
            document.querySelector("#login-form > p").innerText = "Login done !!"
            setTimeout(() => document.location.href = "", 2000);
        } else {
            document.querySelector("#login-form > p").innerText = response.data["loginError"]
        }
    });
}