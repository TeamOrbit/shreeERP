@extends('themes.master')

@section('content')
<div class="container">
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
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
               </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('themes.items.partials.item-modal')
@endsection