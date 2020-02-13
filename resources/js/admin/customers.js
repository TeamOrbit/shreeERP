$(document).ready(function(){

    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled', true);
    });

    $('#customerTable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "customers/get-data",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: "5%"},
            {data: 'name', name: 'name', width: "25%"},
            {data: 'email', name: 'email', width: "40%"},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: "30%", className: "text-center"},
        ],
        columnDefs: [ {
            targets: 1,
            render: function ( data, type, row ) {
                return data.slice(0, 60) + (data.length > 60 ? "..." : "");
            }
        } ]
    });

    var validator = $('#addCustomerForm').validate({
        rules:{
            name : {
                required   : true, 
                minlength  : 3
            },
            email  : {
                required   : true, 
                email      : true,
                remote: {
                    url: '/customers/email-validate',
                    type: 'get',
                    data: {
                            id: function(){
                                return $('#customer-id').val();
                            }
                    },
                },
            },
            phone  : {
                required   : true
            },
            gender  : {
                required   : true
            },
            address  : {
                required   : true
            },
            city  : {
                required   : true
            },
            state  : {
                required   : true
            },
            country  : {
                required   : true
            },
            pincode  : {
                required   : true
            },
        },
        messages : {
            name : {
                required   : "Please enter name",
            },
            email  : {
                required   : "Please enter email",
                remote: 'The name has already been taken.',
            },
            phone  : {
                required   : "Please enter phone number",
            },
            gender  : {
                required   : "Please select gender",
            },
            address : {
                required   : "Please enter address",
            },
            city : {
                required   : "Please select city"
            },
            pincode : {
                required   : "Please enter pincode",
            },
            state : {
                required   : "Please enter state",
            },
            country : {
                required   : "Please enter country",
            },
        },
    });

    $('#addCustomerModal').on('hidden.bs.modal', function () {
        $('#addCustomerForm')[0].reset();
        $('[name="email"]').removeData("previousValue");
        $('[name="email"]').valid();
        $("#customer-id").val('');
        validator.resetForm();
        $("#addCustomerModal .error").removeClass("error");
        $('.button-prevent-multiple-submits').attr('disabled', false);
    });

    $(document).on('submit', '#addCustomerForm', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        if($('#addCustomerForm').valid()) {
            $.ajax({
                url: baseUrl + '/customers/store',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    if(data.status == "success"){
                        $('#addCustomerForm')[0].reset();
                        $('#addCustomerModal').modal('hide');
                        $('#customerTable').DataTable().ajax.reload();
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

    $(document).on('click', '#edit-customer', function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'customers/edit/'+id,
            type: "get",
            success: function(data, textStatus, jqXHR) {
                if(data.customerData){
                    customerInfo = data.customerData;
                    $("#customer-id").val(customerInfo.id);
                    $("#name").val(customerInfo.name);
                    $("#email").val(customerInfo.email);
                    $("#phone").val(customerInfo.phone);
                    $("#gender").val(customerInfo.gender);
                    $("#address").val(customerInfo.address);
                    $("#city").val(customerInfo.city);
                    $("#pincode").val(customerInfo.pincode);
                    $("#state").val(customerInfo.state);
                    $("#country").val(customerInfo.country);
                    $('#addCustomerModal').modal('show');
                }                
            },
            error: function(response, status, error) {
            }
        });
    });

    $(document).on('click','#customerDelete', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this customer",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url : baseUrl + '/customers/delete/'+id,
                    method:'get',
                    success: function(response)
                    {
                        swal({
                            title: response.status.charAt(0).toUpperCase()+response.status.slice(1),
                            text: response.message,
                            icon: response.status,
                        }).then(function() {
                            $('#customerTable').DataTable().ajax.reload();
                        });
                    }
                });
            }
        });
    });
});
