@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Size-set table - Full table</div>
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
                                        <!-- <th>Id</th> -->
                                        <!-- <th>SKU</th> -->
                                        <th>Style</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <!-- <th>Color Desc</th> -->

                                        <th style="background-color: aliceblue;">Scanned</th>
                                        <th style="background-color: aliceblue;">Date</th>
                                        <th style="background-color: aliceblue;">User</th>

                                        <th style="background-color: antiquewhite;">Collected</th>
                                        <th style="background-color: antiquewhite;">Date</th>
                                        <th style="background-color: antiquewhite;">User</th>

                                        <th style="background-color: floralwhite;">Shipped</th>
                                        <th style="background-color: floralwhite;">Date</th>
                                        <th style="background-color: floralwhite;">User</th>

                                        <th>Style scanned</th>

                                        <th>Comment</th>
                                        <th></th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                @foreach ($sizeset as $req)
                                    <tr>
                                        {{-- <td>{{ $req->id }}</td> --}}
                                        {{-- <td>{{ $req->sku }}</td> --}}
                                        <td>{{ $req->style }}</td>
                                        <td>{{ $req->color }}</td>
                                        <td>{{ $req->size }}</td>
                                        <!-- <td>{{-- {{ $req->color_desc }} --}}</td> -->

                                        <td style="background-color: aliceblue;">{{ $req->scanned }}</td>
                                        <td style="background-color: aliceblue;">{{ substr($req->scanned_date, 0, 19) }}</td>
                                        <td style="background-color: aliceblue;">{{ $req->scanned_user }}</td>

                                        <td style="background-color: antiquewhite;">{{ $req->collected }}</td>
                                        <td style="background-color: antiquewhite;">{{ substr($req->collected_date, 0, 19) }}</td>
                                        <td style="background-color: antiquewhite;">{{ $req->collected_user }}</td>

                                        <td style="background-color: floralwhite;">{{ $req->shipped }}</td>
                                        <td style="background-color: floralwhite;">{{ substr($req->shipped_date, 0, 19) }}</td>
                                        <td style="background-color: floralwhite;">{{ $req->shipped_user }}</td>

                                        <td> {{ $req->style_scanned }} </td>

                                        <td>{{ $req->temp_coloumn }}</td>
                                        
                                        @if(Auth::check() && Auth::user()->level() == 5)
                                            @if($req->shipped == 'NO')
                                            <td><a href="{{ url('/sizeset/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                                            @endif
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