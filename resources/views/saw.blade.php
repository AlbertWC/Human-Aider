@extends('layouts.app')

@section('content')
        <div class="col-lg-6 col-lg-offset-3 col-xs-6 col-xs-offset-3">
            <div class="row">
            
                @foreach ($profile as $profilelist)

                <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="Victim_{{$profilelist->id}}" width="200px" height="200px">
 
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
                            console.log(sawlat);
                            console.log(sawlon);
                        });
                    }
                    </script>
                    <p>Did you saw this person </p>
                    <input type="hidden" name="id" id="{{$profilelist->id}}" value="{{$profilelist->id}}">
                    <button type="submit" class="btn btn-primary" id="btnyes" value="1">Yes</button>
                    <button type="submit" class="btn btn-danger" id="btnno" value="0">No</button>
                {{Form::close()}}
            </div>
        
        {{$profile->links()}}
        </div>
           @endforeach

@endsection