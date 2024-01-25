<div class="modal fade" id="new-post-modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="AddNewPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="AddNewPost">Add a new post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id = "insert-post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="title">Title*</label>
                        <input type="text" class="form-control" id="title" name="title" required/>
                    </div>
                    <div class="mb-2">
                        <label for="theme">Theme*</label>
                        <select id ="theme" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <?php foreach($templateParams["topics-list"] as $topic): ?>
                            <option id="<?php echo $topic["name"] ?>" value="<?php echo $topic["name"] ?>"><?php echo($topic["name"]) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="amount" >Amount required*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="amount" name="amount" required/>
                            <div class="input-group-text">€</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="shortDesc" >Short description</label>
                        <textarea class="form-control" id="shortDesc" name="shortDesc"></textarea>
                        <div id="shortDescHelp" class="form-text">This description is used when your post is showed on the homepage or the explore page</div>
                    </div>
                    <div class="mb-2">
                        <label for="fullDesc" >Full description*</label>
                        <textarea class="form-control" id="fullDesc" name="fullDesc" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="img">Profile image</label>
                        <input type="file" class="form-control" id="img" name="img" multiple/>
                    </div>
                    <p id ="result"></p>
                    <label for="login" hidden>Post it!</label>
                    <input class="btn w-100 my-2" type="submit" id="login" name="post" value="Post it!"/>
                </form>
            </div>
        </div>
    </div>
</div>