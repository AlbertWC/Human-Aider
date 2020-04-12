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
                        
                   @if (count($posts) > 1 )
                       <h4>Post you created</h4>
                       <table class="table table-striped">
                           <tr>
                               <th>Case</th>
                               <th>View</th>
                           </tr>
                           @foreach ($posts as $postslist)
                            <tr>
                                <th>
                                    <img src="/storage/victim_image/{{$postslist->victim_image}}" width="200px" height="200px"alt="Victim {{$postslist->id}}">    
                                </th>
                                <th>
                                    <a href="/posts/{{$postslist->id}}" class="btn btn-info">View Post</a>
                                </th>
                            </tr>
                        @endforeach      
                       </table>
                                       
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
