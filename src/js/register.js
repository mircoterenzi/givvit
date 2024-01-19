
document.querySelector("#signin-form").addEventListener("submit", function (event) {
    event.preventDefault()
    signin()
    event.target.reset()
});

function signin() {

    //form data for user post req
    const formDataUser = new FormData()
    formDataUser.append('email', document.querySelector("#email").value)
    formDataUser.append('name', document.querySelector("#name").value)
    formDataUser.append('surname', document.querySelector("#surname").value)
    formDataUser.append('username', document.querySelector("#username").value)
    formDataUser.append('password', document.querySelector("#password").value)
    formDataUser.append('desc', document.querySelector("#desc").value)


    const formDataImage = new FormData();
    formDataImage.append("image", document.querySelector("#profile-img").files[0]);

    //make post req to upload image, if ok send post req to signin endpoint
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
    });
    
}