@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">Batch BULK Table 
                            @if (Auth::check() && (Auth::user()->level() == 3 OR Auth::user()->level() == 1))
                            (Last 30 days)
                            @endif

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
                                        <td>Module</td>
                                        <td>Batch qty</td>
                                        <td>Rejected Garments</td>
                                        <td>Final Status</td>
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
                                        <td>

                                        @if(Auth::check() && Auth::user()->level() == 2)
                                            @if( $req->batch_status == "Pending" || $req->batch_status == "Suspend")
                                                @if( $activity == 0)                                                    
                                                    <a href="{{ url('/garment_bulk/by_batch/'.$req->batch_name) }}" class="btn btn-info btn-xs center-block">Edit</a>
                                                @else
                                                    <a href="{{ url('/garment_bulk/by_batch/'.$req->batch_name) }}" class="btn btn-info btn-xs center-block" disabled>Edit</a>
                                                @endif
                                            @endif
                                        @endif

                                        @if(Auth::check() && Auth::user()->level() == 1)
                                            <a href="{{ url('/batch_bulk/edit_status/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit Status</a>
                                        @endif

                                        </td>

                                        
                                    </tr>
                                @endforeach
                                
                                </tbody>   
                                </table> 
                        </div>
                    </div>

                    
                    <div class="col-md-2 pull-right">
                      

                        @if(Auth::check() && Auth::user()->level() == 2)
                                <div class="panel panel-default">
                                <div class="panel-heading">Options</div>
                                    <div class="panel-body">
                                        @if( $activity == 0)
                                        <div class="">
                                            <a href="{{url('/selectproducertype')}}" class="btn btn-default btn-info side-button"><br>New BULK Batch </a>
                                        </div>
                                        @else
                                            <p style="color:red;"><b>Extra activity is active</b></p>
                                            <div class="">
                                                <a href="{{url('/selectproducertype')}}" class="btn btn-default btn-info side-button" disabled><br>New BULK Batch </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                        @endif


                        <div class="panel panel-default">
                        <div class="panel-heading">Batch BULK Details</div>
                            <div class="panel-body">
                                <table class="table" id="sort">
                                    <tr style="border:2px solid #555; !important">
                                        <td>Total checked <b>today</b></td>
                                        <td>{{ $total_checked_batch }}</td>
                                   </tr>
                                    <tr>
                                        <td>Accepted</td>
                                        <td>{{ $total_accept_batch }}</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Accepted with reserveation</td>
                                        <td>3</td>
                                    </tr> -->
                                    <tr>
                                        <td>Rejected</td>
                                        <td>{{ $total_reject_batch}}</td>
                                    </tr>
                                    <tr>
                                        <td>Suspended</td>
                                        <td>{{ $total_suspend_batch }}</td>
                                    </tr>
                                     <tr style="border-top:2px solid #555; !important">
                                        <td>Not checked</td>
                                        <td>{{ $total_not_checked_batch }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-default">
                        <div class="panel-heading">Garment Details</div>
                            <div class="panel-body">
                                <table class="table" id="sort">
                                    <tr style="border:2px solid #555; !important">
                                        <td>Total checked <b>today</b></td>
                                        <td>{{ $total_garments_today }}</td>
                                   </tr>
                                   <tr>
                                        <td>Total Not checked <b>today</b></td>
                                        <td>{{ $total_garments_not_today }}</td>
                                   </tr>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
    </div>
</div>
@endsection