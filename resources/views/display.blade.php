@extends('layouts.app')

@section('display')
{{-- barchartpop --}}

<div class="col-sm-4">
    <div class="chart-container-pop">
    <canvas id="popchart"></canvas>
    <script>
      var ctx = document.getElementById('popchart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['Male', 'Female'],
              datasets: [{
                  label: [['Male']],
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
    {{-- piechart --}}

      <div class="col-sm-4">
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
    {{-- line graph --}}
    <div class="col-sm-4">
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

    {{-- <table>
        <tr>
            <th>State</th>
            <th>Total Case</th>

        </tr>
        <tr>
            @foreach ($posts as $profilelist)
                <td>{{$profilelist->state}}</td>
                @foreach ($posts as $profilelistcounter)
                    
                    @if ($profilelistcounter->state == $profilelist->state)
                        @php
                            $casecounter+=1;
                        @endphp
                    @endif
                    <td>{{$casecounter}}</td>
                @endforeach
            @endforeach
        </tr>
    </table> --}}
    {{-- combined bar --}}
    <div class="col">
        <div class="chart-container-combined">
        <canvas id="combinedchart"></canvas>
        <script>
          var combinedctx = document.getElementById('combinedchart').getContext('2d');
          var myChart = new Chart(combinedctx, {
              type: 'bar',
              data: {
                  labels: ["Johor", "Kuala Lumpur" , "Labuan", "Putrajaya", "Kedah","Kelantan", "Malacca", "Negeri Sembilan","Pahang","Perak","Perlis","Penang", "Sabah","Sarawak","Selangor","Terengganu"],
                  datasets: [{
                      label: 'Victims',
                      data: [{{$johor}},{{$kualalumpur}},{{$labuan}},{{$putrajaya}},{{$kedah}},{{$kelantan}},{{$malacca}},{{$negerisembilan}},{{$pahang}},{{$perak}},{{$perlis}},{{$penang}},{{$sabah}},{{$sarawak}},{{$selangor}}, {{$terengganu}}],
                      backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',

                      ],
                      borderColor: [
                        'rgba(54, 162, 235, 0.2)',

                      ],
                      borderWidth: 1
                  },
                  {
                    label: 'Line Dataset',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',


                      ],
                      borderColor: [
                        'rgba(255, 99, 132, 0.2)',


                      ],

                    // Changes this dataset to become a line
                    type: 'bar'
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
    </div>
    
@endsection
