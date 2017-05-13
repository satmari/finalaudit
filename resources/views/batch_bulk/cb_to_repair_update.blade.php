@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit:</div>
				<br>
					
				@if(Auth::check() && (Auth::user()->level() == 1) OR (Auth::user()->level() == 2))
					@if ($batch->repaired == 'NO')
					<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/cb_to_repair_bulk/reparied/'.$batch->id]) !!}
					{!! Form::hidden('id', $batch->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Carton Box Repaired', ['class' => 'btn  btn-danger /*btn-xs*/ center-block']) !!}
					{!! Form::close() !!}
					@else
					<p>Already repaired or not rejected</p>
					@endif
				@endif
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/cb_to_repair_bulk')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection