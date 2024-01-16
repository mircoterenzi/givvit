<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">        <title>Givvit: Login</title>
    </head>
    <body class="bg-primary-subtle">
        <div class="container mt-5 p-5 shadow-lg rounded-5 bg-white">
            <header>
                <h1>Register</h1>
            </header>
            <form action="#" method="POST">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required/>
                    </li>
                    <li class="list-group-item">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required/>
                    </li>
                    <li class="list-group-item">
                        <label for="surname">Surname:</label>
                        <input type="text" id="surname" name="surname" required/>
                    </li>
                    <li class="list-group-item">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required/>
                    </li>
                    <li class="list-group-item">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required/>
                    </li>
                    <li class="list-group-item">
                        <label for="profile-img">Profile image:</label>
                        <input type="file" id="profile-img" name="profile-img"/>
                    </li>
                    <li class="list-group-item">
                        <label for="desc">Profile description</label>
                        <input type="textarea" id="desc" name="desc"/>
                    </li>
                </ul>
                <label for="register" hidden>Register</label>
                <input class="btn btn-primary" type="submit" id="register" name="register" value="Register"/>
                <p>Already a member? <a class="text-decoration-none" href="login.php">Sign in</a></p>
            </form>
        </div>
    </body>
</html>
