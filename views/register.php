<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form method="post" action="/account/create">
        <label for="inputEmail">Email:</label>
        <input type="text" name="email" id="inputEmail">

        <label for="inputPassword">Password:</label>
        <input type="password" name="password" id="inputPassword">

        <label for="inputRepeatPassword">Repeat Password:</label>
        <input type="password" name="repeatedPassword" id="inputRepeatedPassword">

        <input type="submit" value="Submit">
    </form>

</body>

</html>