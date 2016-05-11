@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Model:</div>
				<br>
					{!! Form::model($model , ['method' => 'POST', 'url' => 'model/'.$model->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						
						<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
						</div> -->
						<div class="panel-body">
						<p>Model Name:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'model_name', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Model Brand:  <span style="color:red;">*</span></p>
							{!! Form::select('model_brand', array('TEZENIS'=>'TEZENIS','INTIMISSIMI'=>'INTIMISSIMI','CALZEDONIA'=>'CALZEDONIA'), null, array('class' => 'form-control')); !!} 
						</div>

						<div class="panel-body">
						<p>Model Category:  <span style="color:red;">*</span></p>
							{!! Form::select('category_id', $categories, $category_selected_id, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Mandatory to check: </p>
							{{-- {!! Form::checkbox('mandatory_to_check', 1, false, ['id' => 'check', 'class' => 'form-control']); !!} --}}
							{!! Form::select('mandatory_to_check', array('YES'=>'YES','NO'=>'NO'), null, array('class' => 'form-control')); !!}

						</div>
						<br>

					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{!! Form::open(['method'=>'POST', 'url'=>'/model/delete/'.$model->id]) !!}
					{!! Form::hidden('id', $model->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
					{!! Form::close() !!}
					
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/model')}}" class="btn btn-default">Back</a>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

@endsection