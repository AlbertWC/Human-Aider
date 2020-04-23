@extends('layouts.app')

@section('content')
<div class="col-sm-4">
    <img src="/storage/victim_image/{{$post->victim_image}}" alt="" width="300px" height="300px">
</div>
<div class="col-sm-8">

    <h4>
    Case ID: {{$post->id}}
    <br>
    Type : 
    @if ($post->type == 0)
        Sexual Exploitation
    @elseif($post->type == 1)
        Forced Labour 
    @else
        child Slavery
    @endif
    </h4>
    <h4>
        Description: {{$post->description}}
        <br>
        Location: {{$post->address}}
        <br>
        Informant: {{$post->ffname}}
        <br>
        Contact number : {{$post->ffcontact}}
    </h4>
    <h5><a href="/posts/{{$post->id}}">View post</a></h5>
    <h5>Report made time: {{$post->created_at}}</h5>

</div>


@endsection