@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Status:</div>
				<br>
					
				@if(Auth::check() && Auth::user()->level() == 1)

					{!! Form::model($batch , ['method' => 'POST', 'url' => '/batch_bulk/edit_status_update/'.$batch->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						<span>Status: <span style="color:red;">*</span></span>
						{!! Form::select('batch_status', array('Accept'=>'Accept','Reject'=>'Reject','Suspend'=>'Suspend','Not checked'=>'Not checked'), null, array('class' => 'form-control')); !!} 
					</div>
										
					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')
					{!! Form::close() !!}

				@endif

				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/batch_bulk')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection