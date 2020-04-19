@extends('layouts.app')

@section('display')
{{-- barchartpop --}}

<div class="col-sm-4 col-md-4 col-lg-4">
    <div class="chart-container-pop">
    <canvas id="popchart"></canvas>
    <script>
      var ctx = document.getElementById('popchart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'doughnut',
          
          data: {
              labels: ['Male', 'Female'],
              datasets: [{
                  label: ['Male', 'Female'],
                  data: [{{$male}}, {{$female}}],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
            title:{
              display: true,
              text: 'Population of Victim'
          },
            //   scales: {
            //       yAxes: [{
            //           ticks: {
            //               beginAtZero: true
            //           }
            //       }]
            //   }
          }
      });
      </script>
    </div>
</div>
    {{-- piechart --}}

<div class="col-sm-4 col-md-4 col-lg-4">
    <div class="chart-container-pie">
        <canvas id="piechart"></canvas>
        <script>
        var piectx = document.getElementById('piechart').getContext('2d');
        var myChart = new Chart(piectx, {
            type: 'pie',
            data: {
                labels: ['Case child', 'Case sexual','Case forced'],
                datasets: [{
                    label: "total cases",
                    data: [{{$child}},{{$sexual}},{{$forced}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(0, 230, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(0, 230, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            },
                options: {
                    title: 
                    {
                    display: true,
                    text: "Number of Cases Reported",
                    
                    },
                    legend:
                    {
                        display: true,
                        position: 'bottom',
                        fontColor: "#000080",
                    }
                //   scales: {
                //       yAxes: [{
                //           ticks: {
                //               beginAtZero: true
                //           }
                //       }]
                //   }
                }
        });
        </script>
    </div>
</div>

<div class="col-sm-4 col-md-4 col-lg-4">
    <table class="table table-borderless" id="table">
        <tr>
            <th></th>
            <th colspan="3">Type of case</th>
        </tr>
        <tr>
            <th rowspan="1">State</th>
            <th>Sexual</th>
            <th>Child</th>
            <th>Forced</th>
        </tr>
        <tr>
            
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
    {{-- month line graph --}}
<div class="col-sm-6 col-md-6 col-lg-6">
    <div class="chart-container-linepop">
    <canvas id="linepopchart"></canvas>
    <script>
        var ctx = document.getElementById('linepopchart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb" , "Mar", "Apr", "May","Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
                datasets: [{
                    label: 'Victims',
                    data: [{{$jancase}},{{$febcase}},{{$marcase}},{{$aprcase}},{{$maycase}},{{$juncase}},{{$julcase}},{{$augcase}},{{$sepcase}},{{$octcase}},{{$novcase}},{{$deccase}},],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
            title:
            {
                display: true,
                text: 'New cases reported'
            },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
    </div>
</div>

    
    {{-- state bar --}}
<div class="col-sm-6 col-md-6 col-lg-6">
    <div class="chart-container-combined">
    <canvas id="combinedchart"></canvas>
    <script>
        var combinedctx = document.getElementById('combinedchart').getContext('2d');
        var myChart = new Chart(combinedctx, {
            type: 'line',
            data: {
                labels: ["Johor", "Kuala Lumpur" , "Labuan", "Putrajaya", "Kedah","Kelantan", "Malacca", "Negeri Sembilan","Pahang","Perak","Perlis","Penang", "Sabah","Sarawak","Selangor","Terengganu"],
                datasets: [{
                    label: 'Number of cases',
                    data: [{{$johor}},{{$kualalumpur}},{{$labuan}},{{$putrajaya}},{{$kedah}},{{$kelantan}},{{$malacca}},{{$negerisembilan}},{{$pahang}},{{$perak}},{{$perlis}},{{$penang}},{{$sabah}},{{$sarawak}},{{$selangor}}, {{$terengganu}}],
                    backgroundColor: [
                    'rgba(70, 50, 235, 0.2)'

                    ],
                    borderColor: [
                    'rgba(0, 0, 235, 0.2)',

                    ],
                //   borderWidth: 1
                }]
            },
            options: {
            title:{
            display: true,
            text: 'Cases reported in state of Malaysia'
        },
            //   scales: {
            //       yAxes: [{
            //           ticks: {
            //               beginAtZero: true
            //           }
            //       }]
            //   }
            }
        });
        </script>
    </div>
</div>
    
@endsection
{{-- <div class="col-sm-6 col-md-6 col-lg-6">
    <div class="chart-container-linepop">
    <canvas id="time"></canvas>
    <script>
      var ctx = document.getElementById('time').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: ["Jan", "Feb" , "Mar", "Apr", "May","Jun", "Jul", "Aug","Sep","Oct","Nov","Dec"],
              datasets: [{
                  label: 'Victims',
                  data: [{{$jancase}},{{$febcase}},{{$marcase}},{{$aprcase}},{{$maycase}},{{$juncase}},{{$julcase}},{{$augcase}},{{$sepcase}},{{$octcase}},{{$novcase}},{{$deccase}},],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',

                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',

                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
      </script>
    </div>
</div> --}}