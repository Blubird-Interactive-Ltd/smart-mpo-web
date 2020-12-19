function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#inputFile").change(function () {
    readURL(this);
});

//audit details
$('.audit_detalis').click(function(){
    $('#audit_details_modal').modal('show');
});

//Editor init
$('.summernote').summernote({height: 150});


//date picker init
$( ".datepicker" ).datepicker({
    changeMonth: true,
    changeYear: true
});

//spectrum color picker
var changed_color;
$(".color_picker").spectrum({
    color: "#333",
    change: function(color) {
        color.toHexString(); // #ff0000
        changed_color = color.toHexString();
        console.log(changed_color);
        $(this).parents('.add_group').find('.obs_color ').css('color',changed_color);
    }
});

function addSpectrum(){
    $(".color_picker").spectrum({
        color: "#333",
        change: function(color) {
            color.toHexString(); // #ff0000
            changed_color = color.toHexString();
            console.log(changed_color);
            $(this).parents('.add_group').find('.obs_color ').css('color',changed_color);
        }
    });
}


// add ASA 
/*var dynamic_content = '<div class="add_group">'
dynamic_content += '<div class="portlet light bordered">';
dynamic_content += '<div class="portlet-title">';
dynamic_content += '<div class="caption">';
dynamic_content += '<span class="caption-subject font-dark sbold uppercase">(ASA)</span>';
dynamic_content += '</div>';
dynamic_content += '<div class="actions">';
dynamic_content += '<div class="btn-group btn-group-devided" data-toggle="buttons">';
dynamic_content += '<button class="btn btn-primary add_new_asa"><i class="icon-plus icons"></i>Add New</button>';
dynamic_content += '<button class="btn btn-danger dlt_new_asa"><i class="icon-minus icons"></i>Delete</button>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '<div class="portlet-body">';
dynamic_content += '<div class="row">';
dynamic_content += '<div class="col-sm-6">';
dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_content += '<input type="text" class="form-control" id="">';
dynamic_content += '<label for="FactoryName">Subjects/ Issues</label>';
dynamic_content += '<span class="help-block">Enter Subjects/ Issues...</span>';
dynamic_content += '</div>';
dynamic_content += '<div class="form-group form-md-line-input">';
dynamic_content += '<input type="text" class="datepicker hajanDatePicker form-control" id="">';
dynamic_content += '<label for="">Target Due Date</label>';
dynamic_content += '<span class="help-block">Enter Factory Location...</span>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '<div class="col-sm-6">';
dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_content += '<input type="text" class="form-control" id="">';
dynamic_content += '<label for="">Responsible Person/Title</label>';
dynamic_content += '<span class="help-block">Enter Responsible Person/Title...</span>';
dynamic_content += '</div>';
dynamic_content += '<div class="form-group form-md-line-input">';
dynamic_content += '<input type="text" class="datepicker hajanDatePicker form-control" id="">';
dynamic_content += '<label for="">Completion Date</label>';
dynamic_content += '<span class="help-block">Enter Completion Date...</span>';
dynamic_content += '</div>';

dynamic_content += '</div>';
dynamic_content += '<div class="col-sm-12">';
dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_content += '<input type="text" class="form-control" id="">';
dynamic_content += '<label for="">Immediate Corrective Action   </label>';
dynamic_content += '<span class="help-block">Enter Immediate Corrective Action  ...</span>';
dynamic_content += '</div>';
dynamic_content += '<div class="form-group">';                                            
dynamic_content += '<label for="form_control_1">Findings/Observations</label>';
dynamic_content += '<textarea class="summernote form-control" rows="6"></textarea>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '</div>';
dynamic_content += '</div>';*/

var dynamic_content = '<div class="add_group">';
    dynamic_content += '<div class="portlet light bordered">';
    dynamic_content += '<div class="portlet-title">';
    dynamic_content += '<div class="caption">';
    dynamic_content += '<span class="caption-subject font-dark sbold uppercase">ASA</span>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="actions">';
    dynamic_content += '<div class="btn-group btn-group-devided" data-toggle="buttons">';
    dynamic_content += '<button type="button" class="btn btn-primary add_new_asa"><i class="icon-plus icons"></i></button>';
    dynamic_content += '<button type="button" class="btn btn-danger dlt_new_asa"><i class="icon-close icons"></i></button>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="portlet light bordered">';
    dynamic_content += '<div class="portlet-body">';
    dynamic_content += '<div class="row">';
    dynamic_content += '<div class="col-sm-2">';
    dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
    dynamic_content += '<input type="text" class="form-control" id="">';
    dynamic_content += '<label for="FactoryName">Subjects/ Issues</label>';
    dynamic_content += '<span class="help-block">Enter Subjects/ Issues...</span>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="col-sm-2">';
    dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
    dynamic_content += '<input type="text" class="form-control" id="">';
    dynamic_content += '<label for="">Responsible Person/Title</label>';
    dynamic_content += '<span class="help-block">Enter Responsible Person/Title...</span>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="col-sm-3">';
    dynamic_content += '<div class="row">';
    dynamic_content += '<div class="col-sm-6">';
    dynamic_content += '<div class="form-group form-md-line-input">';
    dynamic_content += '<div class="input-group right-addon">';
    dynamic_content += '<input type="text" class="form-control datepicker" id="">';
    dynamic_content += '<label for="">Target Due Date</label>';
    dynamic_content += '<span class="input-group-addon">';
    dynamic_content += '<i class="fa fa-calendar"></i>';
    dynamic_content += '</span>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="col-sm-6">';
    dynamic_content += '<div class="form-group form-md-line-input">';
    dynamic_content += '<div class="input-group right-addon">';
    dynamic_content += '<input type="text" class="form-control datepicker" id="">';
    dynamic_content += '<label for="">Completion Date</label>';
    dynamic_content += '<span class="input-group-addon">';
    dynamic_content += '<i class="fa fa-calendar"></i>';
    dynamic_content += '</span>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="col-sm-2">';
    dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
    dynamic_content += '<input type="text" class="form-control" id="">';
    dynamic_content += '<label for="">Immediate Corrective Action   </label>';
    dynamic_content += '<span class="help-block">Enter Immediate Corrective Action  ...</span>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="col-sm-3">';
    dynamic_content += '<div class="row">';
    dynamic_content += '<div class="col-sm-9">';
    dynamic_content += '<div class="form-group form-md-line-input form-md-floating-label">';
    dynamic_content += '<input type="text" class="form-control obs_color" id="">';
    dynamic_content += '<label for="">Findings/Observations</label>';
    dynamic_content += '<span class="help-block">Enter Findings/Observations...</span>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '<div class="col-sm-3 no-padding-right">';
    dynamic_content += '<input type="text" class="color_picker m-t-20" />';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';
    dynamic_content += '</div>';

$(document).on('click','.add_new_asa',function(editorId){
    $('.all_groups').append(dynamic_content);
    addSpectrum();
    //$('.summernote').summernote({height: 150});
});

$(document).on('click','.dlt_new_asa',function(){
    $(this).parents('.add_group').remove();
});

$(document).on("focus", ".datepicker", function(){
    $(this).datepicker();
});


//DISA dynamic add
var dynamic_disa_content = '<div class="add_group">';
dynamic_disa_content += '<div class="portlet light bordered">';
dynamic_disa_content += '<div class="portlet-title">';
dynamic_disa_content += '<div class="caption">';
dynamic_disa_content += '<span class="caption-subject font-dark sbold uppercase">DISA</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="actions">';
dynamic_disa_content += '<div class="btn-group btn-group-devided" data-toggle="buttons">';
dynamic_disa_content += '<button type="button" class="btn btn-primary add_new_disa"><i class="icon-plus icons"></i></button>';
dynamic_disa_content += '<button type="button" class="btn btn-danger dlt_new_disa"><i class="icon-close icons"></i></button>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="portlet-body">';
dynamic_disa_content += '<div class="row">';
dynamic_disa_content += '<div class="col-sm-3">';
dynamic_disa_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_disa_content += '<input type="text" class="form-control" id="">';
dynamic_disa_content += '<label for="FactoryName">Subjects/ Issues</label>';
dynamic_disa_content += '<span class="help-block">Enter Subjects/ Issues...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-2">';
dynamic_disa_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_disa_content += '<input type="text" class="form-control" id="">';
dynamic_disa_content += '<label for="">Recommendation</label>';
dynamic_disa_content += '<span class="help-block">Enter Recommendation...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-3">';
dynamic_disa_content += '<div class="row">';
dynamic_disa_content += '<div class="col-sm-6">';
dynamic_disa_content += '<div class="form-group form-md-line-input">';
dynamic_disa_content += '<div class="input-group right-addon">';
dynamic_disa_content += '<input type="text" class="form-control datepicker" id="">';
dynamic_disa_content += '<label for="">Start Date</label>';
dynamic_disa_content += '<span class="input-group-addon">';
dynamic_disa_content += '<i class="fa fa-calendar"></i>';
dynamic_disa_content += '</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-6">';
dynamic_disa_content += '<div class="form-group form-md-line-input">';
dynamic_disa_content += '<div class="input-group right-addon">';
dynamic_disa_content += '<input type="text" class="form-control datepicker" id="">';
dynamic_disa_content += '<label for="">End Date</label>';
dynamic_disa_content += '<span class="input-group-addon">';
dynamic_disa_content += '<i class="fa fa-calendar"></i>';
dynamic_disa_content += '</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-4">';
dynamic_disa_content += '<div class="row">';
dynamic_disa_content += '<div class="col-sm-9">';
dynamic_disa_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_disa_content += '<input type="text" class="form-control obs_color" id="">';
dynamic_disa_content += '<label for="">Findings/Observations</label>';
dynamic_disa_content += '<span class="help-block">Enter Findings/Observations...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-3 text-right">';
dynamic_disa_content += '<input type="text" class="color_picker m-t-20" />';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';

/*
var dynamic_disa_content = '<div class="add_group">';
dynamic_disa_content += '<div class="portlet light bordered">';
dynamic_disa_content += '<div class="portlet-title">';
dynamic_disa_content += '<div class="caption">';
dynamic_disa_content += '<span class="caption-subject font-dark sbold uppercase">(DISA)</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="actions">';
dynamic_disa_content += '<div class="btn-group btn-group-devided" data-toggle="buttons">';
dynamic_disa_content += '<button type="button" class="btn btn-primary add_new_disa"><i class="icon-plus icons"></i>Add New</button>';
dynamic_disa_content += '<button class="btn btn-danger dlt_new_disa"><i class="icon-minus icons"></i>Delete</button>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="portlet-body">';
dynamic_disa_content += '<div class="row">';
dynamic_disa_content += '<div class="col-sm-6">';
dynamic_disa_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_disa_content += '<input type="text" class="form-control" id="">';
dynamic_disa_content += '<label for="FactoryName">Subjects/ Issues</label>';
dynamic_disa_content += '<span class="help-block">Enter Subjects/ Issues...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="form-group form-md-line-input">';
dynamic_disa_content += '<input type="text" class="form-control datepicker" id="">';
dynamic_disa_content += '<label for="">Start Time</label>';
dynamic_disa_content += '<span class="help-block">Enter Timescale...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-6">';
dynamic_disa_content += '<div class="form-group form-md-line-input form-md-floating-label">';
dynamic_disa_content += '<input type="text" class="form-control" id="">';
dynamic_disa_content += '<label for="">Recommendation</label>';
dynamic_disa_content += '<span class="help-block">Enter Recommendation...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="form-group form-md-line-input">';
dynamic_disa_content += '<input type="text" class="form-control datepicker" id="">';
dynamic_disa_content += '<label for="">End Time</label>';
dynamic_disa_content += '<span class="help-block">Enter Timescale...</span>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '<div class="col-sm-12">';
dynamic_disa_content += '<div class="form-group form-md-line-input">';
dynamic_disa_content += '<label for="form_control_1">Observations</label>';
dynamic_disa_content += '<textarea class="summernote form-control" rows="6"></textarea>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
dynamic_disa_content += '</div>';
*/

$(document).on('click','.add_new_disa',function(editorId){
    $('.all_groups').append(dynamic_disa_content);
    addSpectrum();
    //$('.summernote').summernote({height: 150});
});

$(document).on('click','.dlt_new_disa',function(){
    $(this).parents('.add_group').remove();
});

//dynamic bsci dynamic content
var count = 0;
var dynamic_bsci_content = '<div class="add_group">';
dynamic_bsci_content +='<div class="portlet light bordered">';
dynamic_bsci_content +='<div class="portlet-title">';
dynamic_bsci_content +='<div class="caption">';
dynamic_bsci_content +='<span class="caption-subject font-dark sbold uppercase">BSCI</span>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='<div class="actions">';
dynamic_bsci_content +='<div class="btn-group btn-group-devided" data-toggle="buttons">';
dynamic_bsci_content +='<button type="button" class="btn btn-primary add_new_bsci"><i class="icon-plus icons"></i>Add New</button>';
dynamic_bsci_content +='<button type="button" class="btn btn-danger dlt_new_bsci"><i class="icon-minus icons"></i>Delete</button>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='<div class="portlet-body">';
dynamic_bsci_content +='<div class="row">';
dynamic_bsci_content +='<div class="col-sm-12 m-b-20">';
dynamic_bsci_content +='<div class="row">';
dynamic_bsci_content +='<div class="col-sm-6">';
dynamic_bsci_content +='<div class="md-checkbox">';
dynamic_bsci_content +='<input type="checkbox" id="checkbox1" class="md-check">';
dynamic_bsci_content +='<label for="checkbox1">';
dynamic_bsci_content +='<span></span>';
dynamic_bsci_content +='<span class="check"></span>';
dynamic_bsci_content +='<span class="box"></span> Performance Area Name ';
dynamic_bsci_content +='</label>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='<div class="col-sm-6">';
dynamic_bsci_content +='<div class="md-checkbox">';
dynamic_bsci_content +='<input type="checkbox" id="checkbox2" class="md-check">';
dynamic_bsci_content +='<label for="checkbox2">';
dynamic_bsci_content +='<span></span>';
dynamic_bsci_content +='<span class="check"></span>';
dynamic_bsci_content +='<span class="box"></span>  Respective Rule </label>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='<div class="col-sm-6">';
dynamic_bsci_content +='<div class="form-group form-md-line-input">';
dynamic_bsci_content +='<input type="text" class="form-control datepicker" id="">';
dynamic_bsci_content +='<label for="">Start Time</label>';
dynamic_bsci_content +='<span class="help-block">Enter Timescale...</span>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='<div class="col-sm-6">';
dynamic_bsci_content +='<div class="form-group form-md-line-input">';
dynamic_bsci_content +='<input type="text" class="form-control datepicker" id="">';
dynamic_bsci_content +='<label for="">End Time</label>';
dynamic_bsci_content +='<span class="help-block">Enter Timescale...</span>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='<div class="col-sm-12">';
dynamic_bsci_content +='<div class="form-group form-md-line-input">';
dynamic_bsci_content +='<label for="form_control_1">Observations</label>';
dynamic_bsci_content +='<textarea class="summernote form-control" rows="6"></textarea>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';
dynamic_bsci_content +='</div>';

$(document).on('click','.add_new_bsci',function(editorId){
    $('.all_groups').append(dynamic_bsci_content);
    $('.summernote').summernote({height: 150});
});

$(document).on('click','.dlt_new_bsci',function(){
    $(this).parents('.add_group').remove();
});