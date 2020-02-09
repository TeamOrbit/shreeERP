<div class="modal fade bd-example-modal-lg show" id="addSupplierModal"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addSupplierForm" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="id" id="supplier-id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company-name">Company Name <i class="text-danger">*</i></label>
                                    <input id="company-name" type="text" name="company_name" class="form-control" placeholder="Please enter supplier company name" maxlength="250">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name">First Name <i class="text-danger">*</i></label>
                                    <input id="first-name" type="text" name="first_name" class="form-control" placeholder="Please enter supplier first name" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last-name">Last Name <i class="text-danger">*</i></label>
                                    <input id="last-name" type="text" name="last_name" class="form-control" placeholder="Please enter supplier last name" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <i class="text-danger">*</i></label>
                                    <input id="email" type="email" name="email" class="form-control" placeholder="Please enter supplier email" maxlength="250">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone <i class="text-danger">*</i></label>
                                    <input id="phone" type="tel" name="phone" class="form-control" placeholder="Please enter supplier phone" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender <i class="text-danger">*</i></label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option selected disabled>--Please select gender--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address <i class="text-danger">*</i></label>
                                    <textarea id="address" type="text" name="address" class="form-control" placeholder="Please enter address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City <i class="text-danger">*</i></label>
                                    <input id="city" type="text" name="city" class="form-control" placeholder="Please enter supplier city" maxlength="250">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pincode">Pincode <i class="text-danger">*</i></label>
                                    <input id="pincode" type="number" name="pincode" class="form-control" placeholder="Please enter supplier pincode" maxlength="6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State <i class="text-danger">*</i></label>
                                    <input id="state" type="text" name="state" class="form-control" placeholder="Please enter supplier state" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country <i class="text-danger">*</i></label>
                                    <input id="country" type="text" name="country" class="form-control" placeholder="Please enter supplier country" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gst-no">GST No <i class="text-danger">*</i></label>
                                    <input id="gst-no" type="text" name="gst_no" class="form-control" placeholder="Please enter supplier gst number" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pancard">Pan Card No. <i class="text-danger">*</i></label>
                                    <input id="pancard-no" type="tel" name="pancard_no" class="form-control" placeholder="Please enter supplier pancard number" maxlength="15">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline ks-light btn-fill" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-fill" id="save-supplier">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
