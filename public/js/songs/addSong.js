function addSelect() {
    var url = '/artists/all';
    $.get(url, function(data) {
        var artistsDiv = $('#artists');

        artistsDiv.append(' <select name="artists[]" class="form-control my-2"></select>')

        $.each(data, function(key, value) {
            $('#artists select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');

        });

        setListenerSelects();
        updateSelectAlbumsAdd();
    });
}

function updateSelectAlbumsAdd() {
    $("#albumAddSelect").empty();

    var values = $("#artists select[name='artists[]']").map(function() { return $(this).val(); }).get();

    $.ajax({
        url: "/albums/albumsfromlist",
        type: "get",
        contentType: 'charset=UTF-8',

        data: { 'artists': values },
        success: function(result) {
            $.each(result, function(key, value) {
                $('#albumAddSelect').append('<option value=' + value.id + '>' + value.name + '</option>');
            })
        }
    });
}


function removeSelect() {
    $('#artists select:last-child').remove();
    updateSelectAlbumsAdd();
}


function setListenerSelects() {
    $("#artists select[name='artists[]']").on('change', function() {
        updateSelectAlbumsAdd()
    });
}


function onBackFromController() {
    $('#modalAddSong').modal('show');
}

function onHideAddSong() {
    $('#selectAlbum').addClass('sr-only');
    $("#selectArtist").prop("selectedIndex", 0);
    $('#addSongModalAlert').addClass('d-none');
}