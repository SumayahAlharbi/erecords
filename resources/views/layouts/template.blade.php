<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <title>Student E-Records</title>
</head>

<style>
ul.navbar-nav > li.nav-item > a.nav-link:focus, ul.navbar-nav > li.nav-item > a.nav-link:link,
ul.navbar-nav > li.nav-item > a.nav-link:visited, ul.navbar-nav > li.nav-item > a.nav-link:active{
  color:#0A6030;
}

ul.navbar-nav > li.nav-item > a.nav-link:hover{
  color:#3a7f59;
}
#main{
  background: #fbfaf6;
}
footer div.footer-copyright{
  color:#A18D2F;
}
div.container button.navbar-toggler{
  background:#A18D2F;
  padding: 5px 10px;
  color:white;
}
button.navbar-toggler > i{
  color:white;
}
</style>

<body>

  @if (!Auth::check())
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385" id="Logo"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @else
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385" id="Logo"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @role('male-manager|female-manager')
              <a class="dropdown-item" href="{{ route('manager.home') }}">Manager Dashboard</a>
              <a class="dropdown-item" href="{{ route('activity.log') }}">User Activity Log</a>
              @endrole
              @role('admin')
              <a class="dropdown-item" href="{{ route('admin.home') }}">Admin Dashboard</a>
              <a class="dropdown-item" href="{{ route('role.create') }}">Add Roles</a>
              <a class="dropdown-item" href="{{ route('permission.create') }}">Add Permission</a>
              <a class="dropdown-item" href="{{ route('permission.assign') }}">Assign Permission to Role</a>
              @endrole
              <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @role('male-manager|male-officer|female-officer|female-manager|admin')
        <form class="form-inline my-md-0" method="get" action="{{ route('student.search_result') }}">
          <input class="form-control" type="text" placeholder="Search" name="keyword">
        </form>
        @endrole
      </div>
    </div>
  </nav>
  @endif

  <main id="main">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© Copyright - College of Medicine - Jeddah</div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!--
  for roles and permissions list loader
-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<!--
for advanced search form select multiple options
-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.js"></script>

<script>
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
</script>

</body>
</html>
