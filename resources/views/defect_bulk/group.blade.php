@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
                <div class="panel-heading">Batch Table</div>
                {{--
                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/batch_new')}}" class="btn btn-default btn-info">New Batch</a>
                    </div>
                </div>
                --}}
                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/searchinteos')}}" class="btn btn-default btn-info">New Batch</a>
                    </div>
                </div>

                <div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>

                <table class="table table-striped table-bordered" id="sort" 
                >
                <!--
                data-show-export="true"
                data-export-types="['excel']"
                data-search="true"
                data-show-refresh="true"
                data-show-toggle="true"
                data-query-params="queryParams" 
                data-pagination="true"
                data-height="300"
                data-show-columns="true" 
                data-export-options='{
                         "fileName": "preparation_app", 
                         "worksheetName": "test1",         
                         "jspdf": {                  
                           "autotable": {
                             "styles": { "rowHeight": 20, "fontSize": 10 },
                             "headerStyles": { "fillColor": 255, "textColor": 0 },
                             "alternateRowStyles": { "fillColor": [60, 69, 79], "textColor": 255 }
                           }
                         }
                       }'
                -->
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td><b>Batch Name</b></td>
                            <td>SKU</td>
                            <td>Module</td>
                            <td>Batch qty</td>
                            <td>Rejected Pcs</td>
                            <td><b>Final Status</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                    @foreach ($batch as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->batch_name }}</td>
                            <td>{{ $req->sku }}</td>
                            <td>{{ $req->module_name }}</td>
                            <td>{{ $req->batch_qty }}</td>
                            <td>{{ $req->rejected }}</td>
                            <td>{{ $req->batch_status }}</td>
                            <td><a href="{{ url('/garment/batch/'.$req->id) }}" class="btn btn-info btn-xs center-block">Garments</a></td>
                            <td><a href="{{ url('/batch/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                        </tr>
                    @endforeach
                    
                    </tbody>                
            </div>
        </div>
    </div>
</div>
@endsection