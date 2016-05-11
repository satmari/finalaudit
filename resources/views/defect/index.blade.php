@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Batch Details</div> -->
                <!-- <br> -->
                <div class="row">
                 @foreach ($batch as $req)
                    <table class="table">
                      <thead>
                        <tr>
                            <td><b>Batch Name</b></td>
                            <td>SKU</td>
                            <td>Module</td>
                            <td>CB Qty</td>
                            <td>CB Code</td>
                            {{--<td>CB finished</td>--}}
                            <td>CB Barcode Match</td>
                            <td>Batch Qty</td>
                            <td>MAX Rejected</td>
                            <td>Category</td>
                        </tr>
                      </thead>
                      <tbody class="searchable">
                        <tr>
                            <td>{{ $req->batch_name }}</td>
                            <td>{{ $req->sku }}</td>
                            <td>{{ $req->module_name }}</td>
                            <td>{{ $req->cartonbox_produced }}</td>
                            <td>{{ $req->cartonbox }}</td>
                            {{--<td>{{ $req->cartonbox_finish_date }}</td>--}}
                            @if ($req->batch_barcode_match == "NO")
                              <td><span style="color:red;font-weight:bold;font-size:18px;">{{ $req->batch_barcode_match }}</span></td>
                            @else 
                              <td><span style="color:green;font-weight:bold;">{{ $req->batch_barcode_match }}</span></td>
                            @endif
                            <td>{{ $req->batch_qty }}</td>
                            <td>{{ $req->batch_brand_max_reject }}</td>
                            <td>{{ $req->category_name }}</td>
                        </tr>
                      </tbody>
                    </table>
                @endforeach
                </div>
            </div>

            {{--
            <div class="panel panel-default">
                <div class="panel-heading">Garment Details</div>
                <br>
                <div class="row">
                  @foreach ($garment as $req)
                      <div class="col-md-6">Garment Name: <big><b>{{ $req->garment_name }}</b></big></div>
                      <div class="col-md-6">Garment Status: <big><b>{{ $req->garment_status }}</b></big></div>
                  @endforeach
                </div>
                <br>
            </div>
            --}}
  
            
          <div class="row">
            <div class="col-md-10">
              @if (count($defects) > 0)
                  <div class="panel panel-default">
                    <div class="panel-heading">Defects in this garment
                     
                      <span class="span-right">
                        <b>Number of Rejected:   {{ $num }}</b>
                      </span>
                      
                    </div>
                    <!-- <div class="input-group"><span class="input-group-addon">Filter</span>
                        <input id="filter" type="text" class="form-control" placeholder="Type here...">
                    </div> -->
                    
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
                                <td><b>Defect Name</b></td>
                                <td><b>Defect Type</b></td>
                                <td>Defect Level</td>
                                <td>Defect Level Rejected</td>
                                <td>Position</td>
                                <td>Machine</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="searchable">
                        @foreach ($defects as $req)
                            <tr>
                                {{-- <td>{{ $req->id }}</td> --}}
                                <td>{{ $req->defect_name }}</td>
                                <td>{{ $req->defect_type_name }}</td>
                                <td>{{ $req->defect_level_name }}</td>
                                @if ($req->defect_level_rejected == "YES")
                                <td><span style="color:red;">{{ $req->defect_level_rejected }}</span></td>
                                @else
                                <td>{{ $req->defect_level_rejected }}</td>
                                @endif
                                <td>{{ $req->position_name }}</td>
                                <td>{{ $req->machine_type }}</td>
                                <td><a href="{{ url('/defect/delete/'.$req->id) }}" class="btn btn-danger btn-xs center-block">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody> 
                    </table>               
                  </div>
                @else
                  <p style="color:red;">There is no defects on this garment.</p>
                @endif
              
            </div>

            @if(Auth::check() && Auth::user()->level() == 2)
            <div class="col-md-2">
              <div class="panel panel-default">
                <div class="panel-heading">Options</div>
                  <br>
                  <br>
                  @foreach ($garment as $req)
                  <div class="row">
                    <a href="{{url('/defect_new/'.$req->garment_name)}}" class="btn btn-info side-button"><br>New Defect</a>
                  </div>
                  @endforeach
                  @foreach ($batch as $req)
                  <div class="row">
                    <a href="{{ url('/garment/by_batch/'.$req->batch_name) }}" class="btn btn-warning side-button"><br>Back</a>
                  </div>
                  @endforeach
              </div>  
            </div>
            @endif
          
          </div>
          
        </div>
    </div>
</div>
@endsection