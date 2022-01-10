<div class="modal" id="modal-programme">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-programme</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control"
                               placeholder="Name"
                               minlength="3"
                               value="">
                    </div>
                    <button type="submit" class="btn btn-success">Save programme</button>
                </form>
            </div>
        </div>
    </div>
</div>
