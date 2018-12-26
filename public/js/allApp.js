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

});
