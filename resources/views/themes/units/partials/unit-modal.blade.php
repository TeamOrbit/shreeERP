<div class="modal fade bd-example-modal-lg show" id="addUnitModal"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addUnitForm" class="form-prevent-multiple-submits">
                <div class="modal-header">
                    <h5 class="modal-title">Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="id" id="unit-id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Please enter unit name" maxlength="25">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline ks-light btn-fill" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-fill button-prevent-multiple-submits" id="save-unit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
