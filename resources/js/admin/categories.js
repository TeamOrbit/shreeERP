$(document).ready(function(){

    $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "categories/get-data",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false, width: "5%"},
            {data: 'name', name: 'name', width: "30%"},
            {data: 'description', name: 'description', width: "55%"},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: "15%", className: "text-center"},
        ],
        columnDefs: [ {
            targets: 1,
            render: function ( data, type, row ) {
                return data.slice(0, 60) + (data.length > 60 ? "..." : "");
            }
        } ]
    });

    var validator = $('#addCategoryForm').validate({
        rules:{
            name : {
                required : true, 
                minlength: 3, 
                remote: {
                    url: '/categories/category-validate',
                    type: 'get',
                    data: {
                            id: function(){
                                return $('#category-id').val();
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
                required : "Please enter category name.", 
                minlength: 'Please enter minimum 3 characters',
                remote: 'The name has already been taken.'},
            description  : { 
                required : "Please enter category description.", 
                minlength: 'Please enter minimum 3 characters'
            },
        },
        // onkeyup: false,
        // onfocusout: false
    });

    $('#addCategoryModal').on('hidden.bs.modal', function () {
        $('#addCategoryForm')[0].reset();
        $('[name="name"]').removeData("previousValue");
        $('[name="name"]').valid();
        $("#category-id").val('');
        validator.resetForm();
        $("#addCategoryModal .error").removeClass("error");
    });

    $(document).on('submit', '#addCategoryForm', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        if($('#addCategoryForm').valid()) {
            $.ajax({
                url: baseUrl + '/categories/store',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    if(data.status == "success"){
                        $('#addCategoryForm')[0].reset();
                        $('#addCategoryModal').modal('hide');
                        $('#categoryTable').DataTable().ajax.reload();
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

    $(document).on('click', '#edit-category', function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'categories/edit/'+id,
            type: "get",
            success: function(data, textStatus, jqXHR) {
                if(data.categoryData){
                    categoryInfo = data.categoryData;
                    $("#category-id").val(categoryInfo.id);
                    $("#name").val(categoryInfo.name);
                    $("#description").val(categoryInfo.description);

                    $('#addCategoryModal').modal('show');
                }                
            },
            error: function(response, status, error) {
            }
        });
    });

    $(document).on('click','#categoryDelete', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this category",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url : baseUrl + '/categories/delete/'+id,
                    method:'get',
                    success: function(response)
                    {
                        swal({
                            title: response.status.charAt(0).toUpperCase()+response.status.slice(1),
                            text: response.message,
                            icon: response.status,
                        }).then(function() {
                            $('#categoryTable').DataTable().ajax.reload();
                        });
                    }
                });
            }
        });
    });
});
