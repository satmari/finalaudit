@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
				<div class="panel-heading">Defect Type Table</div>
				
                @if (Auth::check() && Auth::user()->level() != 3)
				<div class="panel-body">
					<div class="">
						<a href="{{url('/defecttype_new')}}" class="btn btn-default btn-info">Add new Defect Type</a>
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
	                        <td><b>Defect Type Id</b></td>
	                        <td><b>Defect Type Name</b></td>
                            <td>Defect Type Name 1</td>
                            <td>Defect Type Name 2</td>
                            <td>Defect Type Description</td>
                            <td>Defect Type Description 1</td>
                            <td>Defect Type Description 2</td>
                            <td style="color:green;">Defect Level Name</td>
                            <td style="color:green;">Pcs Rejected</td>
                            <td style="color:palevioletred;">Defect Applay to all</td>
                            <td style="color:blueviolet;">Visible</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
			        @foreach ($defect_types as $req)
                        <tr>
                            {{--<td>{{ $req->id }}</td>--}}
                            <td>{{ $req->defect_type_id }}</td>
                            <td>{{ $req->defect_type_name }}</td>
                            <td>{{ $req->defect_type_name_1 }}</td>
                            <td>{{ $req->defect_type_name_2 }}</td>
                            <td>{{ $req->defect_type_description }}</td>
                            <td>{{ $req->defect_type_description_1 }}</td>
                            <td>{{ $req->defect_type_description_2 }}</td>
                            <td>{{ $req->defect_level_name }}</td>
                            <td>{{ $req->defect_level_rejected }}</td>
                            <td>{{ $req->defect_applay_to_all }}</td>
                            <td>{{ $req->visible }}</td>

                            @if (Auth::check() && Auth::user()->level() != 3)
                                <td><a href="{{ url('/defecttype/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                            @endif
                            
                        </tr>
                    @endforeach
                    
                    </tbody>				
			</div>
		</div>
	</div>
</div>
@endsection