@extends('layouts.app')

@section('content')
    @if (count($profile) >0)
        @foreach ($profile as $profilelist)
        <div class="well">
        <a href="/posts/{{$profilelist->id}}">Case {{$profilelist->id}}: 
            @if ($profilelist->type == 0)
                Forced Labour
            @elseif($profilelist->type == 1)
                Sexual Exploitation
            @else
                Child Slavery
                
            @endif
        
        </a>
                <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="" width="200px" height="200px">    
        </div>
        @endforeach
    @else 
        no post yet
    @endif
@endsection