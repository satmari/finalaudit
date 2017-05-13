@extends('app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Select producer type</b></div>
                
                {!! Form::open(['url' => 'selectproducer']) !!}
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                <div class="panel-body">
                <p>Producer:</p>
                    {!! Form::select('type', ['EXTERNAL' => 'EXTERNAL', 'INTERNAL' => 'INTERNAL'], null,['class' => 'form-control']) !!}
                </div>

                <div class="panel-body">
                    {!! Form::submit('Select', ['class' => 'btn btn-success btn-lg center-block']) !!}
                </div>

                @include('errors.list')

                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>
@endsection