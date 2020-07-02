function onClickEditSongButton(button) {
    setValues(button);
    var urlArtists = '/songs/' + button.data('id') + '/artists';
    var urlAllArtists = '/artists/all'

    $.get(urlAllArtists, function(dataAllArtists) {
        data = dataAllArtists
        createSelectArtists(data, urlArtists);
    });
}

function setValues(button) {
    $('#songNameEdit').val(button.data('name'))
    $('#youtubeLinkEdit').val(button.data('link'))
    $('#durationEdit').val(button.data('duration'))
    $('#songId').val(button.data('id'))
}

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
                console.log(result);
                $('#albumSelect').append('<option value=' + value.id + '>' + value.name + '</option>');
            })
        }
    });
}


function setListenerToSelects() {
    $("#formEditSong select[name='artists[]']").on('change', function() {
        updateSelectAlbums()
    });
}

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

function onHideEditModal() {
    $("#artistsDiv").empty();
    $("#albumSelect").empty();

}

function deleteSelect() {
    $('#artistsDiv select:last-child').remove();
    updateSelectAlbums()
}

function setListeners() {
    $('#editSongModal').on('hide.bs.modal', function() {
        onHideEditModal()
    })
}

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