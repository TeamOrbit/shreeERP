@extends('themes.master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="inline-block">
                <button class="btn btn-primary btn-fill float-right mb-2" data-toggle="modal" data-target="#addSupplierModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Add Supplier</button>
                <h3>Supplier</h3>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="supplierTable" class="table table-bordered">
               <thead>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
               </thead>
                </table>
            </div>
        </div>
    </div>
	@include('themes.suppliers.partials.supplier-model')
</div>
@endsection