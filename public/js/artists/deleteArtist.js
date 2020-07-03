/**
 * Set values in form
 * @param {*} button with data
 */
function deleteArtist(button) {
    $('#artistHideDelete').val(button.data('id'))
    $('#artistName').html(button.data('name'))
    $('#formDeleteArtist').attr('action', '/artists/delete/'.concat(button.data('id')))
}

/**
 * Shows an alert in form and then removes it
 */
function onBackFromControllerDelete() {
    $('deleteModal').modal('show');
    $('#deleteButton').addClass('d-none');

    $('#deleteModal').on('hidden.bs.modal', function() {
        $('#modalAlertDeleteArtist').addClass('d-none');
        $('#deleteButton').removeClass('d-none');
    });
}