
document.querySelector('form').onsubmit = function(event) {
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        event.preventDefault();
    }
};


document.querySelector('form').onsubmit = function(event) {
    const usernameOrEmail = document.querySelector('input[name="username_or_email"]').value;
    const password = document.querySelector('input[name="password"]').value;

    if (!usernameOrEmail || !password) {
        alert("Please fill in all fields.");
        event.preventDefault();
    }
};
