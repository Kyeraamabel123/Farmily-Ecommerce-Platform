
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorMsg = document.getElementById('error-msg');
    const loginButton = document.getElementById('loginButton');

    // Clearing previous error messages
    errorMsg.textContent = '';

    // This is Basic validation
    if (!email || !email.includes('@')) {
        errorMsg.textContent = 'Please enter a valid email.';
        return;
    }

    if (password.length < 6) {
        errorMsg.textContent = 'Password must be at least 6 characters.';
        return;
    }

    // Showing loading state
    loginButton.textContent = 'Logging in...';
    loginButton.disabled = true;

    // Sending AJAX request
    const formData = new FormData(this);
    fetch('controllers/login_customer_controller.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Redirecting to index page
            window.location.href = data.redirect;
        } else {
            // Displaying error message
            errorMsg.textContent = data.message;
            loginButton.textContent = 'Login';
            loginButton.disabled = false;
        }
    })
    .catch(error => {
        errorMsg.textContent = 'An error occurred. Please try again.';
        loginButton.textContent = 'Login';
        loginButton.disabled = false;
    });
});
