@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
				<div class="panel-heading">Position Table</div>
				
				<div class="panel-body">
					<div class="">
						<a href="{{url('/position_new')}}" class="btn btn-default btn-info">Add new Position</a>
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
	                        <td><b>Position Id</b></td>
	                        <td><b>Position Name</b></td>
                            <td>Position Name 1</td>
                            <td>Position Name 2</td>
                            <td>Position Description</td>
                            <td>Position Description 1</td>
                            <td>Position Description 2</td>
                            <td style="color:palevioletred;">Position Applay to all</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
			        @foreach ($position as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->position_id }}</td>
                            <td>{{ $req->position_name }}</td>
                            <td>{{ $req->position_name_1 }}</td>
                            <td>{{ $req->position_name_2 }}</td>
                            <td>{{ $req->position_description }}</td>
                            <td>{{ $req->position_description_1 }}</td>
                            <td>{{ $req->position_description_2 }}</td>
                            <td>{{ $req->position_applay_to_all }}</td>
                            <td><a href="{{ url('/position/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                        </tr>
                    @endforeach
                    
                    </tbody>				
			</div>
		</div>
	</div>
</div>
@endsection