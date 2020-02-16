$(document).ready(function(){
	$('.dynamicItem').select2({
		placeholder : 'Please select item',
		closeOnSelect: false,
		multiple: true
	});

	//Date time picker start date and end date validation
    $('#purchase_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss', 
        useCurrent: false,
        showTodayButton: true,
        showClear: true,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            today: "fa fa-clock-o",
            clear: "fa fa-trash-o"
        }
    });

	// var rowCount = $('#dynamicItemTable tr').length;
	// if(rowCount == 1)
	// {
	// 	let html = "<tr><td colspan='4' class='text-center'>No records found<td><tr>"
	// 	$('#dynamicItemTable tbody').append(html);
	// }

	$(document).on('change', '.dynamicItem', function() {
		var selectedItems = $('.dynamicItem').val();
		var quantity = $('#quantity').val();
		if(typeof(selectedItems) != "undefined" && selectedItems !== null)
		{
			$.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: baseUrl + '/items/getItemsData',
                method:'post',
                data: { selectedItems : selectedItems , quantity : quantity },
                dataType:'json',
                success:function(response)
                {
                    var itemsData = response.itemsInfo
                    console.log(itemsData);
                    $.each( itemsData, function( key, value ) {
                        if($("#dynamicItemTable").find("item_"+value.id+""))
                        {
						  itemsHTML = "<tr id=item_"+value.id+"><td><input type='hidden' name='item_id[]' value='"+value.id+"'>"+value.name+"</td><td>"+response.quantity+"</td><td>"+value.selling_price+"</td><td>"+value.gst+"</td><td>"+500+"</td></tr>";
                          $('#dynamicItemTable tbody').append(itemsHTML);
                        }
					});
					
                }
            })	
		}
	});
});