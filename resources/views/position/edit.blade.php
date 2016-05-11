@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Position:</div>
				<br>
					{!! Form::model($position , ['method' => 'POST', 'url' => 'position/'.$position->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						
						<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
						</div> -->
						<!-- <div class="panel-body">
						<p>Position ID:  <span style="color:red;">*</span></p>
							{{-- {!! Form::input('string', 'position_id', null, ['class' => 'form-control']) !!} --}}
						</div> -->

						{!! Form::hidden('position_id', $position->position_id, ['class' => 'form-control']) !!}

						<div class="panel-body">
						<p>Position Name:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'position_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Name 1: </p>
							{!! Form::input('string', 'position_name_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Name 2: </p>
							{!! Form::input('string', 'position_name_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Position Description: </p>
							{!! Form::input('string', 'position_description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Description 1: </p>
							{!! Form::input('string', 'position_description_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Description 2: </p>
							{!! Form::input('string', 'position_description_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p><b>Position Applay to all: </b></p>
							{!! Form::select('position_applay_to_all', array(''=>'','NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>

					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{!! Form::open(['method'=>'POST', 'url'=>'/position/delete/'.$position->id]) !!}
					{!! Form::hidden('id', $position->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
					{!! Form::close() !!}
					
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/position')}}" class="btn btn-default">Back</a>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

@endsection