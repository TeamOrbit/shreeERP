$(document).ready(function(){

    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled', true);
    });

    $('#unitTable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "units/get-data",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: "5%"},
            {data: 'name', name: 'name', width: "65%"},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: "30%", className: "text-center"},
        ],
        columnDefs: [ {
            targets: 1,
            render: function ( data, type, row ) {
                return data.slice(0, 60) + (data.length > 60 ? "..." : "");
            }
        } ]
    });

    jQuery.validator.addMethod("lettersonly", function(value, element, param) {
      return value.match(new RegExp("." + param + "$"));
    });

    var validator = $('#addUnitForm').validate({
        rules:{
            name : {
                required : true,
                lettersonly: "[a-zA-Z]+",
                remote: {
                    url: '/units/unit-validate',
                    type: 'get',
                    data: {
                            id: function(){
                                return $('#unit-id').val();
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
                required : "Please enter unit name.",
                remote: 'The name has already been taken.'},
                lettersonly: "Please enter name in letters."
        },
    });

    $('#addUnitModal').on('hidden.bs.modal', function () {
        $('#addUnitForm')[0].reset();
        $('[name="name"]').removeData("previousValue");
        $('[name="name"]').valid();
        $("#unit-id").val('');
        validator.resetForm();
        $("#addUnitModal .error").removeClass("error");
        $('.button-prevent-multiple-submits').attr('disabled', false);
    });

    $(document).on('submit', '#addUnitForm', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        if($('#addUnitForm').valid()) {
            $.ajax({
                url: baseUrl + '/units/store',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    if(data.status == "success"){
                        $('#addUnitForm')[0].reset();
                        $('#addUnitModal').modal('hide');
                        $('#unitTable').DataTable().ajax.reload();
                        swal({
                            title : "Success",
                            text : data.message,
                            icon : "success",
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

    $(document).on('click', '#edit-unit', function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'units/edit/'+id,
            type: "get",
            success: function(data, textStatus, jqXHR) {
                if(data.unitData){
                    unitInfo = data.unitData;
                    $("#unit-id").val(unitInfo.id);
                    $("#name").val(unitInfo.name);
                    $('#addUnitModal').modal('show');
                }                
            },
            error: function(response, status, error) {
            }
        });
    });

    $(document).on('click','#unitDelete', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this unit",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url : baseUrl + '/units/delete/'+id,
                    method:'get',
                    success: function(response)
                    {
                        swal({
                            title: response.status.charAt(0).toUpperCase()+response.status.slice(1),
                            text: response.message,
                            icon: response.status,
                        }).then(function() {
                            $('#unitTable').DataTable().ajax.reload();
                        });
                    }
                });
            }
        });
    });
});
