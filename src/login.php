<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Givvit: Login</title>
    </head>
    <body class="d-flex justify-content-center py-4 bg-primary-subtle">
        <main class="mw-75 m-3 p-5 shadow-lg rounded-5 bg-white">
            <form action="#" method="POST">
                <h1 class="h3 mb-3 fw-normal">Login</h1>
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required/>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required/>
                </div>
                <label for="login" hidden>Login</label>
                <input class="btn btn-primary w-100 mt-3 mb-2" type="submit" id="login" name="login" value="Login"/>
                <p>Don't have an account?  <a class="text-decoration-none" href="register.php">Sign up</a></p>
            </form>
        </main>
    </body>
</html>
