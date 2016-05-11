@extends('app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><b>2.</b> Check item BARCODE on cartobox</div>
                
                {!! Form::open(['url' => '/batch/checkbarcode_store']) !!}
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                {!! Form::hidden('batch_name', $name, ['class' => 'form-control']) !!}

                <div class="panel-body">
                    {!! Form::input('barcode', 'barcode', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
                </div>

                <div class="panel-body">
                    {!! Form::submit('Check', ['class' => 'btn btn-success btn-lg center-block']) !!}
                </div>

                @include('errors.list')

                {!! Form::close() !!}
                
            </div>
        </div>
    </div>
</div>
@endsection