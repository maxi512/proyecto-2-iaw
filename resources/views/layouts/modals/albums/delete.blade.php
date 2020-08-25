<div class="modal fade"  id="deleteAlbumModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Delete album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <div class="alert alert-warning" role="alert" id="warningAlbum">
                        <p>Are you sure to delete to <b id="albumName"></b>?</p>
                        <p>All songs associated with this album will be deleted.</p>
                    </div>
                <div id="modalAlertDeleteAlbum">
                    @if(session('statusDeleteAlbum'))
                        <div class="alert alert-success">
                            <p>{{ session('statusDeleteAlbum') }}</p>
                        </div>
                    @endif
                </div>
                <form id="formDeleteAlbum" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="albumHideDelete">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="deleteAlbumButton" class="btn btn-danger" form="formDeleteAlbum">Delete</button>
            </div>
        </div>
    </div>
</div>
@if(session('statusDeleteAlbum'))
     <script>onBackFromControllerDeleteAlbum()</script>
@endif