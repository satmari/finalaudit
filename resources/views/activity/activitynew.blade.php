@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Activity</div>
                <br>
                    {!! Form::open(['method'=>'POST', 'url'=>'/activity_insert/']) !!}

                        <div class="panel-body">
                        <p>Activity Type: <span style="color:red;">*</span> </p>
                            {!! Form::select('activity_type_id', ['' => ''] + $activity_types, null,['class' => 'form-control']) !!}
                        </div>
                    
                        {!! Form::submit('Start Activity', ['class' => 'btn  btn-success center-block']) !!}

                        @include('errors.list')

                    {!! Form::close() !!}
                
                <hr>
                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/activity')}}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection