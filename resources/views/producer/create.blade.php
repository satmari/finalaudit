@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Producer</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/producer_insert']) !!}

						<div class="panel-body">
						<p>Producer Id: <span style="color:red;">*</span></p>
							{!! Form::text('producer_id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
						</div>
						<div class="panel-body">
						<p>Producer Name: <span style="color:red;">*</span></p>
							{!! Form::text('producer_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Producer Type </p>
							{!! Form::select('producer_type', ['EXTERNAL' => 'EXTERNAL', 'INTERNAL' => 'INTERNAL'], null,['class' => 'form-control']) !!}
						</div>
						
						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
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