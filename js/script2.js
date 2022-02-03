const fname = document.getElementById('name');
const email = document.getElementById('email');
const mobile = document.getElementById('mobile');
const password = document.getElementById('password');
const cpassword = document.getElementById('cpassword');
const form = document.getElementById('register-form');
const errorElement = document.querySelector('.register_msg p');


    form.addEventListener('submit', (e) => {
        let messages = [];
        if (fname.value === '' || fname.value == null) {
            messages.push('Username is required');
        }

        if (email.value === '' || email.value == null) {
            messages.push('Email is required');
        }

        if (mobile.value === '' || mobile.value == null) {
            messages.push('Mobile number is required');
        }

        if (password.value.length <= 6) {
            messages.push('Password must be longer than 6 characters');
        }

        if (password.value.length >= 20) {
            messages.push('Password must be less than 20 characters');
        }

        if (password.value === 'password') {
            messages.push('Password cannot be password');
        }

        if(password != cpassword){
            messages.push("Passwords do not match");
        }

        if (messages.length > 0) {
            e.preventDefault();
            errorElement.innerText = messages.join(', ');
        }
    });