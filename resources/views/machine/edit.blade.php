@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Machine:</div>
				<br>
					{!! Form::model($machine , ['method' => 'POST', 'url' => 'machine/'.$machine->id /*, 'class' => 'form-inline'*/]) !!}

					<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
					</div> -->
					<div class="panel-body">
						<span>Machine Id: <span style="color:red;">*</span></span>
						{!! Form::input('string', 'machine_id', null, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<span>Machine type: <span style="color:red;">*</span></span>
						{!! Form::input('string', 'machine_type', null, ['class' => 'form-control']) !!}
					</div>
					<div class="panel-body">
						<span>Machine Description:</span>
						{!! Form::input('string', 'machine_description', null, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{!! Form::open(['method'=>'POST', 'url'=>'/machine/delete/'.$machine->id]) !!}
					{!! Form::hidden('id', $machine->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
					{!! Form::close() !!}
					
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/machine')}}" class="btn btn-default">Back</a>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

@endsection