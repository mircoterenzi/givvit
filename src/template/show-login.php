<form action="#" method="POST" id="login-form">
    <div>
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required/>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required/>
    </div>
    <label for="submit" hidden>Login</label>
    <input class="btn w-100 mt-3 mb-2" type="submit" id="submit" name="login" value="Login"/>
    <p id="result"></p>
    <p>Don't have an account?  <a class="text-decoration-none" href="register.php">Sign up</a></p>
</form>