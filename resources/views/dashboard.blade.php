@extends('layouts.template')
<script type="text/javascript" src="{{ asset('js/charts.min.js') }}"></script>
@section('content')

<section class="section">
  <div class="container text-center">
    <div class="card-deck mb-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-center">
          <h6 class="m-0 font-weight-bold text-primary">Student Status</h6>
        </div>
        <div class="card-body h-100">
          <a href="/student/advanced_search_result?Status%5B%5D=Enrolled+Active" class="btn btn-labeled btn-success col-md-6 mb-2">
            <span class="btn-label"><i class="fas fa-book-reader"></i></span> Enrolled Active ({{$sis[0]}})</a>

            <a href="/student/advanced_search_result?Status%5B%5D=Postponed" class="btn btn-labeled btn-danger col-md-6 mb-2">
              <span class="btn-label"><i class="fas fa-highlighter"></i></span> Postponed ({{$sis[1]}})</a>

              <a href="/student/advanced_search_result?Status%5B%5D=Graduated" class="btn btn-labeled btn-primary col-md-6 mb-2">
                <span class="btn-label"><i class="fas fa-user-graduate"></i></span> Graduated ({{$sis[2]}})</a>

                <a href="/student/advanced_search_result?Status%5B%5D=Dismissed" class="btn btn-labeled btn-warning col-md-6 mb-2">
                  <span class="btn-label"><i class="fas fa-door-open"></i></span> Dismissed ({{$sis[3]}})</a>

                  <a href="/student/advanced_search_result?Status%5B%5D=Withdrawn" class="btn btn-labeled btn-light col-md-6 mb-2">
                    <span class="btn-label"><i class="fas fa-pause"></i></span> Withdrawal ({{$sis[4]}})</a>

                    <a href="/student/advanced_search_result?Status%5B%5D=Record+Closed" class="btn btn-labeled btn-dark col-md-6 mb-2">
                      <span class="btn-label"><i class="fab fa-expeditedssl"></i></span> Record Closed ({{$sis[5]}})</a>

                      <a href="/student/advanced_search_result?Status%5B%5D=Cancelled" class="btn btn-labeled btn-info col-md-6 mb-2">
                        <span class="btn-label"> <i class="fas fa-door-closed"></i></span> Cancelled ({{$sis[6]}})</a>
                      </div>
                    </div>

                    <div class="card shadow mb-4">
                      <div class="card-header py-3 d-flex align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-primary">Active Student Graduation Batch</h6>
                      </div>
                      <div class="card-body h-100">
                        <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="active_students" width="301" height="245" class="chartjs-render-monitor" style="display: block; width: 301px; height: 245px;"></canvas>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-deck mb-3">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-center">
                      <h6 class="m-0 font-weight-bold text-primary">Postponed Student Graduation Batch</h6>
                    </div>
                    <div class="card-body h-100">
                      <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                      <canvas id="postponed_students" width="301" height="245" class="chartjs-render-monitor" style="display: block; width: 301px; height: 245px;"></canvas>
                    </div>
                  </div>
                </div>

                <div class="card shadow mb-4">
                  <div class="card-header py-3 d-flex align-items-center justify-content-center">
                    <h6 class="m-0 font-weight-bold text-primary">Student Updates</h6>
                  </div>
                  <div class="card-body h-100">
                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="myAreaChart" style="display: block; width: 667px; height: 320px;" width="667" height="320" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </section>

        <script type="text/javascript">
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Raleway,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';
        Chart.defaults.global.defaultFontSize= 14;

        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: {!! json_encode($month_array) !!},
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

        var ctx = document.getElementById("active_students");
        var local = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: {!! json_encode($active_labels) !!},
            datasets: [{
              data: {!! json_encode($total_active) !!},
              backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e','#e74a3b', '#858796', '#36b9cc','#000000'],
              hoverBackgroundColor: ['#2e59d9', '#17a673', '#ddae37','#cf4235', '#777987', '#30a6b7','#000000'],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
          },
          options: {
            title: {
              display: true,
              text: 'Total Active Student =  {{$total_active_stu}}',
            },
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
              callbacks: {
              label: function(tooltipItem, data) {
                //get the concerned dataset
                var dataset = data.datasets[tooltipItem.datasetIndex];
                //calculate the total of this data set
                var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                  return previousValue + currentValue;
                });
                //get the current items value
                var currentValue = dataset.data[tooltipItem.index];
                //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                var percentage = Math.floor(((currentValue/total) * 100)+0.5);

                return percentage + " %";
              }
            }
            },
            legend: {
              display: true
            },
            cutoutPercentage: 80,
          },
        });

        var ctx = document.getElementById("postponed_students");
        var local = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: {!! json_encode($postponed_labels) !!},
            datasets: [{
              data: {!! json_encode($total_postponed) !!},
              backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e','#e74a3b', '#858796', '#36b9cc','#000000'],
              hoverBackgroundColor: ['#2e59d9', '#17a673', '#ddae37','#cf4235', '#777987', '#30a6b7','#000000'],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
          },
          options: {
            responsive: true,
            title: {
              display: true,
              text: 'Total Postponed Student =  {{$total_postponed_stu}}'
            },
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
              callbacks: {
              label: function(tooltipItem, data) {
                //get the concerned dataset
                var dataset = data.datasets[tooltipItem.datasetIndex];
                //calculate the total of this data set
                var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                  return previousValue + currentValue;
                });
                //get the current items value
                var currentValue = dataset.data[tooltipItem.index];
                //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                var percentage = Math.floor(((currentValue/total) * 100)+0.5);

                return percentage + " %";
              }
            }
            },
            legend: {
              display: true
            },
            cutoutPercentage: 80,
          },
        });

        </script>

        @endsection
