/**
 * Set values in form and create selects with artists
 * @param {*} button with data
 */
function onClickEditSongButton(button) {
    setValues(button);
    var urlArtists = '/songs/' + button.data('id') + '/artists';
    var urlAllArtists = '/artists/all'

    $.get(urlAllArtists, function(dataAllArtists) {
        data = dataAllArtists
        createSelectArtists(data, urlArtists);
    });
}

/**
 * Set values in form for edit song.
 * @param {*} button with data
 */
function setValues(button) {
    $('#songNameEdit').val(button.data('name'))
    $('#youtubeLinkEdit').val(button.data('link'))
    $('#durationEdit').val(button.data('duration'))
    $('#songId').val(button.data('id'))
}

/**
 * Create all selects artists
 * @param {*} data for all artists
 * @param {*} urlArtists url for artists in song
 */
function createSelectArtists(data, urlArtists) {
    $.get(urlArtists, function(artistsSong) {
        $.each(artistsSong, function(_, valueArtist) {
            $('#artistsDiv').append('<select name="artists[]" class="form-control my-1"></select>')
            $.each(data, function(_, value) {
                $('#artistsDiv select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
            $('#artistsDiv select:last-child').val(valueArtist.id);
        });

        setListenerToSelects()
        updateSelectAlbums()

    });
}

/**
 * Update albums select with the correct albums
 */
function updateSelectAlbums() {
    $("#albumSelect").empty();
    var values = $("#formEditSong select[name='artists[]']").map(function() { return $(this).val(); }).get();

    $.ajax({
        url: "/albums/albumsfromlist",
        type: "get",
        contentType: 'charset=UTF-8',
        data: { 'artists': values },

        success: function(result) {
            $.each(result, function(key, value) {
                $('#albumSelect').append('<option value=' + value.id + '>' + value.name + '</option>');
            })
        }
    });
}

/**
 * Set listener to artists selects
 */
function setListenerToSelects() {
    $("#formEditSong select[name='artists[]']").on('change', function() {
        updateSelectAlbums()
    });
}

/**
 * Adds a artist select in modal
 */
function onClickAddArtistButton() {
    var url = '/artists/all';
    $.get(url, function(data) {
        var artistsDiv = $('#artistsDiv');
        artistsDiv.append(' <select name="artists[]" class="form-control my-1"></select>')
        $.each(data, function(_, value) {
            $('#artistsDiv select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
        });

        setListenerToSelects()
        updateSelectAlbums()
    });
}

/**
 * Deletes all selects in modal
 */
function onHideEditModal() {
    $("#artistsDiv").empty();
    $("#albumSelect").empty();

}

/**
 * Deletes last select in modal
 */
function deleteSelect() {
    $('#artistsDiv select:last-child').remove();
    updateSelectAlbums()
}

/**
 * Set listener on hide modal
 */
function setListeners() {
    $('#editSongModal').on('hide.bs.modal', function() {
        onHideEditModal()
    })
}

/**
 * Shows an alert in modal and then removes it.
 */
function setListenersOnBackFromController() {
    $('#editSongModal').modal('show');
    $('#formEditSong').addClass('d-none');
    $('#editButton').addClass('d-none');

    $('#editSongModal').on('hidden.bs.modal', function() {
        $('#modalAlertEditSong').addClass('d-none');
        $('#formEditSong').removeClass('d-none');
        $('#editButton').removeClass('d-none');
    });
}