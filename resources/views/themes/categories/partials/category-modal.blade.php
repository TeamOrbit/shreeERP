<div class="modal fade bd-example-modal-lg show" id="addCategoryModal"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addCategoryForm" class="form-prevent-multiple-submits">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="id" id="category-id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Please enter name" maxlength="25">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description <i class="text-danger">*</i></label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Please enter description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline btn-fill ks-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-fill button-prevent-multiple-submits" id="save-category">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>