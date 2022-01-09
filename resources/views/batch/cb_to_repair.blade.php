@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">CB to repair
                            

                            </div>
                            <div class="input-group"> <span class="input-group-addon">Filter</span>
                                <input id="filter" type="text" class="form-control" placeholder="Type here...">
                            </div>

                            <table class="table table-striped table-bordered" id="sort" 
                            data-show-export="true"
                            data-export-types="['excel']"
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
                                        <th><b>Batch Name</b></th>
                                        <th data-sortable="true">SKU</th>
                                        <th>PO</th>
                                        <th data-sortable="true">Flash</th>
                                        <th data-sortable="true">Module</th>
                                        <th>CB barcode</th>
                                        <th>Produced</th>
                                        <th>Audit</th>
                                        <th>CB repaired</th>
                                        <th>Repairing Date</th>
                                        <th>Comment</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                @foreach ($batch as $req)
                                    <tr>
                                        {{-- <td>{{ $req->id }}</td> --}}
                                        <td>{{ $req->batch_name }}</td>
                                        <td >{{ $req->sku }}</td>
                                        <td>{{ $req->po  }}</td>
                                        <td >{{ $req->flash  }}</td>
                                        <td >{{ $req->module_name }}</td>
                                        <td>{{ $req->cartonbox }}</td>
                                        <td>{{ $req->cartonbox_produced }}</td>
                                        <td>{{ $req->audit }}</td>
                                        <td>{{ $req->repaired }}</td>
                                        {{-- <td>{{ date_format(strtotime($req->date_of_sending_to_repair),"d.m.Y ") }}</td> --}}
                                        <td>{{ substr($req->date_of_sending_to_repair, 0, 10) }}</td>
                                        <td>{{ $req->repaired_comment }}</td>
                                        
                                        <td>
                                        @if((Auth::check() && (Auth::user()->level() == 5)) OR (Auth::check() && (Auth::user()->level() == 1)))
                                            <a href="{{ url('/cb_to_repair/edit_comment/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit Comment</a>
                                        @endif
                                        </td>
                                        <td>
                                        @if(Auth::check() && ((Auth::user()->level() == 2)))
                                            <a href="{{ url('/cb_to_repair/edit_date/'.$req->id) }}" class="btn btn-info btn-xs center-block">Repairing Date</a>
                                        @endif
                                        </td>
                                        <td>
                                        @if(Auth::check() && ((Auth::user()->level() == 2)))
                                            <a href="{{ url('/cb_to_repair/edit/'.$req->id) }}" class="btn btn-danger btn-xs center-block">Repaired</a>
                                        @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                
                                </tbody>   
                                </table> 
                        </div>
                    </div>

                    
                    <div class="col-md-2 pull-right">
                      
                    </div>
                </div>
         </div>
    </div>
</div>
@endsection