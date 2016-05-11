@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Category:</div>
				<br>
					{!! Form::model($category , ['method' => 'POST', 'url' => 'category/'.$category->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						
						<!-- <div class="panel-body">
						<span>Id:</span>
						{{--  {!! Form::input('number', 'id', null, ['class' => 'form-control']) !!} --}}
						</div> -->
						<!-- <div class="panel-body">
						<p>Category ID:  <span style="color:red;">*</span></p>
							{{-- {!! Form::input('string', 'category_id', null, ['class' => 'form-control']) !!} --}}
						</div> -->

						{!! Form::hidden('category_id', $category->category_id, ['class' => 'form-control']) !!}
						
						<div class="panel-body">
						<p>Category Name:  <span style="color:red;">*</span></p>
							{!! Form::input('string', 'category_name', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Name 1: </p>
							{!! Form::input('string', 'category_name_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Name 2: </p>
							{!! Form::input('string', 'category_name_2', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Description: </p>
							{!! Form::input('string', 'category_description', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Description 1: </p>
							{!! Form::input('string', 'category_description_1', null, ['class' => 'form-control']) !!}
						</div>
						<div class="panel-body">
						<p>Category Description 2: </p>
							{!! Form::input('string', 'category_description_2', null, ['class' => 'form-control']) !!}
						</div>

					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')

					{!! Form::close() !!}
					<br>
					
					{!! Form::open(['method'=>'POST', 'url'=>'/category/delete/'.$category->id]) !!}
					{!! Form::hidden('id', $category->id, ['class' => 'form-control']) !!}
					{!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
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