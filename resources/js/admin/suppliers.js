$(document).ready(function(){

    $('.form-prevent-multiple-submits').on('submit', function(){
        $('.button-prevent-multiple-submits').attr('disabled', true);
    });

    $('#supplierTable').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: "suppliers/get-data",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false, orderable: false},
            {data: 'company_name', name: 'company_name'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
        ],
      
    });

    var validator = $('#addSupplierForm').validate({
        rules:{
            company_name : {
                required   : true, 
            },
            first_name : {
                required   : true, 
            },
            last_name : {
                required   : true, 
            },
            email  : {
                required   : true, 
                email      : true,
                remote: {
                    url: '/suppliers/email-validate',
                    type: 'get',
                    data: {
                            id: function(){
                                return $('#supplier-id').val();
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
            pincode  : {
                required   : true
            },
            state  : {
                required   : true
            },
            country  : {
                required   : true
            },
            gst_no  : {
                required   : true
            },
            pancard_no  : {
                required   : true
            },
        },
        messages : {
            company_name : {
                required   : "Please enter company name",
            },
            first_name : {
                required   : "Please enter first name",
            },
            last_name : {
                required   : "Please enter last name",
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
            gst_no : {
                required   : "Please enter gst number",
            },
            pancard_no : {
                required   : "Please enter pancard number",
            },
        },
    });

    $('#addSupplierModal').on('hidden.bs.modal', function () {
        $('#addSupplierForm')[0].reset();
        $('[name="email"]').removeData("previousValue");
        $('[name="email"]').valid();
        $("#supplier-id").val('');
        validator.resetForm();
        $("#addSupplierModal .error").removeClass("error");
        $('.button-prevent-multiple-submits').attr('disabled', false);
    });

    $(document).on('submit', '#addSupplierForm', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        if($('#addSupplierForm').valid()) {
            $.ajax({
                url: baseUrl + '/suppliers/store',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR) {
                    if(data.status == "success"){
                        $('#addSupplierForm')[0].reset();
                        $('#addSupplierModal').modal('hide');
                        $('#supplierTable').DataTable().ajax.reload();
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

    $(document).on('click', '#edit-supplier', function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: 'suppliers/edit/'+id,
            type: "get",
            success: function(data, textStatus, jqXHR) {
                if(data.supplierData){
                    supplierInfo = data.supplierData;
                    $("#supplier-id").val(supplierInfo.id);
                    $("#company-name").val(supplierInfo.company_name);
                    $("#first-name").val(supplierInfo.first_name);
                    $("#last-name").val(supplierInfo.last_name);
                    $("#email").val(supplierInfo.email);
                    $("#phone").val(supplierInfo.phone);
                    $("#gender").val(supplierInfo.gender);
                    $("#address").val(supplierInfo.address);
                    $("#city").val(supplierInfo.city);
                    $("#pincode").val(supplierInfo.pincode);
                    $("#state").val(supplierInfo.state);
                    $("#country").val(supplierInfo.country);
                    $("#gst-no").val(supplierInfo.gst_no);
                    $("#pancard-no").val(supplierInfo.pancard_no);
                    $('#addSupplierModal').modal('show');
                }                
            },
            error: function(response, status, error) {
            }
        });
    });

    $(document).on('click','#supplierDelete', function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this supplier",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete)
            {
                $.ajax({
                    url : baseUrl + '/suppliers/delete/'+id,
                    method:'get',
                    success: function(response)
                    {
                        swal({
                            title: response.status.charAt(0).toUpperCase()+response.status.slice(1),
                            text: response.message,
                            icon: response.status,
                        }).then(function() {
                            $('#supplierTable').DataTable().ajax.reload();
                        });
                    }
                });
            }
        });
    });
});
