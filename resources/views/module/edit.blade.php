@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Module:</div>
				<br>
					{!! Form::model($module , ['method' => 'POST', 'url' => 'module/'.$module->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						
						<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
						</div> -->


						<div class="panel-body">
						<p>Module Name:</p>
							{!! Form::input('string', 'module', null, ['class' => 'form-control']) !!}
							{{-- {!!	$module->module !!} --}}
						</div>

						<div class="panel-body">
						<p>Mandatory to count peaces: <span style="color:red;">*</span></p>
							{!! Form::select('count_box', array('NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>

						<br>

					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{{-- 
					{!! Form::open(['method'=>'POST', 'url'=>'/module/delete/'.$module->id]) !!}
					{!! Form::hidden('id', $module->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
					{!! Form::close() !!}
					--}}

				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/module')}}" class="btn btn-default">Back</a>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

@endsection 