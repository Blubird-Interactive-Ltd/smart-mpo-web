
//dashboard list
$('#product_list, .datatable').DataTable();
//audit details
/*$('.audit_details').DataTable({
	"paging": false,
	"searching": false,
	"ordering": false,
    "info":     false
});*/

var doctor_list = $('#doctor_list').DataTable();
$('#select_specialty').change(function(){
    var select_val = $(this).val();
	doctor_list
		.columns(5)
		.search(select_val)
		.draw();
});
$('#select_class').change(function(){
    var select_val = $(this).val();
	doctor_list
		.columns(6)
		.search(select_val)
		.draw();
});
$('#select_Honorarium').change(function(){
    var select_val = $(this).val();
	doctor_list
		.columns(7)
		.search(select_val)
		.draw();
});

//chemist part
var chemist_list = $('#Chemist_list').DataTable();
$('#select_chemist_territory').change(function(){
    var select_val = $(this).val();
	chemist_list
		.columns(3)
		.search(select_val)
		.draw();
});
$('#select_chemist_class').change(function(){
    var select_val = $(this).val();
	chemist_list
		.columns(4)
		.search(select_val)
		.draw();
});
$('#select_chemist_category').change(function(){
    var select_val = $(this).val();
	chemist_list
		.columns(5)
		.search(select_val)
		.draw();
});



//prescription
var pres_all = $('#pres_all_table').DataTable();
$('#pres_all_sort').change(function(){
    var select_val = $(this).val();
	pres_all
		.columns(6)
		.search(select_val)
		.draw();
});

//DCR Doctor
var doctor_all = $('#doctor_all_table').DataTable();
$('#doctor_all_sort').change(function(){
    var select_val = $(this).val();
	doctor_all
		.columns(7)
		.search(select_val)
		.draw();
});

var doctor_all = $('#doctor_accept_table').DataTable();
$('#doctor_accept_sort').change(function(){
    var select_val = $(this).val();
	doctor_all
		.columns(7)
		.search(select_val)
		.draw();
});

var doctor_all = $('#doctor_pending_table').DataTable();
$('#doctor_pending_sort').change(function(){
    var select_val = $(this).val();
	doctor_all
		.columns(7)
		.search(select_val)
		.draw();
});

var chemist_all = $('#chemist_reject_table').DataTable();
$('#chemist_reject_sort').change(function(){
    var select_val = $(this).val();
	chemist_all
		.columns(7)
		.search(select_val)
		.draw();
});


//DCR chemist
var chemist_all = $('#chemist_all_table').DataTable();
$('#chemist_all_sort').change(function(){
    var select_val = $(this).val();
	chemist_all
		.columns(7)
		.search(select_val)
		.draw();
});

var chemist_all = $('#chemist_accept_table').DataTable();
$('#chemist_accept_sort').change(function(){
    var select_val = $(this).val();
	chemist_all
		.columns(7)
		.search(select_val)
		.draw();
});

var chemist_all = $('#chemist_pending_table').DataTable();
$('#chemist_pending_sort').change(function(){
    var select_val = $(this).val();
	chemist_all
		.columns(7)
		.search(select_val)
		.draw();
});

var chemist_all = $('#chemist_reject_table').DataTable();
$('#chemist_reject_sort').change(function(){
    var select_val = $(this).val();
	doctor_all
		.columns(7)
		.search(select_val)
		.draw();
});
