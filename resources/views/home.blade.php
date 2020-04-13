@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                       <h4>Post you created</h4>
                       <table class="table table-striped">
                           <tr>
                               <th>Case</th>
                               <th>View</th>
                           </tr>
                           @foreach ($notsolvedposts as $postslist)
                            <tr>
                                <th>
                                    <img src="/storage/victim_image/{{$postslist->victim_image}}" width="200px" height="200px"alt="Victim {{$postslist->id}}">    
                                </th>
                                <th>
                                    <a href="/posts/{{$postslist->id}}" class="btn btn-info">View Post</a>
                                    {{Form::open(['action' => ['HomeController@solvedcase', $postslist->id], 'method' => 'PUT'])}}
                                    <input type="hidden" id="postid">

                                    <button type="submit" value="1">Case solved</button>
                                    {{Form::close()}}
                                </th>
                            </tr>
                            
                        @endforeach
                       </table>  
                        <table class="table table-striped">
                        <h4>Case already solved</h4>
                        <tr>
                            <th>Case</th>
                            <th>Status</th>    
                        </tr>    
                        @foreach ($solvedposts as $solvedpostslist)
                            <tr>
                                <td>
                                    <a href="/posts/{{$solvedpostslist->id}}"><img src="/storage/victim_image/{{$solvedpostslist->victim_image}}" width="200px" height="200px" alt="Victim_image {{$solvedpostslist->id}}"></a> 
                                </td>
                                <td>Case Closed</td>
                            </tr>
                        @endforeach
                       </table>
                                       
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
