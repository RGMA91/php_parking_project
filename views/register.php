<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form method="post" action="/account/create">
        <label for="inputName">Name:</label>
        <input type="text" name="name" id="inputName">

        <label for="inputSurname">Surname:</label>
        <input type="text" name="surname" id="inputSurname">

        <label for="inputPhone">Phone:</label>
        <input type="text" name="phone" id="inputPhone">

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