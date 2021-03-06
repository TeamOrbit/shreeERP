@extends('themes.master')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="inline-block">
                <button class="btn btn-primary btn-fill float-right mb-2" data-toggle="modal" data-target="#addCategoryModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Add Category</button>
                <h3>Category</h3>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="categoryTable" class="table table-bordered">
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
    @include('themes.categories.partials.category-modal')
</div>
@endsection