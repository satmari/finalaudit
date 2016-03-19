@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            <div class="panel panel-default">
                <div class="panel-heading">Category Table</div>
                
                <div class="panel-body">
                    <div class="">
                        <a href="{{url('/category_new')}}" class="btn btn-default btn-info">Add new Category</a>
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
                            <td><b>Category Id</b></td>
                            <td><b>Category Name</b></td>
                            <td>Category Name 1</td>
                            <td>Category Name 2</td>
                            <td>Category Description</td>
                            <td>Category Description 1</td>
                            <td>Category Description 2</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                    @foreach ($category as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->category_id }}</td>
                            <td>{{ $req->category_name }}</td>
                            <td>{{ $req->category_name_1 }}</td>
                            <td>{{ $req->category_name_2 }}</td>
                            <td>{{ $req->category_description }}</td>
                            <td>{{ $req->category_description_1 }}</td>
                            <td>{{ $req->category_description_2 }}</td>
                            <td><a href="{{ url('/category/edit/'.$req->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
                        </tr>
                    @endforeach
                    
                    </tbody>                
            </div>
        </div>
    </div>
</div>
@endsection