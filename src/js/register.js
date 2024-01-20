document.getElementById("signin-form").addEventListener("submit", function (event) {
    event.preventDefault()
    signin()
    event.target.reset()
});

//TODO img e descr optional

function addtodb(formDataUser){
    
    axios.post('./api/register.php', formDataUser).then(response => {
        console.log("  :");
        console.log(response.data);
        if (response.data["signinDone"]) {
            document.getElementById("result").innerText = "Login done !!"
            setTimeout(() => document.location.href = "", 2000);
        } else {
            document.getElementById("result").innerText = response.data["errorSignin"]
        }
    });
}

function signin() {

    //form data for user post req
    const formDataUser = new FormData()
    formDataUser.append('email', document.getElementById("email").value)
    formDataUser.append('name', document.getElementById("name").value)
    formDataUser.append('surname', document.getElementById("surname").value)
    formDataUser.append('username', document.getElementById("username").value)
    formDataUser.append('password', document.getElementById("password").value)
    formDataUser.append('desc', document.getElementById("desc").value)


    const fileInput  = document.getElementById("profile-img");

    if(fileInput.files.length > 0){ 
        const formDataImage = new FormData();
        formDataImage.append("image", fileInput.files[0]);
        axios.post('./api/uploadImage.php', formDataImage).then(responseUpload => {
            console.log("iamge upload:");
            console.log(responseUpload.data);
            if (!responseUpload.data["uploadDone"]) {
                document.querySelector("#signin-form > p").innerText = responseUpload.data["errorInUpload"]
            } else {
                formDataUser.append('image', responseUpload.data["fileName"])
                addtodb(formDataUser);
            }
        });
    }else{
        addtodb(formDataUser);
    }
}