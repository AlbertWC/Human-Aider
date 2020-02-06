@extends('layouts.app')


@section('content')
    {{Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype'=> 'multipart/form-data'] ) }}
        
        <h1>Victim Profile</h1>
        {{Form::label('type', 'Type of Human Trafficking')}}
        {{Form::select('type', array('0' => 'Forced Labour', '1' => 'Sexual Exploitation', '2' => 'Child Slavery'))}}
        
        <br>

        {{Form::label('height' ,'Victim Approximate Height in cm')}}
        {{Form::number('height', '', ['class' => 'form-control', 'placeholder' => 'Height' , 'min' => '110'])}}
        
        {{Form::label('description' ,'Victim Dressing')}}
        {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Appearance'])}}
    
        {{Form::label('Image', 'Upload Image')}}
        {{Form::file('victim_image')}}
        <br>

        {{Form::label('gender', 'Victim Gender')}}
        <br>
        {{Form::radio('gender','1')}} Male
        <br>
        {{Form::radio('gender','0')}} Female
        <br>

        {{-- save current user location --}}
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lon" id="lon">
        <script>
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function(position)
                {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lon').value = position.coords.longitude;
                    
                });
            }
        </script>  
        {{Form::label('ffname', 'Family / Friend Name')}}
        {{Form::text('ffname','' , ['class' => 'form-control', 'placeholder' => 'Insert If necessary'])}}

        {{Form::label('ffcontact', 'Family / Friend contact number')}}
        {{Form::text('ffcontact' , '' ,['class' => 'form-control', 'placeholder' => 'Insert If necessary'])}}

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}


    {{Form::close()}}
@endsection