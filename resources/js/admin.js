// delete-confirmation.js - Reusable Delete Confirmation System

/**
 * Approach 1: Simple Confirmation with Form Submission
 * Works with any delete button that has data attributes
 */
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete buttons with confirmation
    document.querySelectorAll('[data-delete-confirm]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const itemName = this.dataset.deleteItem || 'this item';
            const confirmMessage = this.dataset.deleteMessage || 
                `Are you sure you want to delete ${itemName}? This action cannot be undone.`;
            
            if (confirm(confirmMessage)) {
                // Find the associated form and submit it
                const form = this.closest('form') || document.getElementById(this.dataset.deleteForm);
                if (form) {
                    form.submit();
                }
            }
        });
    });
});

/**
 * Approach 2: Bootstrap Modal with Dynamic Content
 * More sophisticated with better UX
 */
class DeleteConfirmation {
    constructor() {
        this.init();
    }

    init() {
        // Create modal HTML if it doesn't exist
        if (!document.getElementById('deleteConfirmModal')) {
            this.createModal();
        }
        
        // Attach event listeners
        this.attachEventListeners();
    }

    createModal() {
        const modalHTML = `
            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="delete-message">Are you sure you want to delete this item?</p>
                            <div class="alert alert-warning">
                                <strong>Warning:</strong> This action cannot be undone.
                            </div>
                            <div class="delete-details"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    attachEventListeners() {
        // Handle delete buttons with modal
        document.querySelectorAll('[data-delete-modal]').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.showModal(button);
            });
        });

        // Handle modal confirm button
        document.getElementById('confirmDeleteBtn')?.addEventListener('click', () => {
            this.executeDelete();
        });
    }

    showModal(button) {
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        
        // Get data from button
        const itemName = button.dataset.deleteItem || 'this item';
        const message = button.dataset.deleteMessage || `Are you sure you want to delete ${itemName}?`;
        const details = button.dataset.deleteDetails || '';
        
        // Update modal content
        document.querySelector('.delete-message').textContent = message;
        document.querySelector('.delete-details').innerHTML = details;
        
        // Store form reference for later submission
        const form = button.closest('form') || document.getElementById(button.dataset.deleteForm);
        document.getElementById('confirmDeleteBtn').dataset.targetForm = form?.id || '';
        
        // Show modal
        modal.show();
    }

    executeDelete() {
        const formId = document.getElementById('confirmDeleteBtn').dataset.targetForm;
        const form = document.getElementById(formId) || document.querySelector('form[data-delete-form]');
        
        if (form) {
            form.submit();
        }
        
        // Hide modal
        bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal')).hide();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new DeleteConfirmation();
});

/**
 * Approach 3: AJAX Delete (if you want to avoid page refresh)
 */
class AjaxDeleteConfirmation {
    constructor() {
        this.init();
    }

    init() {
        document.querySelectorAll('[data-ajax-delete]').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                this.handleAjaxDelete(button);
            });
        });
    }

    async handleAjaxDelete(button) {
        const itemName = button.dataset.deleteItem || 'this item';
        const url = button.dataset.deleteUrl || button.href;
        
        if (!confirm(`Are you sure you want to delete ${itemName}?`)) {
            return;
        }

        try {
            // Show loading state
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Deleting...';
            button.disabled = true;

            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            });

            if (response.ok) {
                // Success - remove the row or redirect
                const row = button.closest('tr');
                if (row) {
                    row.style.transition = 'opacity 0.3s';
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                } else {
                    // Redirect to index page
                    window.location.href = button.dataset.successUrl || '/admin/products';
                }
            } else {
                throw new Error('Delete failed');
            }
        } catch (error) {
            alert('Error deleting item. Please try again.');
            button.innerHTML = originalText;
            button.disabled = false;
        }
    }
}

// Initialize AJAX delete handler
document.addEventListener('DOMContentLoaded', () => {
    new AjaxDeleteConfirmation();
});