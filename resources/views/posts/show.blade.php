@extends('layouts.app')


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


      var circle = new google.maps.Circle({
        map: map,
        center: {lat: {{$profile->victimcurrentlat}}, lng: {{$profile->victimcurrentlon}} },
        radius: 0,
        strokeColor: "#FFFFFF",
        strokeWeight: 3,
        fillColor: "#00FF00",
      })

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

      circle.setMap(map);
    }

   </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVmmUEe9rAk8JKVDzWUJcXFToBpG023pA&callback=initMap"
   async defer>
  </script>

    <input type="radio" name="speed" id="typevehicle1" value="3600">Walk+Running
    <input type="radio" name="speed" value="50000">Car
    <input type="radio" name="speed" value="200000">Train
    <input type="radio" name="speed"  value="800000">Flight
    <br>

    
    {{-- minutes radio --}}
    Minutes
    <input type="radio" name="typetime"  value="15">15 </button>
    <input type="radio" name="typetime"  value="30">30</button>
    <input type="radio" name="typetime"  value="45">45</button>
    
    <br>
    {{-- hours radio --}}
    Hours
    <input type="radio" name="typetime" value="1">1</button>
    <input type="radio" name="typetime" value="3">3</button>
    <input type="radio" name="typetime" value="6">6</button>
    <input type="radio" name="typetime" value="12">12</button>

    <br>

    {{-- days radio --}}
    Days
    <input type="radio" name="typetime"  value="1">1</button>
    <input type="radio" name="typetime"  value="2">2</button>

    <br>

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
    
