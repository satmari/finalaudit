@extends('app')

@section('content')

<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Activity Type</div>
                <br>
                    {!! Form::model($activity_type , ['method' => 'POST', 'url' => '/activity_type/update/'.$activity_type->id /*, 'class' => 'form-inline'*/]) !!}

                    <div class="panel-body">
                        
                        {{-- {!! Form::hidden('id', $activity_type->id, ['class' => 'form-control']) !!} --}}
                        
                        <div class="panel-body disabled">
                        <p>Activity Id:  <span style="color:red;">*</span></p>
                            {!! Form::input('string', 'activity_id', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
                        </div>
                        <div class="panel-body">
                        <p>Activity Desc: <span style="color:red;">*</span></p>
                            {!! Form::input('string', 'activity_desc', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="panel-body">
                        <p>Activity Desc 1:</p>
                            {!! Form::input('string', 'activity_desc1', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="panel-body">
                        <p>Activity Desc 2:</p>
                            {!! Form::input('string', 'activity_desc2', null, ['class' => 'form-control']) !!}
                        </div>

                    <div class="panel-body">
                        {!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
                    </div>

                    @include('errors.list')

                    {!! Form::close() !!}
                    <br>
                    
                    {!! Form::open(['method'=>'POST', 'url'=>'/activity_type/delete/'.$activity_type->id]) !!}
                    {!! Form::hidden('id', $activity_type->id, ['class' => 'form-control']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn  btn-danger btn-xs center-block']) !!}
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