@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Error</div>
				<h3 style="color:red;">Error!</h3>
				<p style="color:red;">{{ $msg }}</p>
				<p style="color:red;">{{-- $msg  Sorry you made mistake, try again.--}}</p>

				<div class="panel-body">
					<div class="">
						
						@if (Auth::check() && Auth::user()->level() == 4)
    						<a href="{{url('/')}}" class="btn btn-default center-block">Continue</a>
						@else
    						<a href="{{url('/batch')}}" class="btn btn-default center-block">Continue</a>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection