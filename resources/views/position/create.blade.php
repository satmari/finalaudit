@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Position</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/position_insert']) !!}

						<div class="panel-body">
						<p>Position ID: <span style="color:red;">*</span></p>
							{!! Form::text('position_id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
						</div>
						<div class="panel-body">
						<p>Position Name: <span style="color:red;">*</span></p>
							{!! Form::text('position_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Name 1: </p>
							{!! Form::text('position_name_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Name 2: </p>
							{!! Form::text('position_name_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Position Description: </p>
							{!! Form::text('position_description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Description 1: </p>
							{!! Form::text('position_description_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Position Description 2: </p>
							{!! Form::text('position_description_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p><b>Position Applay to all: </b></p>
							{!! Form::select('position_applay_to_all', array(''=>'','NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>
						
						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

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