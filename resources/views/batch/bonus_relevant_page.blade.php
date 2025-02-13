@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Please insert password:</div>
				<br>
				
						<br>
						{!! Form::open(['method'=>'POST', 'url'=>'bonus_relevant_page_access' ]) !!}
				
						<p>Password:</p>
						{!! Form::text('pass', null, array('class' => 'form-control')) !!}
						<br>
						{!! Form::submit('Confirm', ['class' => 'btn  btn-success /*btn-xs*/ center-block']) !!}
						@include('errors.list')
						{!! Form::close() !!}
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/bonus_relevant_page')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection