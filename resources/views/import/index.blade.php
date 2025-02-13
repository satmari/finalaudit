@extends('app')

@section('content')

<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">

		

			@if(Auth::check() && ((Auth::user()->level() == 5) OR (Auth::user()->level() == 1)))

			<div class="panel panel-default">
				<div class="panel-heading">Import <b>E-commerce</b> Excel file</div>

				{!! Form::open(['files'=>True, 'method'=>'POST', 'action'=>['ControllerImport@postImportEcommerce']]) !!}
					<div class="panel-body">
						{!! Form::file('file5', ['class' => 'center-block']) !!}
					</div>
					<div class="panel-body">
						{!! Form::submit('Import E-commerce', ['class' => 'btn btn-warning center-block']) !!}
					</div>
					@include('errors.list')
				{!! Form::close() !!}

			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Import <b>Size-set</b> Excel file</div>

				{!! Form::open(['files'=>True, 'method'=>'POST', 'action'=>['ControllerImport@postImportSizeset']]) !!}
					<div class="panel-body">
						{!! Form::file('file6', ['class' => 'center-block']) !!}
					</div>
					<div class="panel-body">
						{!! Form::submit('Import Size-set', ['class' => 'btn btn-warning center-block']) !!}
					</div>
					@include('errors.list')
				{!! Form::close() !!}

			</div>

			@endif
			

			
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection