@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Defect Level</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/defectlevel_insert']) !!}

						<div class="panel-body">
						<p>Defect Level ID: <span style="color:red;">*</span></p>
							{!! Form::text('defect_level_id', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Defect Level Name: <span style="color:red;">*</span></p>
							{!! Form::text('defect_level_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Pcs Rejected: <span style="color:red;">*</span></p>
							{!! Form::select('defect_level_rejected', array(''=>'','NO'=>'NO','YES'=>'YES'), null, array('class' => 'form-control')); !!} 
						</div>
						<!-- <div class="panel-body">
						<p>Pcs Rejected (bool):</p>
							{{-- {!! Form::select('pcs_rejected', array(0=>'NO',1=>'YES'), null, array('class' => 'form-control')); !!} --}}
						</div> -->
						
						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

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