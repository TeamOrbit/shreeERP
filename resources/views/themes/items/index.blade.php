@extends('themes.master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="inline-block">
                <button class="btn btn-primary btn-fill float-right mb-2" data-toggle="modal" data-target="#addItemModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Add Item</button>
                <h3>Item</h3>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="itemTable" class="table table-bordered">
               <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Purchase Price</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Selling Price</th>
                        <th>GST</th>
                        <th>Action</th>
                    </tr>
               </thead>
                </table>
            </div>
        </div>
    </div>
    @include('themes.items.partials.item-modal')
</div>
@endsection