@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading h-b">Edit Defect Type:</div>
				<br>
					{!! Form::model($defect_type , ['method' => 'POST', 'url' => 'defecttype/'.$defect_type->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						
						<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
						</div> -->
						<div class="panel-body">
						<p>Defect Type ID:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'defect_type_id', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Name:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'defect_type_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Name 1: </p>
							{!! Form::input('string', 'defect_type_name_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Name 2: </p>
							{!! Form::input('string', 'defect_type_name_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Defect Type Description:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'defect_type_description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Description 1: </p>
							{!! Form::input('string', 'defect_type_description_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Type Description 2: </p>
							{!! Form::input('string', 'defect_type_description_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Defect Level Name:  <span style="color:red;">*</span></p>
							{!! Form::select('defect_level_id', $defect_levels, $defect_level_selected_id, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Defect Applay to all:  <span style="color:red;">*</span></p>
							{!! Form::select('defect_applay_to_all', array('NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>

					<div class="panel-body">
						{!! Form::submit('Edit', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{!! Form::open(['method'=>'POST', 'url'=>'/defecttype/delete/'.$defect_type->id]) !!}
					{!! Form::hidden('id', $defect_type->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
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