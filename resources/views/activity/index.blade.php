@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">

                @if(Auth::check() && Auth::user()->level() == 2)
                    
                    <div class="row">
                        <div class="text-center col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Activity Table 
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

                @if(Auth::check() && Auth::user()->level() == 1)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Activity Table 
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
                                            <td>Activity Id</td>
                                            <td>Activity Name</td>
                                            <td>User</td>
                                            <td>Start</td>
                                            <td>End</td>
                                            <td>Total Duaration (min)</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody class="searchable">
                                    @foreach ($activitylog as $req)
                                        <tr>
                                            <td>{{ $req->id }}</td>
                                            <td>{{ $req->activity_id }}</td>
                                            <td>{{ $req->activity_desc }}</td>
                                            <td>{{ $req->activity_by_name }}</td>
                                            <td>{{ $req->start }}</td>
                                            <td>{{ $req->end }}</td>
                                            <td>{{ $req->duration_num }}</td>
                                            <td>{{ $req->status }}</td>

                                            
                                        </tr>
                                    @endforeach
                                    
                                    </tbody>   
                                    </table> 
                            </div>
                        </div>

                        <!-- <div class="col-md-2 pull-right">
                        </div> -->
                    </div>
                @endif

         </div>
    </div>
</div>
@endsection