@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Category</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/category_insert']) !!}

						<div class="panel-body">
						<p>Category ID: <span style="color:red;">*</span></p>
							{!! Form::text('category_id', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
						</div>
						<div class="panel-body">
						<p>Category Name: <span style="color:red;">*</span></p>
							{!! Form::text('category_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Name 1: </p>
							{!! Form::text('category_name_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Name 2: </p>
							{!! Form::text('category_name_2', null, ['class' => 'form-control']) !!}
						</div>

						<div class="panel-body">
						<p>Category Description: </p>
							{!! Form::text('category_description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Description 1: </p>
							{!! Form::text('category_description_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Description 2: </p>
							{!! Form::text('category_description_2', null, ['class' => 'form-control']) !!}
						</div>

						{!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/category')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection