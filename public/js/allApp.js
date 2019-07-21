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

  $('.selectpicker').selectpicker();

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

  var first_name_sis = '';
  var first_name_local = '';

  first_name_sis = $('#ArabicFirstNameSIS').val();
  first_name_local = $('#ArabicFirstName').val();

  compare1(first_name_sis,first_name_local);

  $( "#ArabicFirstName" ).on('change', function(){
    first_name_local = $(this).val();
    first_name_sis = $('#ArabicFirstNameSIS').val();
    return compare1(first_name_sis,first_name_local);
  });


  function compare1(first_name_sis,first_name_local)
  {
    if(first_name_sis != first_name_local)
    {
      $('#ArabicFirstName').css('border-color', '#d9534f');
      //$(this).attr('data-title', $(this).attr('title'));
        $('#ArabicFirstName').attr("title", "Not Equal to SIS Value!");
      //alert("u cant apply");
      return false;
    }
    else {
      $('#ArabicFirstName').css('border-color', '');
      $('#ArabicFirstName').removeAttr('title');
      return true;
    }
  }

  var middle_name_sis = '';
  var middle_name_local = '';

  middle_name_sis = $('#ArabicMiddleNameSIS').val();
  middle_name_local = $('#ArabicMiddleName').val();

  compare2(middle_name_sis,middle_name_local);

  $( "#ArabicMiddleName" ).on('change', function(){
    middle_name_local = $(this).val();
    middle_name_sis = $('#ArabicMiddleNameSIS').val();
    return compare2(middle_name_sis,middle_name_local);
  });


  function compare2(middle_name_sis,middle_name_local)
  {
    if(middle_name_sis != middle_name_local)
    {
      $('#ArabicMiddleName').css('border-color', '#d9534f');
      //$(this).attr('data-title', $(this).attr('title'));
        $('#ArabicMiddleName').attr("title", "Middle Name Not Equal to SIS Value!");
      //alert("u cant apply");
      return false;
    }
    else {
      $('#ArabicMiddleName').css('border-color', '');
      $('#ArabicMiddleName').removeAttr('title');
      return true;
    }
  }

  var last_name_sis = '';
  var last_name_local = '';

  last_name_sis = $('#ArabicLastNameSIS').val();
  last_name_local = $('#ArabicLastName').val();

  compare3(last_name_sis,last_name_local);

  $( "#ArabicLastName" ).on('change', function(){
    last_name_local = $(this).val();
    last_name_sis = $('#ArabicLastNameSIS').val();
    return compare3(last_name_sis,last_name_local);
  });


  function compare3(last_name_sis,last_name_local)
  {
    if(last_name_sis != last_name_local)
    {
      $('#ArabicLastName').css('border-color', '#d9534f');
      //$(this).attr('data-title', $(this).attr('title'));
        $('#ArabicLastName').attr("title", "Last Name Not Equal to SIS Value!");
      //alert("u cant apply");
      return false;
    }
    else {
      $('#ArabicLastName').css('border-color', '');
      $('#ArabicLastName').removeAttr('title');
      return true;
    }
  }


});
