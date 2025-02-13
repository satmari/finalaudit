@extends('app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">

             @if( $msg1 == "" )
                @else
                <div class="panel panel-danger">
                    <div class="panel-heading error danger">Error</div>

                        <div class="panel-body danger"> <span style="color:red;">{!! $msg1 !!}</span></div>

                </div>
            @endif
            
            <div class="panel panel-default">

                <div class="panel-heading"><b>3.</b> Count garments in cartobox box</div>

                {!! Form::open(['url' => '/batch/count_box_store']) !!}
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                {!! Form::hidden('batch_name', $batch_name, ['class' => 'form-control']) !!}
                
                <div class="panel-body">
                    {!! Form::input('number', 'count_box', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
                </div>

                <div class="panel-body">
                    {!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
                </div>

                @include('errors.list')

                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>
@endsection