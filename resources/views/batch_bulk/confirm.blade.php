@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="row">
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
                                <td>CB finished</td>
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
                                <td>{{ $req->cartonbox_finish_date }}</td>
                                <td>{{ $req->batch_qty }}</td>
                                <td>{{ $req->batch_brand_max_reject }}</td>
                                <td>{{ $req->category_name }}</td>
                            </tr>
                          </tbody>
                        </table>
                    @endforeach
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10">
                    <div class="panel panel-default">
                            <!-- <div class="panel-heading">Batch Details</div> -->
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Total Defects</td>
                                            <td>Total <b>Critical</b> Defects</td>
                                            <td>Total Rejected Garments</td>
                                            <td>Suggestion</td>
                                        </tr>
                                    </thead>
                                    <tbody class="searchable">
                                        <tr>
                                            <td>{{ $total_defects }}</td>
                                            <td>{{ $total_rejected_defects }}</td>
                                            <td>{{ $total_rejected_garments }}</td>
                                            <td>@if ($suggestion == "Accept")
                                                <b><span style="color:green;font-size: 18px;">{{ $suggestion }}</span></b>
                                                @elseif ($suggestion == "Reject")
                                                <b><span style="color:red;font-size: 18px;">{{ $suggestion }}</span></b>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                            </div>
                    </div>

                    <div class="panel panel-default">
                            <div class="row">
                                <br><br>
                              <div class="col-md-6">
                                <a href="{{url('/batch_bulk/accept/'.$batchid->id)}}" class="btn btn-success final-button"><br>Accept</a>
                              </div>
                              <!-- <div class="col-md-4">
                                <a href="{{url('/batch/acceptwithreservetion/'.$batchid->id)}}" class="btn btn-info btn-lg">Accept with reservation</a>
                              </div> -->
                              <div class="col-md-6">
                                <a href="{{url('/batch_bulk/reject/'.$batchid->id)}}" class="btn btn-danger final-button"><br>Reject</a>
                              </div>
                                <br>
                            </div>
                            <br>
                    </div>

                </div>

                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Options</div>
                            <br><br>
                            <div class="row">
                              <!-- <div class="col-md-6"> -->
                                <a href="{{url('/batch_bulk/suspend/'.$batchid->id)}}" class="btn btn-default side-button"><br>Suspend</a>

                            </div>
                            {{--
                            <div class="row">
                              <!-- <div class="col-md-6"> -->
                                <a href="{{ url('/batch_bulk/delete/'.$batchid->id) }}" class="btn btn-danger side-button"><br>Delete</a>
                              <!-- </div> -->
                            </div>
                            --}}
                         <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection