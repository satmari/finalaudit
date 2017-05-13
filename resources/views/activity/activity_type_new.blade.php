@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Activity Type</div>
                <br>
                    {!! Form::open(['method'=>'POST', 'url'=>'/activity_type_insert/']) !!}

                        <div class="panel-body">
                        <p>Activity Type ID: <span style="color:red;">*</span></p>
                            {!! Form::text('activity_id', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="panel-body">
                        <p>Activity Description: <span style="color:red;">*</span></p>
                            {!! Form::text('activity_desc', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="panel-body">
                        <p>Activity Description 1:</p>
                            {!! Form::text('activity_desc1', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="panel-body">
                        <p>Activity Description 2:</p>
                            {!! Form::text('activity_desc2', null, ['class' => 'form-control']) !!}
                        </div>
                    
                        {!! Form::submit('Add', ['class' => 'btn  btn-success center-block']) !!}

                        @include('errors.list')

                    {!! Form::close() !!}
                
                <hr>
                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/activity_type')}}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection