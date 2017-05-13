@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
				<div class="panel-heading">Machine Table</div>

				@if (Auth::check() && Auth::user()->level() != 3)
				<div class="panel-body">
					<div class="">
						<a href="{{url('/machine_new')}}" class="btn btn-default btn-info">Add new Machine</a>
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
	                        <td><b>Machine Id</b></td>
	                        <td><b>Machine Type</b></td>
	                        <td>Machine Description</td>
	                        <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
			        @foreach ($machines as $req)
                        <tr>
                            {{--<td>{{ $req->id }}</td>--}}
                            <td>{{ $req->machine_id }}</td>
                            <td>{{ $req->machine_type }}</td>
                            <td>{{ $req->machine_description }}</td>
                            @if (Auth::check() && Auth::user()->level() != 3)
                                <td><a href="{{ url('/machine/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                            @endif
                        </tr>
                    @endforeach
                    
                    </tbody>				
			</div>
		</div>
	</div>
</div>
@endsection