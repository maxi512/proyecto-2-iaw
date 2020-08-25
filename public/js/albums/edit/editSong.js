/**
 * Set values in form
 * @param {*} button with data
 */
function setElementsFromButton(button) {
    $('#songId').val(button.data('id'))
    $('#songNameEdit').val(button.data('name'))
    $('#albumId').val(button.data('album'))
    $('#youtubeLinkEdit').val(button.data('link'))
    $('#durationEdit').val(button.data('duration'))
    populateSelectsArtists(button)
}

/**
 * Create Selects with artists in modal
 * @param {*} button 
 */
function populateSelectsArtists(button) {
    var urlArtistsAlbum = '/albums/' + button.data('album') + '/artists';
    var urlArtistsSong = '/songs/' + button.data('id') + '/artists';
    var data;
    $.get(urlArtistsAlbum, function(dataAllArtists) {
        data = dataAllArtists;
        createSelectArtistsEditSong(data, urlArtistsSong);
    });

}

function createSelectArtistsEditSong(data, urlArtistsSong) {
    $.get(urlArtistsSong, function(artistsSong) {
        $.each(artistsSong, function(keyArtist, valueArtist) {
            $('#artistsDivSong').append('<select name="artists[]" class="form-control my-1"></select>')
            $.each(data, function(key, value) {
                $('#artistsDivSong select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
            $('#artistsDivSong select:last-child').val(valueArtist.id);
        });
    });
}

/**
 * Add a single select with albums artists
 * @param {*} button with data
 */
function onClickAddArtistOnSongButton(button) {
    var url = '/albums/' + button.data('album') + '/artists';
    $.get(url, function(data) {
        var artistsDiv = $('#artistsDivSong');

        artistsDiv.append(' <select name="artists[]" class="form-control my-1"></select>')

        $.each(data, function(key, value) {
            $('#artistsDivSong select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
        });
    });
}

/**
 * Remove last select in modal
 */
function deleteSelectSong() {
    $('#artistsDivSong select:last-child').remove();
}

/**
 * Delete all selects on hide modal
 */
function setOnHideListenerEditSong() {
    $('#editSongAlbumModal').on('hide.bs.modal', function() {
        $("#artistsDivSong").empty();
    })
}

/**
 * Shows an alert in modal and then deletes it
 */
function setListenersOnBackFromController() {
    $('#editSongAlbumModal').modal('show');
    $('#formEditSongAlbum').addClass('d-none');
    $('#editButton').addClass('d-none');

    $('#editSongAlbumModal').on('hidden.bs.modal', function() {
        $('#modalAlertEditSong').addClass('d-none');
        $('#formEditSongAlbum').removeClass('d-none');
        $('#editButton').removeClass('d-none');
    });
}