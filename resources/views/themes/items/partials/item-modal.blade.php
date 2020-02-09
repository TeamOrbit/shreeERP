<div class="modal fade bd-example-modal-lg show" id="addItemModal"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addItemForm" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="id" id="item-id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Please enter item name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description <i class="text-danger">*</i></label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Please enter item description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Category <i class="text-danger">*</i></label>
                                    <select id="category" name="category" class="form-control">
                                        <option selected disabled>--Please select category--</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Purchase Price <i class="text-danger">*</i></label>
                                    <input id="purchase_price" type="number" name="purchase_price" class="form-control" placeholder="Please enter purchase price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Quantity <i class="text-danger">*</i></label>
                                    <input id="quantity" type="text" name="quantity" class="form-control" placeholder="Please enter quantity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Unit <i class="text-danger">*</i></label>
                                    <select id="unit" name="unit" class="form-control">
                                        <option selected disabled>--Please select unit--</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{ucfirst($unit->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Selling Price <i class="text-danger">*</i></label>
                                    <input id="selling_price" type="text" name="selling_price" class="form-control" placeholder="Please enter selling price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">GST (in percentage) <i class="text-danger">*</i></label>
                                    <input id="gst" type="text" name="gst" class="form-control" placeholder="Please enter gst">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline btn-fill ks-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-fill" id="save-category">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>