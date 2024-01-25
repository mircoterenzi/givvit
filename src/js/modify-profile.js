document.getElementById("edit-profile-form").addEventListener("submit", function (event) {
    event.preventDefault()
    editprof()
    event.target.reset()
});

async function addtodb(formDataUser) {
    try {
        await axios.post('./api/edit-profile.php', formDataUser);
        setTimeout(() => location.reload(), 1000);
    } catch (error) {
        console.error('Error adding to the database:', error);
    }
}

function editprof() {
    //form data for user post req
    const formDataUser = new FormData()
    formDataUser.append('name', document.getElementById("name").value)
    formDataUser.append('surname', document.getElementById("surname").value)
    formDataUser.append('username', document.getElementById("username").value)
    formDataUser.append('desc', document.getElementById("desc").value)
    addtodb(formDataUser);


    /*const fileInput  = document.getElementById("profile-img");

    if(fileInput.files.length > 0){ 
        const formDataImage = new FormData();
        formDataImage.append("image", fileInput.files[0]);
        axios.post('./api/uploadImage.php', formDataImage).then(responseUpload => {
            if (!responseUpload.data["uploadDone"]) {
                document.querySelector("#signin-form > p").innerText = responseUpload.data["errorInUpload"]
            } else {
                formDataUser.append('image', responseUpload.data["fileName"])
                addtodb(formDataUser);
            }
        });
    }else{
        addtodb(formDataUser);
    }*/
}