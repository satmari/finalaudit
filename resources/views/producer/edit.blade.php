@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Producer:</div>
				<br>
					{!! Form::model($producer , ['method' => 'POST', 'url' => 'producer/'.$producer->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						
						{!! Form::hidden('producer_id', $producer->producer_id, ['class' => 'form-control']) !!}
						
						<div class="panel-body">
						<p>Producer Name:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'producer_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Producer Type: <span style="color:red;">*</span></p>
							{!! Form::select('producer_type', ['EXTERNAL' => 'EXTERNAL', 'INTERNAL' => 'INTERNAL'], null,['class' => 'form-control']) !!}
						</div>
						
					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{{--
					{!! Form::open(['method'=>'POST', 'url'=>'/producer/delete/'.$producer->id]) !!}
					{!! Form::hidden('id', $producer->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
					{!! Form::close() !!}
					--}}
					
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/producer')}}" class="btn btn-default">Back</a>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

@endsection