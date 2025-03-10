<div class="modal fade"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Add new artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalAlert">
                    @if($errors->has('addError'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    @unless ($loop->last)
                                        <li>{{$error}}</li>
                                    @endunless
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <p>Data added!</p>
                        </div>
                    @endif
                </div>
                <form id="formArtist" action="/artists/submit" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control" id="recipient-name">
                    </div>
                    <select name="country" class="form-control">
                        @foreach($countries as $country)
                            <option value="{{ $country}}">{{ $country}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formArtist">Add</button>
            </div>
        </div>
    </div>
</div>
@if($errors->has('addError') || Session::get('success'))
    <script>onBackFromControllerAdd()</script>
@endif