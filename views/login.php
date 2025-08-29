<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form id="loginForm" method="post" action="/account/login">
    <label for="inputEmail">Email:</label>
    <input type="text" name="email" id="inputEmail">

    <label for="inputPassword">Password:</label>
    <input type="password" name="password" id="inputPassword">

    <input type="submit" value="Submit">
    <div id="error_message"></div>
</form>
<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const email = document.getElementById('inputEmail').value;
    const password = document.getElementById('inputPassword').value;

    const response = await fetch('/account/login', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({email, password})
    });

    const data = await response.json();
    if (data.jwt) {
        localStorage.setItem('jwt', data.jwt);
        // Redirect:
        window.location.href = '/';
    } else {
        document.getElementById('error_message').innerHTML = `<p>Wrong credentials, try again</p>`;
    }
});
</script>
<script src="/js/functions.js"></script>
</body>
</html>