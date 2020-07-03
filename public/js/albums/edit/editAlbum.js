/**
 * Set Values in form
 * @param {*} button with data
 */
function setInfoInForm(button) {
    $('#inputNameAlbum').val(button.data('name'))
    $('#albumHide').val(button.data('album'))
    populateSelectsEditAlbum(button)
    setOnHideListenerEditAlbum()
}

/**
 * Create selects in Modal
 * @param {*} button with data
 */
function populateSelectsEditAlbum(button) {
    var urlArtists = '/albums/' + button.data('album') + '/artists';
    var urlAllArtists = '/artists/all'
    var data;

    $.get(urlAllArtists, function(dataAllArtists) {
        data = dataAllArtists
        createSelectArtistsEditAlbum(data, urlArtists);
    });
}

function createSelectArtistsEditAlbum(data, urlArtists) {
    $.get(urlArtists, function(artistsSong) {
        $.each(artistsSong, function(keyArtist, valueArtist) {
            $('#artistsDivAlbum').append('<select name="artists[]" class="form-control my-1"></select>')
            $.each(data, function(key, value) {
                $('#artistsDivAlbum select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
            $('#artistsDivAlbum select:last-child').val(valueArtist.id);
        });
    });
}

/**
 * Create Selects with all artists in modal
 */
function onClickAddArtistButton() {
    var url = '/artists/all';
    $.get(url, function(data) {
        var artistsDiv = $('#artistsDivAlbum');

        artistsDiv.append(' <select name="artists[]" class="form-control my-1"></select>')

        $.each(data, function(key, value) {
            $('#artistsDivAlbum select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
        });
    });
}

/**
 * Remove last select in modal 
 */
function deleteSelect() {
    $('#artistsDivAlbum select:last-child').remove();
}

/**
 * Delete all selects in modal
 */
function setOnHideListenerEditAlbum() {
    $('#editAlbum').on('hide.bs.modal', function() {
        $("#artistsDivAlbum").empty();
    })
}

/**
 * Show alert and then removes it
 */
function setListenersOnBackFromControllerEditAlbum() {
    $('#editAlbum').modal('show');
    $('#formEditAlbum').addClass('d-none');
    $('#editAlbumButton').addClass('d-none');

    $('#editAlbum').on('hidden.bs.modal', function() {
        $('#modalAlertEditAlbum').addClass('d-none');
        $('#formEditAlbum').removeClass('d-none');
        $('#editAlbumButton').removeClass('d-none');
    });
}