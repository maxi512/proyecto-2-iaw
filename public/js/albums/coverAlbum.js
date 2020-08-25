/**
 * Set image in modal
 * @param {*} button with data
 */
function showCover(button) {
    var idAlbum = button.data('id')
    $.ajax({
        url: "/albums/" + idAlbum + "/cover",
        type: "get",
        contentType: 'charset=UTF-8',
        success: function(result) {
            $('#modal-body').html('<img src="data:image/jpg;base64,' + result + '" height="300" width="300">')
        }
    });
}