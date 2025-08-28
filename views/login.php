<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form method="post" action="/account/authenticate">
    <label for="inputEmail">Email:</label>
    <input type="text" name="email" id="inputEmail">

    <label for="inputEmail">Password:</label>
    <input type="password" name="password" id="inputPassword">

    <input type="submit" value="Submit">
</form>
</body>
</html>