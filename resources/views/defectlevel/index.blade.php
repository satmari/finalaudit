@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
				<div class="panel-heading">Defect Level Table</div>
				
				<div class="panel-body">
					<div class="">
						<a href="{{url('/defectlevel_new')}}" class="btn btn-default btn-info">Add new Defect Level</a>
					</div>
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
	                        <td>Id</td>
	                        <td><b>Defect Level Id</b></td>
	                        <td><b>Defect Name</b></td>
	                        <td>Defect Rejected</td>
	                        <!-- <td>Defect Redjected (Bool)</td> -->
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
			        @foreach ($defect_levels as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->defect_level_id }}</td>
                            <td>{{ $req->defect_level_name }}</td>
                            <td>{{ $req->defect_level_rejected }}</td>
                            <!-- <td>{{-- $req->pcs_rejected --}}</td> -->
                            <td><a href="{{ url('/defectlevel/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                        </tr>
                    @endforeach
                    
                    </tbody>				
			</div>
		</div>
	</div>
</div>
@endsection