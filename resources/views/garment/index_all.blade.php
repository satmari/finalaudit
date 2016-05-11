@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
            <div class="panel panel-default">
                <div class="panel-heading">Garment Table (All)</div>
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
                            <td><b>Garment Name</b></td>
                            <td>SKU</td>
                            <td>Po</td>
                            <td>Brand</td>
                            <td><b>Final Status</b></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                    @foreach ($garments as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->garment_name }}</td>
                            <td>{{ $req->sku }}</td>
                            <td>{{ $req->po }}</td>
                            <td>{{ $req->brand }}</td>
                            <td>{{ $req->garment_status }}</td>
                            <td><a href="{{ url('/garment/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                        </tr>
                    @endforeach
                    
                    </tbody>                
            </div>
        </div>
    </div>
</div>
@endsection