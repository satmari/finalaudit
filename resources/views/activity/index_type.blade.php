@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Activity Type Table 
                                </div>

                                @if (Auth::check() && Auth::user()->level() != 3)
                                <div class="panel-body">
                                    <div class="">
                                        <a href="{{url('/activity_type_new')}}" class="btn btn-default btn-info">Create new type of activity</a>
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
                                            <td>Activity Id</td>
                                            <td>Activity Desc</td>
                                            <td>Activity Desc 1</td>
                                            <td>Activity Desc 2</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody class="searchable">
                                    @foreach ($activity_types as $req)
                                        <tr>
                                            {{--<td>{{ $req->id }}</td>--}}
                                            <td>{{ $req->activity_id }}</td>
                                            <td>{{ $req->activity_desc }}</td>
                                            <td>{{ $req->activity_desc1 }}</td>
                                            <td>{{ $req->activity_desc2}}</td>

                                             @if (Auth::check() && Auth::user()->level() == 1)
                                                <td><a href="{{ url('/activity_type/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                                             @endif
                                             
                                        </tr>
                                    @endforeach
                                    
                                    </tbody>   
                                    </table> 
                            </div>
                        </div>
                    </div>
         </div>
    </div>
</div>
@endsection