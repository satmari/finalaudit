@extends('app')

@section('content')
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><b>2. Scan/write audit barcode</b> </div>

                <div class="alert alert-primary" role="alert">

                  <big><b>
                    <p>Ovde prvo unesete smenu operatera pa skenirate barkod od operatera koji je pregledao kutiju.</p>
                    <p>ili</p>
                    <p>Ako name barkod operatera: Skenirate RS barkod.</p>
                    </b>
                </big>

                </div>



                {!! Form::open(['url' => '/batch/scan_cont_post']) !!}
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

                {!! Form::hidden('batch_name', $name, ['class' => 'form-control']) !!}
                {!! Form::hidden('module', $module, ['class' => 'form-control']) !!}
                Shift:
                <div class="panel-body">
                    
                    {!! Form::select('shift', array(''=>'','A'=>'A','B'=>'B'), null, array('class' => 'form-control')); !!} 
                </div>

                Audit:
                <div class="panel-body">
                    {!! Form::input('audit', 'audit', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
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