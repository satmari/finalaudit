@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Category-Position link</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/categoryposition_insert']) !!}

						<div class="panel-body">
						<p>Position Name: </p>
							{!! Form::select('position_id', $positions, null,['class' => 'form-control']) !!}
						</div>
					
						<div class="panel-body">
						<p>Category Name: </p>
							{!! Form::select('category_id', $category, null,['class' => 'form-control']) !!}
						</div>

						{!! Form::submit('Link', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/categoryposition')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection