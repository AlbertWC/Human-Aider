@extends('layouts.app')

@section('content')
    @if (count($profile) >0)
        @foreach ($profile as $profilelist)
        <div class="well">
                Case : {{$profilelist->id}}
                <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="" width="200px" height="200px">    
        </div>
        @endforeach
    @else 
    no post yet
    @endif
@endsection