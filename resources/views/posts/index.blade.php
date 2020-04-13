@extends('layouts.app')

@section('content')
    @if (count($notsolvedprofile) >0 || count($solvedprofile) > 0)
        <h2 style="text-align:center;" id="maintitle">List of victims</h2>
     @foreach ($notsolvedprofile as $profilelist)

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

        @endforeach
        @foreach ($solvedprofile as $solvedprofilelist)
        <div class="well bg-red col-sm-3" id="solvedindexdisplay">
            <div class="card-body text-center text-white">
                <a href="/posts/{{$solvedprofilelist->id}}">
                    <div class="card-header text-center">
                        <img src="/storage/victim_image/{{$solvedprofilelist->victim_image}}" alt="" class="rounded" width="200px" height="200px">
                    </div>
                    <p id="text">Case {{$solvedprofilelist->id}}:</p>
            @if ($solvedprofilelist->type == 0)
                <p id="text">Forced Labour </p> 
            @elseif($solvedprofilelist->type == 1)
                <p id="text">Sexual Exploitation</p>
            @else
                <p id="text">Child Slavery</p> 
            @endif
        </a>
        </div>
      </div>

        @endforeach
        @else 
        <h2 style="text-align: center;">No Post</h2>
    @endif
@endsection