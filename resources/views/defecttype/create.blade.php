@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Defect Type</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/defecttype_insert']) !!}

						<div class="panel-body">
						<p>Defect Type ID: <span style="color:red;">*</span></p>
							{!! Form::text('defect_type_id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Name: <span style="color:red;">*</span></p>
							{!! Form::text('defect_type_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Name 1: </p>
							{!! Form::text('defect_type_name_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Name 2: </p>
							{!! Form::text('defect_type_name_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Defect Type Description: </p>
							{!! Form::text('defect_type_description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Description 1: </p>
							{!! Form::text('defect_type_description_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Description 2: </p>
							{!! Form::text('defect_type_description_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p><b>Defect Level Name: </b></p>
							{{-- {!! Form::text('defect_level_id', null, ['class' => 'form-control']); !!} --}}
							{!! Form::select('defect_level_id', ['' => ''] + $defect_levels, null,['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p><b>Defect Applay to all: </b></p>
							{!! Form::select('defect_applay_to_all', array(''=>'','NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>
						
						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/defecttype')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection