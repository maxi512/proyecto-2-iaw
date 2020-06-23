<div class="modal fade"  id="deleteSongModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Delete song</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <div class="alert alert-warning" role="alert" id="warningSong">
                        <p>Are you sure to delete to <b id="songName"></b>?</p>
                    </div>
                <div id="modalAlertDeleteSong">
                    @if(session('statusDelete'))
                        <div class="alert alert-success">
                            <p>{{ session('statusDelete') }}</p>
                        </div>
                    @endif
                </div>
                <form id="formDeleteSong" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="songHideDelete">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="deleteButton" class="btn btn-danger" form="formDeleteSong">Delete</button>
            </div>
        </div>
    </div>
</div>
@if(session('statusDelete'))
     <script>onBackFromControllerDelete()</script>
@endif