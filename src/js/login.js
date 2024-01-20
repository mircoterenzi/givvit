
document.getElementById("login-form").addEventListener("sumbit", function (event) {
    event.preventDefault()
    login()
    event.target.reset()
});

function login() {
    const formData = new FormData()
    formData.append('username', document.getElementById("username").value)
    formData.append('password', document.getElementById("password").value)
    axios.post('./api/login.php', formData).then(response => {
        if (response.data["loginDone"]) {
            document.getElementById("result").innerText = "Login done !!"
            setTimeout(() => document.location.href = "", 20000);
        } else {
            document.getElementById("result").innerText = response.data["loginError"]
        }
    });
}