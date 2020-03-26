@extends('layouts.app')

@section('indexgraph')
<canvas id="piechart" height="75px" width="75px" class="col-sm-6"></canvas>
<script>
  var ctx = document.getElementById('piechart').getContext('2d');
  var myChart = new Chart(ctx, {
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
@endsection
@section('content')
    @if (count($profile) >0)
        <h2 style="text-align:center;" id="maintitle">List of victims</h2>
     @foreach ($profile as $profilelist)
     <div class="card">
    <div class="card bg-green col-sm-3" id="indexdisplay">
            <div class="card-body text-center text-white">
                <a href="/posts/{{$profilelist->id}}">
                    <div class="card-header text-center">
                        <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="" class="rounded" width="200px" height="200px">
                    </div>
                    <p id="text">Case {{$profilelist->id}}:</p>
            @if ($profilelist->type == 0)
                <p id="text">Forced Labour </p> 
            @elseif($profilelist->type == 1)
                <p id="text">Sexual Exploitation</p>
            @else
                <p id="text">Child Slavery</p> 
            @endif
        </a>
        </div>
      </div>
     </div>
        @endforeach
    @else 
        no post yet
    @endif
@endsection