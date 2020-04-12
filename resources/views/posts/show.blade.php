@extends('layouts.app')
<meta property="og:title" content="Case:{{$profile->type}}"/>
<meta property="og:type" content="website"/>
<meta property="og:description" content="Human Trafficking criminal"/>
<meta property="og:image" content="/storage/victim_image/{{$profile->victim_image}}"/>
{{-- <meta property="og:url"/> --}}


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
    table{
      border: 1px;
      border-color: black;
    }
  </style>
</head>
<body>
  <script>console.log(mapsarray);
  console.log(commentarray);</script>
      <div class="col">
        <div id="map"></div>
      </div>
    
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVmmUEe9rAk8JKVDzWUJcXFToBpG023pA&callback=initMap&libraries=geometry"
  async defer>
 </script>
  <script>
    var yescounter = 0;
    var totalcounter = 0;
    function time(n)
    {
      
      var circle = new google.maps.Circle({
          map: map,
          strokeColor: "#000000",
          center: {lat: {{$profile->victimcurrentlat}}, lng: {{$profile->victimcurrentlon}}},
          fillColor: "#00FF00",
        });
      
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
      var actualspeed = 1;
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
      var center = new google.maps.LatLng({{$profile->victimcurrentlat}},{{$profile->victimcurrentlon}});
      // console.log(center);
      for(let i = 0 ; i < mapsarray.length; i++)
      {
        var eachmarkerpos = new google.maps.LatLng(mapsarray[i][0],mapsarray[i][1]);
        // console.log(eachmarkerpos);
        var computed = google.maps.geometry.spherical.computeDistanceBetween(center,eachmarkerpos);
        console.log(computed);
        totalcounter++;
        if(computed < actualspeed)
        {
          console.log("yes");
          yescounter++;
          var newmark = new google.maps.LatLng({lat:mapsarray[i][0], lng:mapsarray[i][1]});
          var newcomment = mapsarray[i][2]  + ":" + commentarray[i];
          var newmarker = new google.maps.Marker({
            position: newmark,
            icon: " http://maps.google.com/mapfiles/ms/icons/pink-dot.png", 
          });

          newmarker['infowindow'] = new google.maps.InfoWindow({
            content: newcomment,
          });

          google.maps.event.addListener(newmarker, 'mouseover', function()
          {
            this['infowindow'].open(map, this);
            
          });
          google.maps.event.addListener(newmarker,'click', function()
          {
            this['infowindow'].close();
          });     
          newmarker.setMap(map);
        }
      
      }
      circle.setMap(map);
    }

  
    var typevehicle;
    function test(n)
    {
      switch (n)
      {
        case 0:
        typespeed = parseInt(document.getElementsByName('speed')[0].value);
        typevehicle = "walking";
        break;

        case 1:
        typespeed = parseInt(document.getElementsByName('speed')[1].value);
        typevehicle = "car";
        break;
        
        case 2:
        typespeed = parseInt(document.getElementsByName('speed')[2].value);
        typevehicle = "train";
        break;
      
        case 3:
        typespeed = parseInt(document.getElementsByName('speed')[3].value);
        typevehicle = "flight";
        break;
      } 
    }

    function addMarker(props)
    {
      marker = new google.maps.Marker({
        position:props.coords,
        map:map,
        icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
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
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: {{$profile->victimcurrentlat}}, lng: {{$profile->victimcurrentlon}} },
        zoom: 15
      });

      //default marker
      
      for (let i = 0; i < mapsarray.length; i++) {
        
        addMarker({ 
          coords: {lat:mapsarray[i][0], lng:mapsarray[i][1]},
          content: mapsarray[i][2] + ":" +commentarray[i] , 
          });
      }

      

      // addmarker()
      

    }
   </script>

  
@endsection

@section('buttonfunc')
<div class="col" id="btnfunction">
  <div class="well">
    <div class="row">
      <div class="a">
      Type of Vehicle
      <br>
      <input type="radio" name="speed" id="walking" onclick="test(0);" value="60">Walking
      <input type="radio" name="speed" id="speed" onclick="test(1);" value="833.33">Car
      <input type="radio" name="speed" id="speed" onclick="test(2);" value="3333.33">Train
      <input type="radio" name="speed" id="speed" onclick="test(3);" value="13333.3">Flight
      <br>
      Time
      <br>
      Minutes
      <input type="radio" name="typetime" onclick="time(15);" value="15">15</button>
      <input type="radio" name="typetime" onclick="time(30);" value="30">30</button>
      <input type="radio" name="typetime" onclick="time(45);" value="45">45</button>
      <br>
      Hours
      <input type="radio" name="typetime" onclick="time(60);" value="60">1</button>
      <input type="radio" name="typetime" onclick="time(180);" value="180">3</button>
      <input type="radio" name="typetime" onclick="time(360);" value="360">6</button>
      <br>
      Days
      <input type="radio" name="typetime" onclick="time(720);" value="720">12</button>
      <input type="radio" name="typetime" onclick="time(1440)" value="1440">1</button>
      <input type="radio" name="typetime" onclick="time(2880)" value="2880">2</button>
      </div>

    </div>
  </div>
</div>

@endsection
{{-- @section('buttonfunc')
    <button  name="speed" id="speed"value="3600">Walk+Running</button>
    <button  name="speed" id="speed"value="50000">Car</button>
    <button  name="speed" id="speed"value="200000">Train</button>
    <button  name="speed" id="speed"value="800000">Flight</button>
@endsection --}}

@section('profile')
<div class="row-sm-6" id="contentdisplay">
  <div class="well" >
    <div class="row">
      <div class="col-sm-3">
        <img src="/storage/victim_image/{{$profile->victim_image}}" alt="Victim_{{$profile->id}}" width="170px" height="170px" class="center">
      </div>
      <div class="col-sm-9">

        <h4>
        Case {{$profile->id}}: 
          @if ($profile->type == 0)
              Forced Labour
          @elseif($profile->type == 1)
              Sexual Exploitation
          @else
              Child Slavery
          @endif
        </h4>
          <h5> 
            Description : {{$profile->description}}
          </h5>
          <h5>Gender: 
            @if($profile->gender == 0)
            Female
            @else
            Male
          @endif 
        </h5>
          <h5>Last seen Location: {{$profile->address}}
          <h5>Find if you found this person, Please contact the number below: </h5>
          <h5>Name: {{$profile->ffname}}</h5>
          <h5>Contact: {{$profile->ffcontact}}</h5>
          {{-- add whatsapp function --}}
          <a href="https://wa.me/?text=https://www.a165727.heliohost.org/posts/{{$profile->id}}, There is a person missing who {{$profile->description}}">Share this</a>
          {{-- saw this victim  --}}
          <h5>Do saw this person?</h5>
          <br>
          {{Form::open(['action' => ['PostController@update', $profile->id] ,'method' => 'PUT'  ])}}
          <input type="hidden" name="sawprofilelat" id="commentlat">
          <input type="hidden" name="sawprofilelon" id="commentlon">
          <script>
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function(position)
                {
                    let sawprofilelat = position.coords.latitude;
                    let sawprofilelon = position.coords.longitude;
                    document.getElementById('sawprofilelat').value = position.coords.latitude;
                    document.getElementById('sawprofilelon').value = position.coords.longitude;
                });
            }
        </script>
          <button type="submit" class="btn btn-primary" name="btnyes" id="btnyes" value="yes">Yes</button>
          <button type="submit" class="btn btn-danger" name="btnno" id="btnno" value="no">No</button>
            {{Form::close()}}
        </div>
    </div>
  </div>
</div>
@endsection

@section('comment')

    <div class="col">
      <div class="card">
        <div class="well">
        <h4>{{$commentcounter}} comments:</h4>
        @if (count($comment) > 0)
          @foreach ($comment  as $commentlist)
          <div class="well">
            {{$commentlist->user->name}}: 
            <br>
            Comment: {{$commentlist->comment}}
            <br>
            Time post: {{$commentlist->created_at}}
            <br>
            @if (Auth::guard('web')->check())
            {{Form::open(['action' => ['PostController@deletecomment', $commentlist->id],'method' => 'POST'])}}
            {{Form::hidden('_method' , 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger pull-right'])}}
          {{Form::close()}}
            @endif
             
          </div>
            <br>
            
          @endforeach
        @else
          No Comments        
        @endif
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
        </div>
      </div>
    </div>
    
    <br>
    
    
@endsection

