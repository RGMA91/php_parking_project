async function checkJwt() {
  const jwt = localStorage.getItem('jwt');
  if (!jwt) {
    showGuestMenu();
    return;
  }
  const response = await fetch('/jwtvalidation', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ jwt })
  });
  const data = await response.json();
  if (data.valid) {
    showUserMenu();
  } else {
    showGuestMenu();
  }
}

function showUserMenu() {
  document.getElementById('menu').innerHTML = `
    <ul>
      <li><a href="/resource/booking">Book parking space</a></li>
      <li><a href="#" onclick="logout()">Logout</a></li>
    </ul>
    `;
}

function showGuestMenu() {
  document.getElementById('menu').innerHTML = `
    <ul>
      <li><a href="/resource/login">Login</a></li>
      <li><a href="/resource/register">Register</a></li>
    </ul>
    `;
}

function logout() {
  localStorage.removeItem('jwt');
  showGuestMenu();
}

checkJwt();