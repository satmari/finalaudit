@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Batch to repair
                            

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
                                        <td>SKU</td>
                                        <td>PO</td>
                                        <td>Module</td>
                                        <td>CB barcode</td>
                                        <td>CB repaired</td>
                                        <td></td>
                                        <!-- <td></td> -->
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                @foreach ($batch as $req)
                                    <tr>
                                        {{-- <td>{{ $req->id }}</td> --}}
                                        <td>{{ $req->batch_name }}</td>
                                        <td>{{ $req->sku }}</td>
                                        <td>{{ $req->po  }}</td>
                                        <td>{{ $req->module_name }}</td>
                                        <td>{{ $req->cartonbox }}</td>
                                        <td>{{ $req->repaired }}</td>
                                        <td>
                                        @if(Auth::check() && ((Auth::user()->level() == 2)))
                                            <a href="{{ url('/cb_to_repair/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a>
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