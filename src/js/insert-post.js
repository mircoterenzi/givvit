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
                postId = response.data["PostId"];
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
                        // Handle success if needed
                    });

                uploadPromises.push(uploadPromise);
            }

            try {
                await Promise.all(uploadPromises);
                // Reload the page or perform other actions if needed
                setTimeout(() => document.location.reload(), 1000);
            } catch (error) {
                console.error('Error during image upload:', error);
                document.getElementById("result").innerText = 'An error occurred during image upload.';
            }
        } else {
            // No files to upload
            setTimeout(() => document.location.reload(), 1000);
        }
    }
});
