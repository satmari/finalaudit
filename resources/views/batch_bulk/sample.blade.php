@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Info</div>
				<h3 style="color:blue;">Info !</h3>
				
				<p style="color:blue;"> {{ $msg1 }}</p>
				
				
				<div class="panel-body">
					<div class="">
						
						@if (Auth::check() && Auth::user()->level() == 4)
    						<a href="{{url('/')}}" class="btn btn-default center-block">Continue</a>
						@else
    						<a href="{{url('/batch_bulk/checkbarcode/'.$batch_name)}}" class="btn btn-default center-block">Continue</a>
						@endif

						<!-- '/batch/checkbarcode/'.$batch_name -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection