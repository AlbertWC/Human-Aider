@extends('layouts.app')
@section('maps')
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 50%;
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
  <div id="map"></div>
  <script>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: {{$profile->victimcurrentlat}}, lng: {{$profile->victimcurrentlon}} },
        zoom: 17
      });

      latlon = {lat : {{$profile->victimcurrentlat}} , lng: {{$profile->victimcurrentlon}} };
      var marker = new google.maps.Marker({
        position : latlon,
        title: 'albert testing here'
      });
      marker.setMap(map);
    }

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVmmUEe9rAk8JKVDzWUJcXFToBpG023pA&callback=initMap"
  async defer></script>
@endsection

@section('content')
    
@endsection
    
