$(document).ready(function(){

    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled', true);
    });

    $('#cityTable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "cities/get-data",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false, orderable: false, width: "5%"},
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

    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please enter only letters"); 

    jQuery.validator.addMethod("rrrpeating", function(value, element) 
    { 
        return this.optional(element) ||  !/([a-z\d])\1\1/i.test(value); 
    }, "PPPplease don't use RRRepeating CCCharacters");


    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    var validator = $('#addCityForm').validate({
        rules:{
            name : {
                required : true,
                lettersonly : true,
                rrrpeating : true,
                minlength: 3,
                maxlength : 25,
                remote: {
                    url: '/cities/city-validate',
                    type: 'get',
                    data: {
                            id: function(){
                                return $('#city-id').val();
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
                required : "Please enter city name",
                minlength: 'Please enter minimum 3 characters',
                remote: 'The name has already been taken.'},
        },
    });

    $('#addCityModal').on('hidden.bs.modal', function () {
        $('#addCityForm')[0].reset();
        $('[name="name"]').removeData("previousValue");
        $('[name="name"]').valid();
        $("#city-id").val('');
        validator.resetForm();
        $("#addCityModal .error").removeClass("error");
        $('.button-prevent-multiple-submits').attr('disabled', false);
    });

    $(document).on('submit', '#addCityForm', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        if($('#addCityForm').valid()) {
            $.ajax({
                url: baseUrl + '/cities/store',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    if(data.status == "success"){
                        $('#addCityForm')[0].reset();
                        $('#addCityModal').modal('hide');
                        $('#cityTable').DataTable().ajax.reload();
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

    $(document).on('click', '#edit-city', function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'cities/edit/'+id,
            type: "get",
            success: function(data, textStatus, jqXHR) {
                if(data.cityData){
                    cityInfo = data.cityData;
                    $("#category-id").val(cityInfo.id);
                    $("#name").val(cityInfo.name);
                    $('#addCityModal').modal('show');
                }                
            },
            error: function(response, status, error) {
            }
        });
    });

    $(document).on('click','#cityDelete', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this city",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url : baseUrl + '/cities/delete/'+id,
                    method:'get',
                    success: function(response)
                    {
                        swal({
                            title: response.status.charAt(0).toUpperCase()+response.status.slice(1),
                            text: response.message,
                            icon: response.status,
                        }).then(function() {
                            $('#cityTable').DataTable().ajax.reload();
                        });
                    }
                });
            }
        });
    });
});
