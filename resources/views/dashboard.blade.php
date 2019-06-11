@extends('layouts.template')
<script type="text/javascript" src="{{ asset('js/charts.min.js') }}"></script>
@section('content')

<section class="section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie"></i> SIS Students</h6>
          </div>
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="sis" width="301" height="245" class="chartjs-render-monitor" style="display: block; width: 301px; height: 245px;"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Graduated
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Enrolled Active
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-warning"></i> Postponed
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-danger"></i> Withdrawal
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-secondary"></i> Dismissed
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Cancelled
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-dark"></i> Record Closed
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie"></i> Local Students</h6>
        </div>
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <canvas id="local" width="301" height="245" class="chartjs-render-monitor" style="display: block; width: 301px; height: 245px;"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Alumni
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Intern
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-warning"></i> Active
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-danger"></i> Postponed
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-secondary"></i> Dismissed
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-info"></i> Withdrawal
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-dark"></i> Transfer
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
      </div>
      <div class="card-body">
        <h4 class="small font-weight-bold">SF Male Manger<span class="float-right">{{$users[0]}}%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $users[0];?>%" aria-valuenow="{{$users[0]}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">SF Female Mangers<span class="float-right">{{$users[1]}}%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $users[1];?>" aria-valuenow="{{$users[1]}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">SF Male Officers<span class="float-right">{{$users[2]}}%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar" role="progressbar" style="width: <?php echo $users[2];?>%" aria-valuenow="{{$users[2]}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">SF Female Officers<span class="float-right">{{$users[3]}}%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $users[3];?>%" aria-valuenow="{{$users[3]}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Admins<span class="float-right">{{$users[4]}}%</span></h4>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $users[4];?>%" aria-valuenow="{{$users[4]}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Student Updates</h6>
      </div>
      <div class="card-body">
        <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <canvas id="myAreaChart" style="display: block; width: 667px; height: 320px;" width="667" height="320" class="chartjs-render-monitor"></canvas>
      </div>
    </div>
  </div>
</div>
</div>

</div>

</section>

<script type="text/javascript">
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Local Chart
var ctx = document.getElementById("local");
var local = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Alumni", "Intern", "Active", "Postponed", "Dismissed", "Withdrawal", "Transfer"], //ALUMNI INTERN ACTIVE POSTPONED DISMISSED WITHDRAWAL TRANSFER
    datasets: [{
      data: {!! json_encode($local) !!},
      backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e','#e74a3b', '#858796', '#36b9cc','#000000'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#ddae37','#cf4235', '#777987', '#30a6b7','#000000'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

// SIS Chart
var ctx = document.getElementById("sis");
var local = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Graduated", "Enrolled Active", "Postponed", "Withdrawal","Dismissed", "Cancelled", "Record Closed"], // Enrolled Active Dismissed Postponed Withdrawn Graduated Cancelled Record Closed
    datasets: [{
      data: {!! json_encode($sis) !!},
      backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e','#e74a3b', '#858796', '#36b9cc','#000000'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#ddae37','#cf4235', '#777987', '#30a6b7','#000000'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: {!! json_encode($month_array) !!},
    //['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    //labels: ['jan','oct'],
    //response.months, // The response got from the ajax request containing all month names in the database
    datasets: [{
      label: "Updates",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: {!! json_encode($updates_array) !!},
      //data: [20,30,80]
      //response.post_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          //response.max, // The response got from the ajax request containing max limit for y axis
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

</script>

@endsection
