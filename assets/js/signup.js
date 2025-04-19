document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signupForm');
    const profileImageInput = document.getElementById('profileImage');
    const profilePreview = document.getElementById('profilePreview');

    // Profile image preview
    profileImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (!file.type.match('image.*')) {
            showError('profileImage-error', 'Please select an image file');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            profilePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview">`;
        };
        reader.readAsDataURL(file);
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        resetErrors();

        // Validate form
        const isValid = validateForm();

        if (isValid) {
            // In a real application, you would send the form data to the server here
            alert('Account created successfully!');
            form.reset();
            profilePreview.innerHTML = '';
        }
    });

    // Validation functions
    function validateForm() {
        let isValid = true;

        // First name validation
        const firstName = document.getElementById('firstName').value.trim();
        if (!firstName) {
            showError('firstName-error', 'First name is required');
            isValid = false;
        } else if (firstName.length > 50) {
            showError('firstName-error', 'First name must be 50 characters or less');
            isValid = false;
        }

        // Last name validation
        const lastName = document.getElementById('lastName').value.trim();
        if (!lastName) {
            showError('lastName-error', 'Last name is required');
            isValid = false;
        } else if (lastName.length > 50) {
            showError('lastName-error', 'Last name must be 50 characters or less');
            isValid = false;
        }

        // Email validation
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

        // Phone validation (optional)
        const phone = document.getElementById('phone').value.trim();
        if (phone && !isValidPhone(phone)) {
            showError('phone-error', 'Please enter a valid phone number');
            isValid = false;
        }

        // Password validation
        const password = document.getElementById('password').value;
        if (!password) {
            showError('password-error', 'Password is required');
            isValid = false;
        } else if (password.length < 8) {
            showError('password-error', 'Password must be at least 8 characters');
            isValid = false;
        }

        // Confirm password validation
        const confirmPassword = document.getElementById('confirmPassword').value;
        if (!confirmPassword) {
            showError('confirmPassword-error', 'Please confirm your password');
            isValid = false;
        } else if (password !== confirmPassword) {
            showError('confirmPassword-error', 'Passwords do not match');
            isValid = false;
        }

        // Profile image validation (optional)
        const profileImage = profileImageInput.files[0];
        if (profileImage && profileImage.size > 2 * 1024 * 1024) { // 2MB limit
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

    function hideError(id) {
        document.getElementById(id).style.display = 'none';
    }

    function resetErrors() {
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });
    }
});