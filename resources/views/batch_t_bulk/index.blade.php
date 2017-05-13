@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
                <div class="panel-heading">Batch BULK <b>Tezenis</b> Table</div>
                
                @if (Auth::check() && Auth::user()->level() != 3)
                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/batch_t_bulk_new')}}" class="btn btn-default btn-info">Add BULK Batch</a>
                    </div>
                </div>
                @endif

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
                            <!-- <td>Id</td> -->
                            <td><b>Batch Id</b></td>
                            <td><b>Pcs Box MIN</b></td>
                            <td><b>Pcs Box MAX</b></td>
                            <td><b>Batch (Pcs to Check)</b></td>
                            <td><b>Max Rejected Pcs Accepted</b></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                    @foreach ($batch_t as $req)
                        <tr>
                            {{--<td>{{ $req->id }}</td>--}}
                            <td>{{ $req->batch_id }}</td>
                            <td>{{ $req->batch_min }}</td>
                            <td>{{ $req->batch_max }}</td>
                            <td>{{ $req->batch_check }}</td>
                            <td>{{ $req->batch_reject }}</td>
                            @if (Auth::check() && Auth::user()->level() != 3)
                                <td><a href="{{ url('/batch_t_bulk/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                            @endif
                        </tr>
                    @endforeach
                    
                    </tbody>                
            </div>
        </div>
    </div>
</div>
@endsection