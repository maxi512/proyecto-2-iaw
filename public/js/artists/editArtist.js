/**
 * Set values in form
 * @param {*} button with data
 */
function editArtist(button) {
    $('#select').val(button.data('country'))
    $('#inputName').val(button.data('name'))
    $('#artistHide').val(button.data('id'))
}

/**
 * Shows an alert in modal and then removes it
 */
function onBackFromControllerEdit() {
    $('#editModal').modal('show');
    $('#formEditArtist').addClass('d-none');
    $('#editButton').addClass('d-none');
    $('#modalAlertEditArtist').removeClass('d-none');

    $('#editModal').on('hidden.bs.modal', function() {
        $('#modalAlertEditArtist').removeClass('d-none');
        $('#formEditArtist').removeClass('d-none');
        $('#editButton').removeClass('d-none');
        $('#modalAlertEditArtist').addClass('d-none');
    });
}