document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const successModal = document.getElementById('successModal');
    const continueBtn = document.getElementById('continueBtn');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form values
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        // Reset error messages
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });

        let isValid = true;

        // Email validation
        if (!email) {
            showError('email-error', 'Email is required');
            isValid = false;
        } else if (!validateEmail(email)) {
            showError('email-error', 'Please enter a valid email');
            isValid = false;
        }

        // Password validation
        if (!password) {
            showError('password-error', 'Password is required');
            isValid = false;
        } else if (password.length < 8) {
            showError('password-error', 'Password must be at least 8 characters');
            isValid = false;
        }

        if (isValid) {
            // In a real app, you would send the data to your server here
            // For demo purposes, we'll just show the success modal
            successModal.style.display = 'flex';
        }
    });

    continueBtn.addEventListener('click', function() {
        // In a real app, this would redirect to the dashboard
        console.log('Redirecting to dashboard...');
        successModal.style.display = 'none';
    });

    // Close modal when clicking outside
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
});