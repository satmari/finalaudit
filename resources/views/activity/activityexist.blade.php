@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">

                @if(Auth::check() && Auth::user()->level() == 2)
                    
                    <div class="row">
                        <div class="text-center col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Existing Activity</div>
                                @foreach ($activitylog as $req)
                                <div>
                                    <br>
                                	<table class="table table-striped table-bordered" id="sort" >
                                		<tr>
                                			<td>Activity Type:</td>
                                			<td><b>{{ $req->activity_desc }}</b></td>
                                		</tr>
                                		<tr>
                                			<td>Start:</td>
                                			<td><b>{{ $req->start }}</b></td>
                                		</tr>
                                		
                                	</table>
                                </div>
                                <hr>
                                <div>
                                    <a href="{{url('/activity_stop/'.$req->id) }}" class="btn btn-danger btn-default">Stop Activity</a>

                                </div>
                                <br>
                                @endforeach

                            </div>
                        </div>
                    </div>

                @endif

                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/activity')}}" class="btn btn-default">Back</a>
                    </div>
                </div>

         </div>
    </div>
</div>
@endsection