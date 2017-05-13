@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"></div>
				<br>
				<div class="row">
					<span style="font-size: 25px;">Barcode match: 
						@if ($batch_barcode_match == 'NO') 
							<b><p style="color:red;">{{ $batch_barcode_match }}</p></b>
						@else
							<b><p style="color:green;">{{ $batch_barcode_match }}</p></b>
						@endif
					</span>
            	</div>
            	<br>
            	
            	<div class="panel-body">
	            	@foreach ($batch as $req)
						<div class="row">
		                          <a href="{{url('/batch/not_checked/'.$req->id)}}" class="btn btn-warning side-button"><br>Not checked<br><br></a>
		                </div>
		            @endforeach
	        	</div>

			</div>
		</div>
	</div>
</div>

@endsection