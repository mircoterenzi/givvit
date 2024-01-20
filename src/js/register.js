document.getElementById("signin-form").addEventListener("submit", function (event) {
    event.preventDefault()
    signin()
    event.target.reset()
});

//TODO img e descr optional

function signin() {

    //form data for user post req
    const formDataUser = new FormData()
    formDataUser.append('email', document.getElementById("email").value)
    formDataUser.append('name', document.getElementById("name").value)
    formDataUser.append('surname', document.getElementById("surname").value)
    formDataUser.append('username', document.getElementById("username").value)
    formDataUser.append('password', document.getElementById("password").value)
    formDataUser.append('desc', document.getElementById("desc").value)


    //const formDataImage = new FormData();
    //formDataImage.append("image", document.getElementById("profile-img").files[0]);

    axios.post('./api/register.php', formDataUser).then(response => {
        if (response.data["signinDone"]) {
            document.getElementById("result").innerText = "Login done !!"
            setTimeout(() => document.location.href = "", 2000);
        } else {
            document.getElementById("result").innerText = response.data["errorSignin"]
        }
    });

    /*make post req to upload image, if ok send post req to signin endpoint
    axios.post('../api/uploadImage.php', formDataImage).then(responseUpload => {
        if (!responseUpload.data["uploadDone"]) {
            document.querySelector("#signin-form > p").innerText = responseUpload.data["errorInUpload"]
        } else {
            formDataUser.append('image', responseUpload.data["fileName"])
            axios.post('../api/register.php', formDataUser).then(responseSignin => {
                if (responseSignin.data["signinDone"]) {
                    document.querySelector("#signin-form > p").innerText = "Registrazione eseguita con successo!"
                    setTimeout(() => document.location.href = "../index.php", 2000);
                } 
            });
        }
    });*/
    
}