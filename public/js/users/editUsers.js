/**
 * Set values in form
 * @param {*} button with data 
 */
function setElementsToFormEditUser(button) {
    $('#userNameEdit').val(button.data('name'))
    $('#userIdEdit').val(button.data('id'))
    $('#selectEditUser').val(button.data('role'))
}

/**
 * Shows an alert in modal and then removes it
 */
function onBackFromControllerUsers() {
    $('#editUserModal').modal('show');
    $('#formEditUser').addClass('d-none');
    $('#editButton').addClass('d-none');

    $('#editUserModal').on('hidden.bs.modal', function() {
        $('#modalAlertEditUser').addClass('d-none');
        $('#formEditUser').removeClass('d-none');
        $('#editButton').removeClass('d-none');
    });
}