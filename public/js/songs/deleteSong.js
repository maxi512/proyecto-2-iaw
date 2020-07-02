function deleteSong(button) {
    $('#songHideDelete').val(button.data('id'))
    $('#songName').html(button.data('name'))
    $('#formDeleteSong').attr('action', '/songs/delete/'.concat(button.data('id')))
}

function onBackFromControllerDelete() {
    $('#deleteSongModal').modal('show');
    $('#deleteButton').addClass('d-none');
    $('#warningSong').addClass('d-none');

    $('#deleteSongModal').on('hidden.bs.modal', function() {
        $('#modalAlertDeleteSong').addClass('d-none');
        $('#deleteButton').removeClass('d-none');
        $('#warningSong').removeClass('d-none');
    });
}