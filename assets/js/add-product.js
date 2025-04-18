document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');
    const modal = document.getElementById('successModal');
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('image-preview');

    // Image preview handling
    imageInput.addEventListener('change', function() {
        imagePreview.innerHTML = '';
        const files = this.files;

        if (files.length > 5) {
            showError('images-error', 'Maximum 5 images allowed');
            this.value = '';
            return;
        } else {
            hideError('images-error');
        }

        for (let file of files) {
            if (!file.type.startsWith('image/')) continue;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        resetErrors();

        // Validate form
        const isValid = validateForm();

        if (isValid) {
            // In real app, submit to server here
            modal.style.display = 'flex';
        }
    });

    // Modal buttons
    document.getElementById('addAnother').addEventListener('click', function() {
        modal.style.display = 'none';
        form.reset();
        imagePreview.innerHTML = '';
    });

    document.getElementById('backToDashboard').addEventListener('click', function() {
        // In real app, redirect to dashboard
        console.log('Redirect to dashboard');
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Validation functions
    function validateForm() {
        let isValid = true;

        // Title validation
        if (!form.title.value.trim()) {
            showError('title-error', 'Title is required');
            isValid = false;
        }

        // Price validation
        const price = parseFloat(form.price.value);
        if (isNaN(price) || price <= 0) {
            showError('price-error', 'Enter a valid price');
            isValid = false;
        }

        // Category validation
        if (!form.category.value) {
            showError('category-error', 'Select a category');
            isValid = false;
        }

        // Condition validation
        if (!form.condition.value) {
            showError('condition-error', 'Select condition');
            isValid = false;
        }

        // Images validation
        if (imageInput.files.length === 0) {
            showError('images-error', 'Upload at least one image');
            isValid = false;
        }

        return isValid;
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
        document.querySelectorAll('.error').forEach(el => {
            el.style.display = 'none';
        });
    }
});