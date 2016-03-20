@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading">Add new Category-DefectType link</div>
				<br>
					{!! Form::open(['method'=>'POST', 'url'=>'/categorydefecttype_insert']) !!}

						<div class="panel-body">
						<p>Defect Type Name: <span style="color:red;">*</span> </p>
							{!! Form::select('defect_type_id', $defect_types, null,['class' => 'form-control']) !!}
						</div>
					
						<div class="panel-body">
						<p>Category Name:  <span style="color:red;">*</span></p>
							{!! Form::select('category_id', $category, null,['class' => 'form-control']) !!}
						</div>

						{!! Form::submit('Link', ['class' => 'btn  btn-success center-block']) !!}

						@include('errors.list')

					{!! Form::close() !!}
				
				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/categorydefecttype')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection