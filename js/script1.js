const username = document.getElementById('username');
const password = document.getElementById('password');
const form = document.getElementById('login-form');
const errorElement = document.querySelector('.formerror');

form.addEventListener('submit', (e) => {
    let messages = [];
    if (username.value === '' || username.value == null) {
        messages.push('*Username is required');
    }

    if (password.value.length <= 6) {
        messages.push('*Password must be longer than 6 characters');
    }

    if (password.value.length >= 20) {
        messages.push('*Password must be less than 20 characters');
    }

    if (password.value === 'password') {
        messages.push('*Password cannot be password');
    }

    if (messages.length > 0) {
        e.preventDefault();
        errorElement.innerText = messages.join(', ');
    }
});