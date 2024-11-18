const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const brandId = this.getAttribute('data-id');
            const brandName = this.getAttribute('data-name');
            const brandDescription = this.getAttribute('data-description');
            
            // Setting the values in the modal inputs
            document.getElementById('editBrandId').value = brandId;
            document.getElementById('editBrandName').value = brandName;
            document.getElementById('editBrandDescription').value = brandDescription;
            
            // Showing the modal
            const editBrandModal = new bootstrap.Modal(document.getElementById('editBrandModal'));
            editBrandModal.show();
        });
    });