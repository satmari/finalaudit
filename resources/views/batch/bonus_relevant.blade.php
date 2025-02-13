@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Bonus relevat table
                            

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
                                        <!-- <td>Id</td> -->
                                        <th><b>Batch Name</b></th>
                                        <th data-sortable="true">SKU</th>
                                        <th>PO</th>
                                        <th data-sortable="true">Flash</th>
                                        <th data-sortable="true">Module</th>
                                        <th>CB barcode</th>
                                        <th>Status</th>
                                        <th>Bonus relevant</th>
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
                                        <td>{{ $req->batch_status }}</td>
                                        <td>{{ $req->bonus_relevant }}</td>
                                        
                                        
                                        <td>
                                        @if((Auth::check() && (Auth::user()->level() == 2)) OR (Auth::check() && (Auth::user()->level() == 1)))
                                            <a href="{{ url('/bonus_relevant/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit </a>
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