document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');
    const modal = document.getElementById('successModal');
    const imageInput = document.getElementById('images');
    const imagePreview = document.getElementById('image-preview');

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

    form.addEventListener('submit',async function(e) {
        e.preventDefault();
        resetErrors();

        const isValid = validateForm();

        if ( isValid ) {
            const formData = new FormData( form );
            const response = await fetch( '../core/add-product.php', {
                method: 'POST',
                body: formData
            } );
            const data = await response.json();
            if ( data.success ) {
                modal.style.display = 'flex';
            } else {
                showError('general-error', 'Please validate your inputs or Please try again later.')
            }
        }
    });

    document.getElementById('addAnother').addEventListener('click', function() {
        modal.style.display = 'none';
        form.reset();
        imagePreview.innerHTML = '';
    });

    document.getElementById('backToDashboard').addEventListener('click', function() {
        window.location.href = 'seller-home.php';
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    function validateForm() {
        let isValid = true;

        if (!form.title.value.trim()) {
            showError('title-error', 'Title is required');
            isValid = false;
        }

        const price = parseFloat(form.price.value);
        if (isNaN(price) || price <= 0) {
            showError('price-error', 'Enter a valid price');
            isValid = false;
        }

        if (!form.category.value) {
            showError('category-error', 'Select a category');
            isValid = false;
        }

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
} );
