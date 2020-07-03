/**
 * Shows an alert in modal and then removes it
 */
function onBackFromControllerAdd() {
    $('#myModal').modal('show');
    $('#myModal').on('hidden.bs.modal', function() {
        $('#modalAlert').addClass('d-none');
    });
}