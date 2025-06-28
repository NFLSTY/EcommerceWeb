// Delete confirmation for products and categories
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin JS loaded');
    console.log('SweetAlert2 available:', typeof Swal !== 'undefined');
    
    // Handle delete button clicks
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
            e.preventDefault();
            console.log('Delete button clicked');
            
            const button = e.target.classList.contains('delete-btn') ? e.target : e.target.closest('.delete-btn');
            const productName = button.dataset.productName || button.dataset.categoryName || 'this item';
            const formId = button.dataset.formId;
            
            console.log('Item name:', productName);
            console.log('Form ID:', formId);
            
            if (typeof Swal !== 'undefined') {
                console.log('Showing SweetAlert2 confirmation');
                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert this! This will delete "${productName}".`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('User confirmed deletion, submitting form');
                        // Submit the form
                        const form = document.getElementById(formId);
                        if (form) {
                            form.submit();
                        } else {
                            console.error('Form not found:', formId);
                        }
                    }
                });
            } else {
                console.error("SweetAlert2 is not loaded!");
                // Fallback to native confirm
                if (confirm(`Are you sure you want to delete "${productName}"?`)) {
                    const form = document.getElementById(formId);
                    if (form) {
                        form.submit();
                    }
                }
            }
        }
    });
});

// Legacy Livewire event listeners (can be removed if not using Livewire elsewhere)
// window.addEventListener('show-delete-confirmation', event => {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!"
//     }).then((result) => {
//         if (result.isConfirmed) {
//             Livewire.emit('deleteConfirmed')
//         }
//     });
// });

// window.addEventListener('categoryDeleted', event => {
//     Swal.fire({
//         title: "Deleted!",
//         text: "Category has been deleted.",
//         icon: "success"
//     });
// });

// window.addEventListener('productDeleted', event => {
//     Swal.fire({
//         title: "Deleted!",
//         text: "Product has been deleted.",
//         icon: "success"
//     });
// });