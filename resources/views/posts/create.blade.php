@extends('layouts.app')


@section('content')
<script>
    navigator.geolocation;
</script>
<script type='text/javascript'>
    function preview_image(event) 
    {
    var reader = new FileReader();
    reader.onload = function()
    {
    var output = document.getElementById('output_image');
    output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
    }
</script>
    {{Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype'=> 'multipart/form-data'] ) }}
    <div class="col">
        <h1 style="text-align:center;">Victim Profile</h1>
        <div class="col-sm-3">
            <div class="box">
                {{Form::label('Image', 'Upload Image')}}
                {{Form::file('victim_image', ['onchange' => 'preview_image(event)'])}}
                <img id="output_image" width="200px" height="200px">
                <br>
            </div>
        </div>
        <div class="col-sm-3">
        <div class="box">
            <br>
            {{Form::label('gender', 'Victim Gender')}}
            <br>
            {{Form::radio('gender','1')}} Male
            <br>
            {{Form::radio('gender','0')}} Female
            <br>
        </div>
            <div class="box ">
                {{Form::label('type', 'Type of Human Trafficking')}}
                <br>
                {{Form::select('type', array('0' => 'Forced Labour', '1' => 'Sexual Exploitation', '2' => 'Child Slavery'))}}    
            </div>
        </div>

        
        <div class="col-sm-6">
            <div class="box ">
                <br>
                {{Form::label('height' ,'Victim Approximate Height ')}}
                {{Form::number('height', '', ['class' => 'form-control', 'placeholder' => 'Height in cm' , 'min' => '110'])}}    
                {{Form::label('description' ,'Victim Dressing')}}
                {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Appearance'])}}    
            {{-- save current user location --}}
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lon" id="lon">
            <script>
            navigator.geolocation.getCurrentPosition(function(position)
            {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('lon').value = position.coords.longitude;
                
            },
            function()
            {
                alert('Please reactivate your device location at your browser to help the victim');
            }
            );  
                navigator.permissions.query({name:'geolocation'}).then(function(result) {
                    if (result.state == 'prompt') {
                    alert('Please enable location to help the victim');
                    }

                    });
            </script> 

                {{Form::label('ffname', 'Family / Friend Name')}}
                {{Form::text('ffname','' , ['class' => 'form-control', 'placeholder' => 'Insert If necessary'])}}
        
                {{Form::label('ffcontact', 'Family / Friend contact number')}}
                {{Form::text('ffcontact' , '' ,['class' => 'form-control', 'placeholder' => 'Insert If necessary'])}}    
                {{Form::submit('Submit', ['class' => 'btn btn-primary pull-right', 'id' => 'createpost'] )}}

            </div>
            
        </div> 




        {{Form::close()}}
    </div>

@endsection