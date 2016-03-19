@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Model</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/model_insert']) !!}

						<!-- <div class="panel-body">
						<p>Model ID: <span style="color:red;">*</span></p>
							{{-- {!! Form::text('id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
						</div> -->
						<div class="panel-body">
						<p>Model Name: <span style="color:red;">*</span></p>
							{!! Form::text('model_name', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Model Brand: <span style="color:red;">*</span></p>
							{!! Form::select('model_brand', array('TEZENIS'=>'TEZENIS','INTIMISSIMI'=>'INTIMISSIMI','CALZEDONIA'=>'CALZEDONIA'), null, array('class' => 'form-control')); !!} 
						</div>
						
						<div class="panel-body">
						<p>Model Category: <span style="color:red;">*</span></p>
							{!! Form::select('category_id', $categories, null,['class' => 'form-control']) !!}
						</div>

						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

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