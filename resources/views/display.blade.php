@extends('layouts.app')

@section('display')
    <canvas id="popchart"></canvas>
    <script>
      var ctx = document.getElementById('popchart').getContext('2d');
      ctx.canvas.width = '600px';
      ctx.canvas.height = '50px';
      ctx.canvas.maintainAspectRatio = false;
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['No', 'Yes'],
              datasets: [{
                  label: 'Population of User',
                  data: [1,2],
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
    {{-- <canvas id="piechart" class="col-sm-6"></canvas>
    <script>
      var piectx = document.getElementById('piechart').getContext('2d');
      piectx.canvas.width = 300;
      piectx.canvas.height = 300;
      var myChart = new Chart(piectx, {
          type: 'pie',
          data: {
              labels: ['Case child', 'Case sexual','Case forced'],
              datasets: [{
                  label: "total cases",
                  data: [1,2,3],
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
      </script> --}}

@endsection
