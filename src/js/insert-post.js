document.addEventListener("DOMContentLoaded", function () {
    const insertPostForm = document.getElementById("insert-post");

    insertPostForm.addEventListener("submit", function (event) {
        event.preventDefault();
        saveFormData();
    });

    async function saveFormData() {
        try {
            const formDataUser = new FormData()
            formDataUser.append('title', document.getElementById("title").value)
            formDataUser.append('theme', document.getElementById("theme").value) 
            formDataUser.append('amount', document.getElementById("amount").value)
            formDataUser.append('shortDesc', document.getElementById("shortDesc").value)
            formDataUser.append('fullDesc', document.getElementById("fullDesc").value)

            const response = await axios.post('./api/insert-post.php', formDataUser);
            
            if (response.data["insertDone"]) {
                document.getElementById("result").innerText = "Insert done !!";
                const postId = response.data["PostId"];
                await handleImageUpload(postId);
            } else {
                document.getElementById("result").innerText = response.data.errorInsert;
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById("result").innerText = 'An error occurred while saving the post.';
        }
    }

    async function handleImageUpload(postId) {
        const fileInput = document.getElementById("img");

        if (fileInput.files.length > 0) {
            const uploadPromises = [];

            for (let i = 0; i < fileInput.files.length; i++) {
                const formDataImage = new FormData();
                formDataImage.append("image", fileInput.files[i]);

                const uploadPromise = axios.post('./api/uploadImage.php', formDataImage)
                    .then(responseUpload => {
                        if (!responseUpload.data.uploadDone) {
                            throw new Error(responseUpload.data.errorInUpload);
                        }
                        return responseUpload.data.fileName; // Return the file name
                    });

                uploadPromises.push(uploadPromise);
            }

            try {
                const fileNames = await Promise.all(uploadPromises);
                console.log('File Names:', fileNames);
                for(let i = 0; i < fileNames.length; i++){
                    const formDataFile = new FormData();
                    formDataFile.append("postId",postId);
                    formDataFile.append("fileName",fileNames[i]);
                    const result = await axios.post('./api/addImgtoFile.php', formDataFile);
                }
            } catch (error) {
                console.error('Error during image upload:', error);
                document.getElementById("result").innerText = 'An error occurred during image upload.';
            }
        }
        setTimeout(() => document.location.reload(), 100);
    }
});
