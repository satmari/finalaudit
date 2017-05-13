@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add Tezenis BULK Batch line</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/batch_t_bulk_insert']) !!}

						<div class="panel-body">
						<p>Batch ID: <span style="color:red;">*</span></p>
							{!! Form::text('batch_id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
						</div>
						<div class="panel-body">
						<p>Pcs Box MIN: <span style="color:red;">*</span></p>
							{!! Form::number('batch_min', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Pcs Box MAX:  <span style="color:red;">*</span></p>
							{!! Form::number('batch_max', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Batch (Pcs to Check): <span style="color:red;">*</span> </p>
							{!! Form::number('batch_check', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Max Rejected Pcs Accepted: <span style="color:red;">*</span></p>
							{!! Form::number('batch_reject', null, ['class' => 'form-control']) !!}
						</div>
						
						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/batch_t_bulk')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection