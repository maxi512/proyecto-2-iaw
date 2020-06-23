function addSelectArtist() {
    var url = '/artists/all';
    $.get(url, function(data) {
        var artistsDiv = $('#artists');

        artistsDiv.append(' <select name="artists[]" class="form-control my-1"></select>')

        $.each(data, function(key, value) {
            $('#artists select:last-child').append('<option value=' + value.id + '>' + value.name + '</option>');
        });
    });
}

function removeSelectArtist() {
    $('#artists select:last-child').remove();
}

function onBackFromControllerAddAlbum() {
    $('#modalAddAlbum').modal('show');
    $('#modalAddAlbum').on('hidden.bs.modal', function() {
        $('#modalAlert').addClass('d-none');
    });
}