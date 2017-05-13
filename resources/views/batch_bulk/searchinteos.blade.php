@extends('app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Find CartonBox (BULK):</div>
                
                {!! Form::open(['method' => 'POST' , 'url' => 'searchinteos_store_bulk']) !!}
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                <br>
                
                <div class="panel-body">
                    {!! Form::input('number', 'cb_code', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
                </div>

                <div class="panel-body">
                    {!! Form::submit('Find CB', ['class' => 'btn btn-success btn-lg center-block']) !!}
                </div>

                @include('errors.list')

                {!! Form::close() !!}

                <hr>
                {!! Form::open(['method'=>'POST', 'url'=>'stop_store_bulk']) !!}
                
                {!! Form::submit('Bulk Batch completly scanned', ['class' => 'btn  btn-warning btn-lg center-block']) !!}
                {!! Form::close() !!}

                {{-- 
                <hr>
                {!! Form::open(['method'=>'POST', 'url'=>'stop_producer_store_bulk']) !!}         
                {!! Form::submit('Producer completly scanned', ['class' => 'btn  btn-danger btn-lg center-block']) !!}
                {!! Form::close() !!}
                --}}
                
                <br>


                
            </div>
        </div>
    </div>
</div>
@endsection