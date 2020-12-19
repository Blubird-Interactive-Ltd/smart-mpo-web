$('#double-scroll').doubleScroll();

$('.double-scroll').doubleScroll();

/*function dblscroll(){
    $('.double-scroll').doubleScroll();
}*/

//Single select auto suggession (Division)
var availabledivision = [
  "Rajshahi",
  "Dhaka",
  "Barisal",
  "Chittagong",
  "Khulna",
  "Mymensingh",
  "Rangpur",
  "Sylhet"
];
$( "#division" ).autocomplete({
  source: availabledivision
});

//Single select auto suggession (District)
var availableDistrict = [
  "Rajshahi",
  "Dhaka",
  "Barisal",
  "Chittagong",
  "Khulna",
  "Mymensingh",
  "Rangpur",
  "Sylhet"
];
$( "#district" ).autocomplete({
  source: availableDistrict
});

//Single select auto suggession (Thana)
var availableThana = [
  "Rajshahi",
  "Dhaka",
  "Barisal",
  "Chittagong",
  "Khulna",
  "Mymensingh",
  "Rangpur",
  "Sylhet"
];
$( "#thana" ).autocomplete({
  source: availableThana
});


//Single select auto suggession (Division)
var chemberAvailabledivision = [
  "Rajshahi",
  "Dhaka",
  "Barisal",
  "Chittagong",
  "Khulna",
  "Mymensingh",
  "Rangpur",
  "Sylhet"
];
$( ".chemberDivision" ).autocomplete({
  source: chemberAvailabledivision
});

//Single select auto suggession (District)
var chemberAvailableDistrict = [
  "Rajshahi",
  "Dhaka",
  "Barisal",
  "Chittagong",
  "Khulna",
  "Mymensingh",
  "Rangpur",
  "Sylhet"
];
$( ".chemberDistrict" ).autocomplete({
  source: chemberAvailableDistrict
});

//Single select auto suggession (Thana)
var chemberAvailableThana = [
  "Rajshahi",
  "Dhaka",
  "Barisal",
  "Chittagong",
  "Khulna",
  "Mymensingh",
  "Rangpur",
  "Sylhet"
];
$( ".chemberThana" ).autocomplete({
  source: chemberAvailableThana
});


$('a[data-toggle="tab"]').on('click', function () {
    $('.double-scroll').doubleScroll();
    $('.tab_data_tables').DataTable();
});

$('.tagsInput').fastselect({
    placeholder: 'Select Factory'
});
$('.multipleSelect').fastselect({
    placeholder: 'Select Factory'
});

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
    changeYear: true,
    yearRange: "2000:2050"
});

//Dashboard Charts
$(window).load(function(){
    var br_height = $('#db_bar_chart').height();
    $('#db_pie_chart').height(br_height);
});

$(document).on('click','.notification_title',function(){
    $('#notification_details_modal').modal('show');
});

//Set target page 
/*
$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#prescription_target_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#prescription_target_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});
*/
 $(function() {
	$('#prescription_target_start').datepicker( {
		changeMonth: true,
		changeYear: true,
		yearRange: '1990:2050',
		showButtonPanel: true,
		dateFormat: 'MM yy',
		onClose: function(dateText, inst) { 
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(year, month, 1));
		},
		beforeShow : function(input, inst) {
			var datestr;
			if ((datestr = $(this).val()).length > 0) {
				year = datestr.substring(datestr.length-4, datestr.length);
				month = jQuery.inArray(datestr.substring(0, datestr.length-5), $(this).datepicker('option', 'monthNamesShort'));
				//$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
				//$(this).datepicker('setDate', new Date(year, month, 1));
			}
		}
	});
	
});

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#Doctor_visit_target_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#Doctor_visit_target_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#Order_target_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#Order_target_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#Collection_target_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#Collection_target_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

//Edit section
$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#prescription_edit_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#prescription_edit_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#Doctor_visit_edit_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#Doctor_visit_edit_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#Order_edit_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#Order_edit_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#Collection_edit_start" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#Collection_edit_end" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
        return date;
    }
});

