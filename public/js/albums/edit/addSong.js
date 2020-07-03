function setAlbumToForm(button) {
    $('#albumHideAddSong').val(button.data('album'));
}

/**
 * Generate the sekects with the albums artists
 * @param {*} button with data
 */
function addSelectSongs(button) {
    var url = '/albums/' + button.data('album') + '/artists';
    $.get(url, function(data) {
        var artistsDiv = $('#artists');

        artistsDiv.append(' <select name="artists[]" class="form-control my-2"></select>')

        $.each(data, function(key, value) {
            $('#artists select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');

        });
    });
}

/**
 * Delete the last select inserted
 */
function removeSelectSongs() {
    $('#artists select:last-child').remove();
}

function onBackFromController() {
    $('#modalAddSongEditAlbum').modal('show');

    $('#modalAddSongEditAlbum').on('hidden.bs.modal', function() {
        $('#addSongModalAlert').addClass('d-none');

    });
}