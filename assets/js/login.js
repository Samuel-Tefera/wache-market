document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const successModal = document.getElementById('successModal');
    const continueBtn = document.getElementById('continueBtn');

    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });

        let isValid = true;

        if (!email) {
            showError('email-error', 'Email is required');
            isValid = false;
        } else if (!validateEmail(email)) {
            showError('email-error', 'Please enter a valid email');
            isValid = false;
        }

        if (!password) {
            showError('password-error', 'Password is required');
            isValid = false;
        } else if (password.length < 8) {
            showError('password-error', 'Password must be at least 8 characters');
            isValid = false;
        }

        if ( isValid ) {
            const loginForm = new FormData( e.target );
            const response = await fetch( '../core/login.php', {
                method: 'POST',
                body: loginForm,
            } );

            const data = await response.json();

            if ( !data.success ) {
                showError( 'auth-error', 'Invalid email or password. Please try again.' )
            }
            else {
                successModal.style.display = 'flex';
                continueBtn.addEventListener( 'click', function () {
                    if ( data.mode === 'buyer' ) {
                        window.location.href = 'buyer-home.php';
                    } else {
                        window.location.href = 'seller-home.php';
                    }
                    successModal.style.display = 'none';
                } );
            }
        }
    });

    continueBtn.addEventListener( 'click', function () {

        window.location.href = ''
        successModal.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === successModal) {
            successModal.style.display = 'none';
        }
    });

    function showError(id, message) {
        const element = document.getElementById(id);
        element.textContent = message;
        element.style.display = 'block';
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
} );
