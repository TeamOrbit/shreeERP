@extends('themes.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="inline-block">
                <button class="btn btn-primary btn-fill float-right mb-2" data-toggle="modal" data-target="#addCityModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> Add City</button>
                <h3>City</h3>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="cityTable" class="table table-bordered">
               <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
               </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('themes.cities.partials.city-modal')
@endsection