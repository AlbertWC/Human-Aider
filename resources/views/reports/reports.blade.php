@extends('layouts.app')

@section('content')
    @foreach ($posts as $list)
    @if ($list->status == 0)
        
    <a href="/admin/report/{{$list->id}}">
        <div class="well"> 
            Case : {{$list->id}}
            <br>
            Location: {{$list->address}}
            <br>
            Contact: {{$list->ffname}} , {{$list->ffcontact}}
     
        </div>
    </a>
    @endif
    
    @endforeach

@endsection