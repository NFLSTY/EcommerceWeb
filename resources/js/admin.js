// Optimized delete confirmation for products and categories
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
            // Force light theme to avoid dark mode conflicts
            background: '#ffffff',
            color: '#000000'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                if (form) {
                    // Show success message first, then submit form
                    Swal.fire({
                        title: "Deleted!",
                        text: `"${itemName}" has been deleted successfully.`,
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false,
                        // Force light theme to prevent animation bugs
                        background: '#ffffff',
                        color: '#000000'
                    }).then(() => {
                        form.submit();
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Form not found. Please try again.",
                        icon: "error"
                    });
                }
            }
        });
    });
});