@extends('layouts.app')

@section('content')
    {{Form::open(['action' => 'PostController@search', 'method' => 'get'])}}
    <div class="search" id="search">
            {{Form::text('search', '', ['class'=>'', 'placeholder' => 'Search'])}}
            {{Form::submit('Search',['class' => 'btn btn-info'])}}      
</div>
    {{Form::close()}}
    {{-- @if (count($notsolvedprofile) >0 || count($solvedprofile) > 0) --}}
        <h2 style="text-align:center;" id="maintitle">List of victims</h2>
     @if (count($profile) > 0)
         
        @foreach ($profile as $profilelist)
        @if ($profilelist->status == 0)
            <div class="well bg-green col-sm-3" id="indexdisplay">
                <div class="card-body text-center text-white">
                    <a href="/posts/{{$profilelist->id}}">
                        <div class="card-header text-center">
                            <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="" class="rounded" width="200px" height="200px">
                        </div>
                        <p id="text">Case {{$profilelist->id}}:</p>
                        @if ($profilelist->type == 0)
                            <p id="text">Forced Labour </p> 
                        @elseif($profilelist->type == 1)
                            <p id="text">Sexual Exploitation</p>
                        @else
                            <p id="text">Child Slavery</p> 
                        @endif
                    </a>
                </div>
            </div>
        @else
        <div class="well bg-red col-sm-3" id="solvedindexdisplay">
            <div class="card-body text-center text-white">
                <a href="/posts/{{$profilelist->id}}">
                    <div class="card-header text-center">
                        <img src="/storage/victim_image/{{$profilelist->victim_image}}" alt="" class="rounded" width="200px" height="200px">
                    </div>
                    <p id="text">Case {{$profilelist->id}}:</p>
                    @if ($profilelist->type == 0)
                        <p id="text">Forced Labour </p> 
                    @elseif($profilelist->type == 1)
                        <p id="text">Sexual Exploitation</p>
                    @else
                        <p id="text">Child Slavery</p> 
                    @endif
                </a>
                </div>
            </div>
        @endif
    

        @endforeach
        
        @else 
        <h2 style="text-align: center;">No Post</h2>
    @endif
@endsection