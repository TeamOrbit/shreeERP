<div class="modal fade bd-example-modal-lg show" id="addCityModal"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addCityForm" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="id" id="city-id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Please enter city name" maxlength="250">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline ks-light btn-fill" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-fill" id="save-category">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
