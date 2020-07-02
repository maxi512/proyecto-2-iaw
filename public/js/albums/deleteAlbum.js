function deleteAlbum(button) {
    $('#albumHideDelete').val(button.data('id'))
    $('#albumName').html(button.data('name'))
    $('#formDeleteAlbum').attr('action', '/albums/delete/'.concat(button.data('id')))
}

function onBackFromControllerDeleteAlbum() {
    $('#deleteAlbumModal').modal('show');
    $('#deleteAlbumButton').addClass('d-none');
    $('#warningAlbum').addClass('d-none');

    $('#deleteAlbumModal').on('hidden.bs.modal', function() {
        $('#modalAlertDeleteAlbum').addClass('d-none');
        $('#deleteAlbumButton').removeClass('d-none');
        $('#warningAlbum').removeClass('d-none');
    });
}