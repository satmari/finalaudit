@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit:</div>
				<br>
					
				@if(Auth::check() && Auth::user()->level() == 100)

					{!! Form::model($batch , ['method' => 'POST', 'url' => '/batch/'.$batch->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						<span>Id:</span>
						{!! Form::input('number', 'id', null, ['class' => 'form-control']) !!}
					</div>
										
					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')
					{!! Form::close() !!}

				@endif

				@if((Auth::check() && (Auth::user()->level() == 2)) OR (Auth::check() && (Auth::user()->level() == 1)))
					
						<br>
						{!! Form::open(['method'=>'POST', 'url'=>'/bonus_relevant/'.$batch->id]) !!}
						{!! Form::hidden('id', $batch->id, ['class' => 'form-control']) !!}
						<p>Bonus relevant</p>
						
						{!! Form::select('bonus', array('YES'=>'YES','NO'=>'NO'), null, array('class' => 'form-control')); !!} 

						<br>
						{!! Form::submit('Confirm', ['class' => 'btn  btn-success /*btn-xs*/ center-block']) !!}
						@include('errors.list')
						{!! Form::close() !!}
					
				@endif
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/bonus_relevant_page')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection