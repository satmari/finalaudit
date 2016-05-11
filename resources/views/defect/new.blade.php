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
                <div class="panel panel-default">
                    <div class="panel-heading">Defect Details</div>
                    <br>
                    {!! Form::open(['method'=>'POST', 'url'=>'/defect_insert']) !!}
                    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
                    @include('errors.list')
                      
                      @foreach ($garment as $req)
                        {!! Form::hidden('garment_name', $req->garment_name, ['class' => 'form-control']) !!}
                        {!! Form::hidden('garment_order', $req->garment_order, ['class' => 'form-control']) !!}
                      @endforeach

                      @foreach ($batch as $req)
                        {!! Form::hidden('batch_name', $req->batch_name, ['class' => 'form-control']) !!}
                        {{-- 
                        {!! Form::hidden('batch_date', $req->batch_date, ['class' => 'form-control']) !!}
                        {!! Form::hidden('batch_user', $req->batch_user, ['class' => 'form-control']) !!}
                        {!! Form::hidden('batch_order', $req->batch_order, ['class' => 'form-control']) !!}
                        --}}
                      @endforeach

                      <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li id="lidefects" role="presentation" class="active"><a href="#defects" aria-controls="defects" role="tab" data-toggle="tab"><big><b>Defects <span style="color:red">*</span></b></big></a></li>
                        <li id="lipositions" role="presentation"><a href="#positions" aria-controls="positions" role="tab" data-toggle="tab"><big><b>Positions</b></big></a></li>
                        <li id="limachines"  role="presentation"><a href="#machines" aria-controls="machines" role="tab" data-toggle="tab"><big><b>Machines</b></big></a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active" id="defects">
                          <div class="row">
                            <!-- <br><br> -->
                                <div class="panel-body visina-panel">

                                  @foreach ($defect_types as $type)
                                    
                                    @if ($type->defect_level_rejected == "YES") 
                                      <div class="col-md-2 visina-critical">
                                    @else
                                      <div class="col-md-2 visina-basic">
                                    @endif
                                    
                                       <div class="visina_text"><b>{{ $type->defect_type_name }}</b></div>
                                      {!! Form::radio('defect_type_id', $type->defect_type_id, null, ['id' => 'check', 'class' => 'form-control']); !!}
                                      <br>
                                    </div>
                                  @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div role="tabpanel" class="tab-pane fade" id="positions">
                          <div class="row">
                            <!-- <br> -->
                                <div class="panel-body visina-panel">
                                  @foreach ($positions as $position)
                                    <div class="col-md-2 visina">
                                       <div class="visina_text"><b>{{ $position->position_name }}</b></div>
                                      {!! Form::radio('position_id', $position->position_id, null, ['id' => 'check', 'class' => 'form-control']); !!}
                                      <br>
                                    </div>
                                  @endforeach
                                    
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="machines">
                          <div class="row">
                            <!-- <br> -->
                                <div class="panel-body visina-panel">
                                  @foreach ($machines as $machine)
                                    <div class="col-md-1 visina">
                                      <div class="visina_text"><b>{{ $machine->machine_type }}</b></div>
                                      {!! Form::radio('machine_id', $machine->machine_id, null, ['id' => 'check', 'class' => 'form-control']); !!}
                                      <br>
                                    </div>
                                  @endforeach
                                    
                                </div>
                            </div>
                        </div>

                      </div>
                    <!-- <br> -->
                </div>
              </div>

              <div class="col-md-2">
                <div class="panel panel-default">
                   <div class="panel-heading">Options</div>
                  <br>
                  <br>
                  <div class="row">  
                    {!! Form::submit('Confirm Defect', ['class' => 'btn  btn-success center-block side-button']) !!}
                    {!! Form::close() !!}
                  </div>
                  
                  <div class="row">
                    @foreach ($garment as $req)
                      <a href="{{url('/defect/by_garment/'.$req->garment_name)}}" class="btn btn-warning side-button"><br>Back</a>
                    @endforeach
                  </div>
                  
                </div>
              </div>
            </div>

        </div>
    </div>
</div>
@endsection