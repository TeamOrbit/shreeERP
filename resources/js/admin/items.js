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
            {data: 'name', name: 'name', width: "30%"},
            {data: 'description', name: 'description', width: "40%"},
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
                    url: '/item/item-validate',
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
        },
        messages:{
            name : { 
                required : "Please enter item name.",
                remote: 'The name has already been taken.'},
            description  : { 
                required : "Please enter item description.", 
                minlength: 'Please enter minimum 3 characters'
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
                url: baseUrl + '/item/store',
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
                    $("#category-id").val(itemInfo.id);
                    $("#name").val(itemInfo.name);
                    $("#description").val(itemInfo.description);

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
