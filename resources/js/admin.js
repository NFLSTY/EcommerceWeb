// Display flash messages with SweetAlert2 on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check for success flash message
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        const message = successAlert.textContent.trim();
        Swal.fire({
            title: "Success!",
            text: message,
            icon: "success",
            timer: 3000,
            showConfirmButton: false,
            background: '#ffffff',
            color: '#000000'
        });
        successAlert.remove(); // Remove the flash message element
    }

    // Check for error flash message
    const errorAlert = document.querySelector('.alert-danger');
    if (errorAlert) {
        const message = errorAlert.textContent.trim();
        Swal.fire({
            title: "Error!",
            text: message,
            icon: "error",
            background: '#ffffff',
            color: '#000000'
        });
        errorAlert.remove(); // Remove the flash message element
    }
});

// Delete confirmation for products and categories
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        const deleteBtn = e.target.closest('.delete-btn');
        if (!deleteBtn) return;
        
        e.preventDefault();
        
        const itemName = deleteBtn.dataset.productName || deleteBtn.dataset.categoryName || 'this item';
        const formId = deleteBtn.dataset.formId;
        
        if (typeof Swal === 'undefined') {
            // Fallback to native confirm
            if (confirm(`Are you sure you want to delete "${itemName}"?`)) {
                document.getElementById(formId)?.submit();
            }
            return;
        }
        
        Swal.fire({
            title: "Are you sure?",
            text: `You won't be able to revert this! This will delete "${itemName}".`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            background: '#ffffff',
            color: '#000000'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                if (form) {
                    // Submit form immediately - success notification will be shown after redirect
                    form.submit();
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Form not found. Please try again.",
                        icon: "error",
                        background: '#ffffff',
                        color: '#000000'
                    });
                }
            }
        });
    });
});