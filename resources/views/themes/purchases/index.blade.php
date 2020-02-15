@extends('themes.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <h3>Purchase</h3>
        <div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label for="supplier">Supplier <i class="text-danger">*</i></label>
		            <select id="supplier" name="supplier" class="form-control">
		                <option selected disabled>--Please select supplier--</option>
		                @foreach($suppliers as $supplier)
		                    <option value="{{$supplier->id}}">{{ucfirst($supplier->first_name.' '.$supplier->last_name)}}</option>
		                @endforeach
		            </select>
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label for="name">Purchase Date <i class="text-danger">*</i></label>
		            <input id="purchase_date" type="text" name="purchase_date" class="form-control">
		        </div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-6">
		        <div class="form-group">
		            <label for="item">Item <i class="text-danger">*</i></label>
		            <select id="item" name="item" class="form-control dynamicItem">
		            		<option value></option>
		                @foreach($items as $item)
		                    <option value="{{$item->id}}">{{ucfirst($item->name)}}</option>
		                @endforeach
		            </select>
		        </div>
		    </div>
		    <div class="col-md-6">
		        <div class="form-group">
		            <label for="quantity">Quantity <i class="text-danger">*</i></label>
		            <input id="quantity" type="text" name="quantity" class="form-control">
		        </div>
		    </div>
		</div>

		<table class="table table-bordered" id="dynamicItemTable">
			<thead>
				<tr>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>GST</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
    </div>
</div>
@endsection

