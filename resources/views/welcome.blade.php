<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>COMJ E-RECORDS</title>

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Styles -->
      <style>
          html, body {
              background-color: #fff;
              color: #636b6f;
              font-family: 'Raleway', sans-serif;
              font-weight: normal;
              font-size: 16px;
              height: 100vh;
              margin: 0;
          }

          .full-height {
              height: 100vh;
          }

          .flex-center {
              align-items: center;
              display: flex;
              justify-content: center;
          }

          .position-ref {
              position: relative;
          }

          .top-right {
              position: absolute;
              left: 50%;
              transform: translate(-50%, 0);
              top: 50%;
              z-index: 1;
              height: auto;
          }

          .top-right > a {
            float: left;
            width: 75%;
              margin-top:6px;
              color: 	#f1f1f1;
              padding: 4px;
              background: #538f6e;
              font-size: 16px;
              font-weight: normal;
              letter-spacing: .1rem;
              text-decoration: none;
              text-transform: uppercase;
          }

            .top-right > button {
            margin-top:6px;
            float: left;
            width: 15%;
            padding: 4px;
            background: #3a7f59;
            color: white;
            font-size: 16px;
            border: 0.5px solid #3a7f59;
            border-left: none;
            cursor: pointer;
          }

          .top-right button:hover {
            background: #226f44;
          }

          .content {
              text-align: center;
          }

          .header {
            position: absolute;
            left: 15%;
            top:7%;
            z-index: 2;
          }

          .title {
            position: absolute;
            left: 15%;
            bottom:7%;
            z-index: 2;
            font-size: 40px;
            padding: 3px 6px 3px 6px;
            background: #f1f1f1;
            font-weight:bold;
            color: 	#0A6030;
            letter-spacing: .3rem;
          }

          form.search input[type=text] {
            padding: 4px;
            font-size: 16px;
            border: 0.5px solid #f1f1f1;
            float: left;
            width: 250px;
            height: 30px;
            background: #f1f1f1;
          }

          form.search button {
            float: left;
            width: 40px;
            height: 39px;
            padding: 4px;
            background: 	#A69229;
            color: white;
            font-size: 16px;
            border: 0.5px solid #A69229;
            border-left: none;
            cursor: pointer;
          }

          form.search button:hover {
            background: #958324;
          }

          *:focus {
            outline: none;
          }

          .error {
            color: red;
          }

      </style>
  </head>
  <body>
    <div class='header'>
      <img src={{ asset('logo/comj-logo.png')}} alt='COMJ Logo' height="87" width="385"/>
            </div>
      <div class='top-right'>
      <form method="get" action="{{ route('student.search') }}" enctype="multipart/form-data" class="search">
          <input type="text" placeholder="Search.." name="keyword"/>
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>

      <!--<a href="#">Summary Report</a><button onclick="window.location.href='#'"><i class="fa fa-chevron-right"></i></button>-->
      </div>

      <div class="flex-center position-ref full-height">
          <div class="content">
            <img src={{ asset('logo/comj.jpg')}} alt='KSAU-HS' height="720" width="1280"/>

          </div>
          <div class="title">
              <span style="color:#A69229">E</span>-RECORDS
          </div>
      </div>
  </body>
</html>
