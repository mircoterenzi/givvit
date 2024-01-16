<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Givvit: Login</title>
    </head>
    <body class="bg-primary-subtle">
        <main class="container mt-5 p-5 shadow-lg rounded-5 bg-white">
            <header>
                <h1>Login</h1>
            </header>
            <form action="#" method="POST">
                <ul class="list-group">
                    <li class="list-group-item border-0">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required/>
                    </li>
                    <li class="list-group-item border-0">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required/>
                    </li>
                </ul>
                <label for="login" hidden>Register</label>
                <input class="btn btn-primary" type="submit" id="login" name="login" value="Login"/>
                <p>Don't have an account? <a class="text-decoration-none" href="register.php">Sign up</a></p>
            </form>
        </main>
    </body>
</html>
