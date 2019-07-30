window.onscroll = function() {
  growShrinkLogo();
};

function growShrinkLogo() {
  var Logo = document.getElementById("Logo");
  if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
    Logo.style.width = '190px';
    Logo.style.height = '45px';
    $(".navbar-dark").css('background-color', 'White');
  } else {
    Logo.style.width = '385px';
    Logo.style.height = '87px';
    $(".navbar-dark").css('background-color', 'transparent');
  }
}

$(document).ready(function() {

   /*
   $('#addStudent-form').validate({
    rules: {

	    	'new_students[]': {required: true}
	    },
	    messages: {

        'checkboxes[]': "You must check at least 1 box",

        },
	    highlight: function(label) {
	    	$(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }

	  });
    */

  $('.selectpicker').selectpicker();

  $('#selectAll').click(function() {
        if ($(this).prop('checked')) {
            $('.new_students_list').prop('checked', true);
        } else {
            $('.new_students_list').prop('checked', false);
        }
    });

  $('select[name="role_id"]').on('change', function(){
    var roleID = $(this).val();
    if(roleID) {
      $.ajax({
        url: 'dynamic_dependent/ajax/'+roleID,
        type:"GET",
        dataType:"json",
        beforeSend: function(){
          $('#loader').css("visibility", "visible");
        },

        success:function(data) {

          $('#permission_list').empty();

          $.each(data[0], function(key, value){
            $('#permission_list').append('<label class="container2">'+value+'<input type="checkbox" name="permission_id[]" value="'+ key +'" checked><span class="checkmark"></span></label>');
          });

          $.each(data[1], function(key, value){
            $('#permission_list').append('<label class="container2">'+ value['name'] +'<input type="checkbox" name="permission_id[]" value="'+ value['id'] +'"><span class="checkmark"></span></label>');
          });

        },
        complete: function(){
          $('#loader').css("visibility", "hidden");
        }
      });
    } else {
      $('#permission_list').empty();
    }

  });

  // Initialize tooltip component
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

  var first_name_sis = '';
  var first_name_local = '';

  first_name_sis = $('#ArabicFirstNameSIS').val().replace(" ", "");
  first_name_local = $('#ArabicFirstName').val().replace(" ", "");

  compare1(first_name_sis,first_name_local);

  $( "#ArabicFirstName" ).on('change', function(){
    first_name_local = $(this).val().replace(" ", "");
    first_name_sis = $('#ArabicFirstNameSIS').val().replace(" ", "");
    return compare1(first_name_sis,first_name_local);
  });


  function compare1(first_name_sis,first_name_local)
  {
    if(first_name_sis != first_name_local)
    {
      //$('#ArabicFirstName').css('border-color', '#d9534f');
      //$(this).attr('data-title', $(this).attr('title'));
      //$('#ArabicFirstName').attr("title", "Not Equal to SIS Value!");
      //alert("u can't apply");
      $('#ArabicFirstNameSISTooltip').show();
      //$('#ArabicFirstName').tooltip('enable');
      return false;
    }
    else {
      //$('#ArabicFirstName').css('border-color', '');
      //$('#ArabicFirstName').removeAttr('title');
      $('#ArabicFirstNameSISTooltip').hide();
      //$('#ArabicFirstName').tooltip('enable');
      //$('#ArabicFirstNameSISTooltip').hide();
      //$('#ArabicFirstName').tooltip('disable');
      return true;
    }
  }

  var middle_name_sis = '';
  var middle_name_local = '';

  middle_name_sis = $('#ArabicMiddleNameSIS').val().replace(" ", "");
  middle_name_local = $('#ArabicMiddleName').val().replace(" ", "");

  compare2(middle_name_sis,middle_name_local);

  $( "#ArabicMiddleName" ).on('change', function(){
    middle_name_local = $(this).val().replace(" ", "");
    middle_name_sis = $('#ArabicMiddleNameSIS').val().replace(" ", "");
    return compare2(middle_name_sis,middle_name_local);
  });


  function compare2(middle_name_sis,middle_name_local)
  {
    if(middle_name_sis != middle_name_local)
    {
      //$('#ArabicMiddleName').css('border-color', '#d9534f');
      //$(this).attr('data-title', $(this).attr('title'));
      //$('#ArabicMiddleName').attr("title", "Middle Name Not Equal to SIS Value!");
      //alert("u cant apply");
      //$('#ArabicMiddleName').tooltip('enable');
      $('#ArabicMiddleNameSISTooltip').show();
      return false;
    }
    else {
      //$('#ArabicMiddleName').css('border-color', '');
      //$('#ArabicMiddleName').removeAttr('title');
      //$('#ArabicMiddleName').tooltip('enable');
      //alert("u cant apply");
      $('#ArabicMiddleNameSISTooltip').hide();
      return true;
    }
  }

  var last_name_sis = '';
  var last_name_local = '';

  last_name_sis = $('#ArabicLastNameSIS').val().replace(" ", "");
  last_name_local = $('#ArabicLastName').val().replace(" ", "");

  compare3(last_name_sis,last_name_local);

  $( "#ArabicLastName" ).on('change', function(){
    last_name_local = $(this).val().replace(" ", "");
    last_name_sis = $('#ArabicLastNameSIS').val().replace(" ", "");
    return compare3(last_name_sis,last_name_local);
  });


  function compare3(last_name_sis,last_name_local)
  {
    if(last_name_sis != last_name_local)
    {
      //$('#ArabicLastName').css('border-color', '#d9534f');
      //$(this).attr('data-title', $(this).attr('title'));
      //$('#ArabicLastName').attr("title", "Last Name Not Equal to SIS Value!");
      //alert("u cant apply");
      //$('#ArabicLastName').tooltip('enable');
      $('#ArabicLastNameSISTooltip').show();
      return false;
    }
    else {
      //$('#ArabicLastName').css('border-color', '');
      //$('#ArabicLastName').removeAttr('title');
      //$('#ArabicLastName').tooltip('enable');
      $('#ArabicLastNameSISTooltip').hide();
      return true;
    }
  }


});
