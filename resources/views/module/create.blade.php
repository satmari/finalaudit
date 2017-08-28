@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Module</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/module_insert']) !!}

						<!-- <div class="panel-body">
						<p>Model ID: <span style="color:red;">*</span></p>
							{{-- {!! Form::text('id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!} --}}
						</div> -->
						<div class="panel-body">
						<p>Module Name: <span style="color:red;">*</span></p>
							{!! Form::text('module', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Mandatory to count peaces: <span style="color:red;">*</span></p>
							{!! Form::select('count_box', array('NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>
						
						<br>

						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
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