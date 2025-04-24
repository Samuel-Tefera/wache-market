document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const profileImageInput = document.getElementById('profileImage');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        resetErrors();

        const isValid = validateForm();

        if (isValid) {
            const formData = new FormData( form );
            const response = await fetch( '../../core/signup.php', {
                method: 'POST',
                body: formData
            } );
            const data = await response.json();
            console.log(data);

            if (!data.success) {
                if ( data.message.includes( 'Email' ) ) {
                    showError('email-error', 'Email is already registered!');
                } else {
                    alert('Something went wrong. Please try again later.')
                }
            } else {
                if ( data.mode === 'buyer' ) {
                    window.location.href = 'buyer-home.php';
                }
                else {
                    window.location.href = 'seller-home.php';
                }
                form.reset();
            }
        }
    });

    function validateForm() {
        let isValid = true;

        const firstName = document.getElementById('firstName').value.trim();
        if (!firstName) {
            showError('firstName-error', 'First name is required');
            isValid = false;
        } else if (firstName.length > 50) {
            showError('firstName-error', 'First name must be 50 characters or less');
            isValid = false;
        }

        const lastName = document.getElementById('lastName').value.trim();
        if (!lastName) {
            showError('lastName-error', 'Last name is required');
            isValid = false;
        } else if (lastName.length > 50) {
            showError('lastName-error', 'Last name must be 50 characters or less');
            isValid = false;
        }

        const email = document.getElementById('email').value.trim();
        if (!email) {
            showError('email-error', 'Email is required');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError('email-error', 'Please enter a valid email');
            isValid = false;
        } else if (email.length > 100) {
            showError('email-error', 'Email must be 100 characters or less');
            isValid = false;
        }

        const phone = document.getElementById('phone').value.trim();
        if (phone && !isValidPhone(phone)) {
            showError('phone-error', 'Please enter a valid phone number');
            isValid = false;
        }

        const password = document.getElementById('password').value;
        if (!password) {
            showError('password-error', 'Password is required');
            isValid = false;
        } else if (password.length < 8) {
            showError('password-error', 'Password must be at least 8 characters');
            isValid = false;
        }

        const confirmPassword = document.getElementById('confirmPassword').value;
        if (!confirmPassword) {
            showError('confirmPassword-error', 'Please confirm your password');
            isValid = false;
        } else if (password !== confirmPassword) {
            showError('confirmPassword-error', 'Passwords do not match');
            isValid = false;
        }

        const profileImage = profileImageInput.files[0];
        if (profileImage && profileImage.size > 2 * 1024 * 1024) {
            showError('profileImage-error', 'Image must be less than 2MB');
            isValid = false;
        }

        return isValid;
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function isValidPhone(phone) {
        const re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
        return re.test(phone);
    }

    function showError(id, message) {
        const element = document.getElementById(id);
        element.textContent = message;
        element.style.display = 'block';
    }

    function resetErrors() {
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });
    }
} );
