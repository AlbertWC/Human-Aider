@extends('layouts.app')
<meta property="og:title" content="Case:{{$profile->type}}"/>
<meta property="og:type" content="website"/>
<meta property="og:description" content="Human Trafficking criminal"/>
<meta property="og:image" content="/storage/victim_image/{{$profile->victim_image}}"/>
<meta property="og:url" content="http://127.0.0.1:8000/posts/4"/>


@section('maps')

{{-- the locations database --}}
<script>var mapsarray = [];
var commentarray = [];</script>
@foreach ($maps as $item)

    {{-- create 2d array  --}}
    <script> var lat = parseFloat({{$item->lat}});</script>
    <script> var lon = parseFloat({{$item->lon}});</script>
    <script> var name = "{{$item->user->name}}";</script>
    <script> var array = new Array({{count($maps)}});</script>
    <script>
      array = [
        parseFloat({{$item->lat}}) ,parseFloat({{$item->lon}}) ,"{{$item->user->name}}" 
      ];
      mapsarray.push(array);
    </script>
@endforeach
@foreach ($comment as $commentlist)
    <script>var comment = "{{$commentlist->comment}}";</script>
    <script>
      var temparray =new Array({{count($comment)}});
      temparray = [
        "{{$commentlist->comment}}",
      ]
      commentarray.push(temparray);
    </script>
    
@endforeach


<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 60%;
      width: auto;
      margin-left: auto;
      margin-right: auto;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body>
  <script>console.log(mapsarray);
  console.log(commentarray);</script>
  <div id="map"></div>
  
  <script>
    
    var typespeed;
    var actualspeed = 1;
    function time(n)
    {
      var circle = new google.maps.Circle({
          map: map,
          strokeColor: "#000000",
          center: {lat: {{$profile->victimcurrentlat}}, lng: {{$profile->victimcurrentlon}}},
          fillColor: "#00FF00"
        })
        console.log(typevehicle);
      switch (typevehicle)
      {
        case "walking":
        circle.fillColor = "#00FF00";
        break;
        case "car": 
        circle.fillColor = "#FF0000";
        break;
        case "train": 
        circle.fillColor = "#0000FF";
        break;
        case "flight":
        circle.fillColor = "#FFFFFF";
        break;
      }
      switch (n)
      {
        case 15:
        actualspeed = typespeed * 15;
        console.log(actualspeed);
        break;
        case 30:
        actualspeed = typespeed * 30;
        console.log(actualspeed);
        break;
        case 45:
        actualspeed = typespeed * 45;
        console.log(actualspeed);
        break;
        case 60:
        actualspeed = typespeed * 60;
        console.log(actualspeed);
        break;
        case 180:
        actualspeed = typespeed * 180;
        console.log(actualspeed);
        break;
        case 360:
        actualspeed = typespeed * 360;
        console.log(actualspeed);
        break;
        case 720:
        actualspeed = typespeed * 720;
        console.log(actualspeed);
        break;
        case 1440:
        actualspeed = typespeed * 1440;
        console.log(actualspeed);
        break;
        case 2880:
        actualspeed = typespeed * 2880;
        console.log(actualspeed);
        break;   
      }
      circle.setRadius(actualspeed);
      circle.setMap(map); 
    }
    var typevehicle;
    function test(n)
      {

        switch (n)
        {
          case 0:
          typespeed = parseInt(document.getElementsByName('speed')[0].value);
          actualspeed = typespeed;
          typevehicle = "walking";
          console.log(typespeed);
          break;

          case 1:
          typespeed = parseInt(document.getElementsByName('speed')[1].value);
          actualspeed = typespeed;
          typevehicle = "car";
          console.log(typespeed);
          break;
          
          case 2:
          typespeed = parseInt(document.getElementsByName('speed')[2].value);
          actualspeed = typespeed;
          typevehicle = "train";
          console.log(typespeed);
          break;
        
          case 3:
          typespeed = parseInt(document.getElementsByName('speed')[3].value);
          actualspeed = typespeed;
          typevehicle = "flight";
          console.log(typespeed);
          break;
        } 
 
      }


    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: {{$profile->victimcurrentlat}}, lng: {{$profile->victimcurrentlon}} },
        zoom: 15
      });

      //default marker
      // latlon = {lat : {{$profile->victimcurrentlat}} , lng: {{$profile->victimcurrentlon}} };
      // var marker = new google.maps.Marker({
      //   position : latlon,
      //   title: 'albert testing here'
      // });

      for (let i = 0; i < mapsarray.length; i++) {
        addMarker({ 
          coords: {lat:mapsarray[i][0], lng:mapsarray[i][1]},
          content: mapsarray[i][2] + ":" +commentarray[i] , 
          });

      }
      
     
      console.log(actualspeed);



      // addmarker()
      function addMarker(props)
      {
        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
          
          
        });
        marker['infowindow'] = new google.maps.InfoWindow({
          content: props.content,
        });

        google.maps.event.addListener(marker, 'mouseover', function()
        {
          this['infowindow'].open(map, this);
          
        });
        google.maps.event.addListener(marker,'click', function()
        {
          this['infowindow'].close();
        });      


      }

    }

   </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVmmUEe9rAk8JKVDzWUJcXFToBpG023pA&callback=initMap"
   async defer>
  </script>
@endsection

@section('buttonfunc')
<div class="well">
    <div class="row">
      <label for="">Type of Vehicle</label>
      <br>
      <input type="radio" name="speed" id="walking" onclick="test(0);" value="60">Walking
      <br>
      <input type="radio" name="speed" id="speed" onclick="test(1);" value="833.33">Car
      <br>
      <input type="radio" name="speed" id="speed" onclick="test(2);" value="3333.33">Train
      <br>
      <input type="radio" name="speed" id="speed" onclick="test(3);" value="13333.3">Flight
      <br>
    </div>

    <div class="row">
  {{-- minutes radio --}}
  Minutes
      <input type="radio" name="typetime" onclick="time(15);" value="15">15 </button>
      <input type="radio" name="typetime" onclick="time(30);" value="30">30</button>
      <input type="radio" name="typetime" onclick="time(45);" value="45">45</button>
  
      <br>
  {{-- hours radio --}}
      Hours
      <input type="radio" name="typetime" onclick="time(60);" value="60">1</button>
      <input type="radio" name="typetime" onclick="time(180);" value="180">3</button>
      <input type="radio" name="typetime" onclick="time(360);" value="360">6</button>
      <input type="radio" name="typetime" onclick="time(720);" value="720">12</button>

      <br>

      {{-- days radio --}}
      Days
      <input type="radio" name="typetime" onclick="time(1440)" value="1440">1</button>
      <input type="radio" name="typetime" onclick="time(2880)" value="2880">2</button>

      <br>
    </div>
</div>
    
@endsection
{{-- @section('buttonfunc')
    <button  name="speed" id="speed"value="3600">Walk+Running</button>
    <button  name="speed" id="speed"value="50000">Car</button>
    <button  name="speed" id="speed"value="200000">Train</button>
    <button  name="speed" id="speed"value="800000">Flight</button>
@endsection --}}

@section('content')

  <div class="well">
    <div class="row">

      <div class="col-xs-4">
        <img src="/storage/victim_image/{{$profile->victim_image}}" alt="Victime_{{$profile->id}}" width="200px" height="200px">
      </div>

      <div class="col-xs-8">
      <h3>Case {{$profile->id}}: 
          @if ($profile->type == 0)
              Forced Labour
          @elseif($profile->type == 1)
              Sexual Exploitation
          @else
              Child Slavery
          @endif</h3>

          <h4> 
            Description : {{$profile->description}}
          </h4>
         
          <br>
          <h4>Find if you found this person, Please contact the number below: </h4>
          <h4>Name: {{$profile->ffname}}</h4>
          <h4>Contact: {{$profile->ffcontact}}</h4>
          
      </div>
    </div>
      {{-- add whatsapp function --}}
    <a href="whatsapp://send?text=Case:+ {{$profile->type}} URL: http://127.0.0.1:8000/posts/4" data-action="share/whatsapp/share">Share via Whatsapp</a>
    {{-- facebook share --}}

  </div>
@endsection

@section('comment')
    <h4>Comments: </h4>
 
    <div class="well">
        {{Form::open(['action' => ['PostController@addcomment', $profile->id], 'method' => 'POST']) }}
          {{Form::text('comment', '', ['class' => 'form-control', 'placeholder' => 'Insert your Comment here'])}}

          <input type="hidden" name="commentlat" id="commentlat">
          <input type="hidden" name="commentlon" id="commentlon">
          <script>
              if(navigator.geolocation)
              {
                  navigator.geolocation.getCurrentPosition(function(position)
                  {
                      let commentlat = position.coords.latitude;
                      let commentlon = position.coords.longitude;
                      document.getElementById('commentlat').value = position.coords.latitude;
                      document.getElementById('commentlon').value = position.coords.longitude;
                  });
              }
          </script>

          {{Form::submit('Comment' ,['class'=> 'btn btn-default'])}}
        {{Form::close()}}
    
      
      @if (count($comment) > 0)
        @foreach ($comment  as $commentlist)
        <div class="well">
          {{$commentlist->user->name}}: 
          <br>
          {{$commentlist->comment}}
        </div>
          <br>

        @endforeach
      @else
        No Comments        
      @endif
        
    </div>
    
    <br>
    
    
@endsection
    
