/*// Registration form validation
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }

    alert('Registration successful!');
    // Proceed with form submission or redirect to the dashboard
});

// Login form validation
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    if (email === 'user@example.com' && password === 'password') {
        alert('Login successful!');
        // Redirect to dashboard
    } else {
        alert('Invalid email or password.');
    }
});
*/



