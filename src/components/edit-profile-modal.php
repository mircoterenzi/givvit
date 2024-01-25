<div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Edit profile</h1>
                <button type="button" onclick="reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="edit-profile-form">
                    <div>
                        <label for="name">Name*</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $profile["first_name"] ?>" required/>
                    </div>
                    <div>
                        <label for="surname">Surname*</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $profile["last_name"] ?>" required/>
                    </div>
                    <div>
                        <label for="username">Username*</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $profile["username"] ?>" rrequired/>
                    </div>
                    <div>
                        <label for="desc">Profile description</label>
                        <textarea class="form-control" id="desc" name="desc" value="<?php echo $profile["description"] ?>"></textarea>
                    </div>
                    <label for="submit" hidden>Register</label>
                    <input class="btn w-100 mt-3 mb-2" type="submit" id="submit" name="register" value="Update your profile"/>
                </form>
            </div>
        </div>
    </div>
</div>