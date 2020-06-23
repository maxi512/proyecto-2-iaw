function deleteArtist(button) {
    $('#artistHideDelete').val(button.data('id'))
    $('#artistName').html(button.data('name'))
    $('#formDeleteArtist').attr('action', '/artists/delete/'.concat(button.data('id')))
}

function onBackFromControllerDelete() {
    $('deleteModal').modal('show');
    $('#deleteButton').addClass('d-none');

    $('#deleteModal').on('hidden.bs.modal', function() {
        $('#modalAlertDeleteArtist').addClass('d-none');
        $('#deleteButton').removeClass('d-none');
    });
}