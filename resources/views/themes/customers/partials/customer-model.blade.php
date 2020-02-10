<div class="modal fade bd-example-modal-lg show" id="addCustomerModal"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addCustomerForm" class="form-prevent-multiple-submits">
                <div class="modal-header">
                    <h5 class="modal-title">Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fa fa-times"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" name="id" id="customer-id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Please enter customer name" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <i class="text-danger">*</i></label>
                                    <input id="email" type="email" name="email" class="form-control" placeholder="Please enter customer email" maxlength="250">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone <i class="text-danger">*</i></label>
                                    <input id="phone" type="tel" name="phone" class="form-control" placeholder="Please enter customer phone" maxlength="10">
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
                                    <!-- <select id="city" name="city" class="form-control">
                                        <option selected disabled>--Please select city--</option>
                                    </select> -->
                                    <input id="city" type="text" name="city" class="form-control" placeholder="Please enter customer city" maxlength="250">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pincode">Pincode <i class="text-danger">*</i></label>
                                    <input id="pincode" type="number" name="pincode" class="form-control" placeholder="Please enter customer pincode" maxlength="6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State <i class="text-danger">*</i></label>
                                    <input id="state" type="text" name="state" class="form-control" placeholder="Please enter customer state" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country <i class="text-danger">*</i></label>
                                    <input id="country" type="text" name="country" class="form-control" placeholder="Please enter customer country" maxlength="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary-outline ks-light btn-fill" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-fill button-prevent-multiple-submits" id="save-category">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
