$(document).ready(function(){

    $('#itemTable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "items/get-data",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false, width: "5%"},
            {data: 'name', name: 'name', width: "20%"},
            {data: 'category_id', name: 'category_id', width: "5%"},
            {data: 'purchase_price', name: 'purchase_price', width: "10%"},
            {data: 'quantity', name: 'quantity', width: "10%"},
            {data: 'unit_id', name: 'unit_id', width: "5%"},
            {data: 'selling_price', name: 'selling_price', width: "10%"},
            {data: 'gst', name: 'gst', width: "10%"},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: "25%", className: "text-center"},
        ],
        columnDefs: [ {
            targets: 1,
            render: function ( data, type, row ) {
                return data.slice(0, 60) + (data.length > 60 ? "..." : "");
            }
        } ]
    });

    var validator = $('#addItemForm').validate({
        rules:{
            name : {
                required : true,
                remote: {
                    url: '/items/item-validate',
                    type: 'get',
                    data: {
                            id: function(){
                                return $('#item-id').val();
                            }
                    }
                },
            },
            description  : {
                required : true, 
                minlength: 5
            },
            category  : {
                required : true
            },
            purchase_price  : {
                required : true
            },
            quantity  : {
                required : true
            },
            unit  : {
                required : true
            },
            selling_price  : {
                required : true
            },
            gst  : {
                required : true
            },
        },
        messages:{
            name : { 
                required : "Please enter name.",
                remote: 'The name has already been taken.'},
            description  : { 
                required : "Please enter description.", 
                minlength: 'Please enter minimum 3 characters'
            },
            purchase_price  : { 
                required : "Please enter purchase price"
            },
            category  : { 
                required : "Please select category"
            },
            quantity  : { 
                required : "Please enter quantity"
            },
            selling_price  : { 
                required : "Please enter selling price"
            },
            unit  : { 
                required : "Please select unit"
            },
            gst  : { 
                required : "Please enter gst"
            },

        },
    });

    $('#addItemModal').on('hidden.bs.modal', function () {
        $('#addItemForm')[0].reset();
        $('[name="name"]').removeData("previousValue");
        $('[name="name"]').valid();
        $("#item-id").val('');
        validator.resetForm();
        $("#addItemModal .error").removeClass("error");
    });

    $(document).on('submit', '#addItemForm', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        if($('#addItemForm').valid()) {
            $.ajax({
                url: baseUrl + '/items/store',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    if(data.status == "success"){
                        $('#addItemForm')[0].reset();
                        $('#addItemModal').modal('hide');
                        $('#itemTable').DataTable().ajax.reload();
                        swal({
                            title : "Success",
                            text : data.message,
                            type : "success",
                            icon : "success",
                            html: true
                        });
                    }
                },
                error: function(response, status, error) {
                }
            });
        } else {
            return false;
        }
    });

    $(document).on('click', '#edit-item', function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'items/edit/'+id,
            type: "get",
            success: function(data, textStatus, jqXHR) {
                if(data.itemData){
                    itemInfo = data.itemData;
                    console.log(itemInfo);
                    $("#item-id").val(itemInfo.id);
                    $("#name").val(itemInfo.name);
                    $("#category").val(itemInfo.category_id);
                    $("#description").val(itemInfo.description);
                    $("#purchase_price").val(itemInfo.purchase_price);
                    $("#quantity").val(itemInfo.quantity);
                    $("#unit").val(itemInfo.unit_id);
                    $("#selling_price").val(itemInfo.selling_price);
                    $("#gst").val(itemInfo.gst);

                    $('#addItemModal').modal('show');
                }                
            },
            error: function(response, status, error) {
            }
        });
    });

    $(document).on('click','#itemDelete', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url : baseUrl + '/items/delete/'+id,
                    method:'get',
                    success: function(response)
                    {
                        swal({
                            title: response.status.charAt(0).toUpperCase()+response.status.slice(1),
                            text: response.message,
                            icon: response.status,
                        }).then(function() {
                            $('#itemTable').DataTable().ajax.reload();
                        });
                    }
                });
            }
        });
    });
});
