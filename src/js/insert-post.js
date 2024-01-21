document.getElementById("insert-post").addEventListener("submit", function (event) {
    event.preventDefault()
    insertPost()
    event.target.reset()
});

//TODO img e descr optional

function insertPost() {

    //form data for user post req
    const formDataUser = new FormData()
    formDataUser.append('title', document.getElementById("title").value)
    //formDataUser.append('name', document.getElementById("name").value) //todo theme
    formDataUser.append('amount', document.getElementById("amount").value)
    formDataUser.append('shortDesc', document.getElementById("shortDesc").value)
    formDataUser.append('fullDesc', document.getElementById("fullDesc").value)

    let postId = 0;
    axios.post('./api/insert-post.php', formDataUser).then(response => {
        console.log(response.data);
        if (response.data["insertDone"]) {
            document.getElementById("result").innerText = "Insert done !!"
            postId = response.data["PostId"];
        } else {
            document.getElementById("result").innerText = response.data["errorInsert"]
        }
        setTimeout(() => document.location.href = "", 5000);
    });

    const fileInput  = document.getElementById("img");
    if(fileInput.files.length > 0 && postId > 0){ 
        console.log("ziopera");
        for( const img of fileInput.files){
            let fileName = "error";
            let formDataImage = new FormData();
            formDataImage.append("image", img);
            axios.post('./api/uploadImage.php', formDataImage).then(responseUpload => {
                if (!responseUpload.data["uploadDone"]) {
                    document.getElementById("result").innerText = responseUpload.data["errorInImageUpload"]
                }else{
                    fileName = responseUpload.data["fileName"];
                }
            });
            let formFileName = new FormData();
            formFileName.append("fileName",fileName);
            formFileName.append("postId",postId);
            axios.post('./api/addImgtoFile.php', formDataImage).then(responsAdd => {
                if (!responsAdd.data["uploadDone"]) {
                    document.getElementById("result").innerText = responsAdd.data["errorInImageUpload"]
                }
                console.log(responsAdd.data);
            });
        }
    }
}