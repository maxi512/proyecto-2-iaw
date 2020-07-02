function setInfoInForm(button) {
    $('#inputNameAlbum').val(button.data('name'))
    $('#albumHide').val(button.data('album'))
    populateSelectsEditAlbum(button)
    setOnHideListenerEditAlbum()
}

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

function deleteSelect() {
    $('#artistsDivAlbum select:last-child').remove();
}

function setOnHideListenerEditAlbum() {
    $('#editAlbum').on('hide.bs.modal', function() {
        $("#artistsDivAlbum").empty();
    })
}

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