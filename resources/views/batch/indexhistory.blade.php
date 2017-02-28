@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Batch Table (Last 7 days)
                            
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
                                        <td><b>Batch Name</b></td>
                                        <td>Cartonbox</td>
                                        <td>SKU</td>
                                        <td>Module</td>
                                        <td>Batch qty</td>
                                        <td>Rejected Garments</td>
                                        <td>Final Status</td>
                                        
                                        <!-- <td></td> -->
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                @foreach ($batch as $req)
                                    <tr>
                                        {{-- <td>{{ $req->id }}</td> --}}
                                        <td>{{ $req->batch_name }}</td>
                                        <td>{{ $req->cartonbox }}</td>
                                        <td>{{ $req->sku }}</td>
                                        <td>{{ $req->module_name }}</td>
                                        <td>{{ $req->batch_qty }}</td>
                                        <td>{{ $req->RejectedCount }}</td>
                                        {{-- <td><b>{{ $req->batch_status }}</b></td> --}}
                                        
                                        @if ($req->batch_status == "Reject")
                                          <td><span style="color:red;"><b>{{ $req->batch_status }}</b></span></td>
                                          @elseif ($req->batch_status == "Accept") 
                                          <td><span style="color:green;"><b>{{ $req->batch_status }}</b></span></td>
                                          @elseif ($req->batch_status == "Not checked") 
                                          <td><span style="color:blue;"><b>{{ $req->batch_status }}</b></span></td>
                                          @else 
                                           <td><span><b>{{ $req->batch_status }}</b></span></td>
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