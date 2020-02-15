$(document).ready(function(){
	$('.dynamicItem').select2({
		placeholder : 'Please select item',
		multiple: true
	});
	var rowCount = $('#dynamicItemTable tr').length;
	if(rowCount == 1)
	{
		let html = "<tr><td colspan='4' class='text-center'>No records found<td><tr>"
		$('#dynamicItemTable tbody').append(html);
	}
});