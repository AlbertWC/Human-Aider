@extends('layouts.app')

@section('content')
<div class="row" id=""> 
    @if (count($profile) > 0)
        @foreach ($profile as $profilelist)
        <div class="col-sm-4">
            <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="Victim_{{$profilelist->id}}" width="300px" height="300px">
        </div>
        <div class="col-sm-8">
            {{Form::open(['action'=> ['SawController@storeresult', $profilelist->id], 'method' => 'POST'])}}
                <input type="hidden" name="sawlat" id="sawlat">
                <input type="hidden" name="sawlon" id="sawlon">
                <script>
                if(navigator.geolocation)
                {
                    navigator.geolocation.getCurrentPosition(function(position)
                    {
                        let sawlat = position.coords.latitude;
                        let sawlon = position.coords.longitude;
                        document.getElementById('sawlat').value = position.coords.latitude;
                        document.getElementById('sawlon').value = position.coords.longitude;
                    });
                }
                </script>
                <h4>Did you saw this person at your current location </h4>
                <br>
                <p>Victim {{$profilelist->id}}</p>
                <br>
                <p>Description : {{$profilelist->description}}</p>
                <br>
                <p>Last seen location: {{$profilelist->address}}</p>

                <input type="hidden" name="id" id="{{$profilelist->id}}" value="{{$profilelist->id}}">
                <button type="submit" class="btn btn-primary" name="btnyes" id="btnyes" value="yes">Yes</button>
                <button type="submit" class="btn btn-danger" name="btnno" id="btnno" value="no">No</button>
             {{Form::close()}}
            @endforeach
            @else
            Current no Posts
            @endif
            {{$profile->links()}}

        </div>    

    </div>


@endsection