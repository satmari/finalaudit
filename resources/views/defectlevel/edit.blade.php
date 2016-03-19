@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Defect Level:</div>
				<br>
					{!! Form::model($defect_level , ['method' => 'POST', 'url' => 'defectlevel/'.$defect_level->id /*, 'class' => 'form-inline'*/]) !!}

					<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
					</div> -->
					<div class="panel-body">
						<span>Defect Level Id:</span>
						{!! Form::input('string', 'defect_level_id', null, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<span>Defect Level Name:</span>
						{!! Form::input('string', 'defect_level_name', null, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<span>Defect Level Rejected:</span>
						{{-- {!! Form::input('string', 'defect_level_rejected', null, ['class' => 'form-control']) !!} --}}
						{!! Form::select('defect_level_rejected', array('NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
					</div>
					<!-- <div class="panel-body">
						<span>Defect Level Rejected (Bool):</span>
						{{-- {!! Form::input('string', 'pcs_rejected', null, ['class' => 'form-control']) !!} --}}
						{{-- {!! Form::select('pcs_rejected', array(0=>'NO',1=>'YES'), null, array('class' => 'form-control')); !!} --}}
					</div> -->

					<div class="panel-body">
						{!! Form::submit('Edit', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{!! Form::open(['method'=>'POST', 'url'=>'/defectlevel/delete/'.$defect_level->id]) !!}
					{!! Form::hidden('id', $defect_level->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
					{!! Form::close() !!}
					
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/defectlevel')}}" class="btn btn-default">Back</a>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

@endsection