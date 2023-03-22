<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">MediaGallery</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                @foreach($mediagalleries as $gallery)
                <div class="gallery-parent">
                <input type="checkbox" id="md_checkbox_26 {{ $gallery->id }}" class="gallery filled-in chk-col-blue"/>
                <label for="md_checkbox_26 {{ $gallery->id }}">
                    <div class="card" style="width: 5rem;">
                        <img class="card-img-top" src="{{ asset('uploads/mediagallery/'.$gallery->file_name) }}" alt="Card image cap">
                    </div>
                </label>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>