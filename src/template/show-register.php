<head>
<script src="js/register.js" defer></script>
</head>
<form action="#" method="POST" id="signin-form">
    <div>
        <label for="email">Email*</label>
        <input type="email" class="form-control" id="email" name="email"  required/>
    </div>
    <div>
        <label for="name">Name*</label>
        <input type="text" class="form-control" id="name" name="name" required/>
    </div>
    <div>
        <label for="surname">Surname*</label>
        <input type="text" class="form-control" id="surname" name="surname" required/>
    </div>
    <div>
        <label for="username">Username*</label>
        <input type="text" class="form-control" id="username" name="username" required/>
    </div>
    <div>
        <label for="password">Password*</label>
        <input type="password" class="form-control" id="password" name="password" required/>
    </div>
    <div>
        <label for="profile-img">Profile image</label>
        <input type="file" class="form-control" id="profile-img" name="profile-img"/>
    </div>
    <div>
        <label for="desc">Profile description</label>
        <textarea class="form-control" id="desc" name="desc" height="200%"></textarea>
    </div>
    <label for="submit" hidden>Register</label>
    <input class="btn btn-primary w-100 mt-3 mb-2" type="submit" id="submit" name="register" value="Register"/>
    <p>Already member? <a class="text-decoration-none" href="index.php">Sign in</a></p>
</form>
