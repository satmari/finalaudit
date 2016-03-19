<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Final Audit</title>

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->

	<!-- Fonts -->
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->

	
	<link href="{{ asset('/css/font.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset('/css/bootstrap-table.css') }}" rel='stylesheet' type='text/css'>
	<!-- <link href="{{ asset('/css/jquery.dataTables.min.css') }}" rel='stylesheet' type='text/css'> -->
	<link href="{{ asset('/css/jquery-ui.min.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset('/css/custom.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset('/css/app.css') }}" rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Final Audit</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>

					<!-- <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">Separated link</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">One more separated link</a></li>
			          </ul>
			        </li> -->

				</ul>
				<ul class="nav navbar-nav">
					<li>
						<div class="dropdown">
						  <button class="btn btn-default dropdown-toggle" style="margin: 8px 5px !important;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						    Settings
						    <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						    
						    <li><a href="{{ url('/defectlevel') }}">Defect Levels</a></li>

						    <li role="separator" class="divider"></li>
						    <li><a href="{{ url('/category') }}">Categories</a></li>
						    <li><a href="{{ url('/defecttype') }}">Defect Types</a></li>
						    <li><a href="{{ url('/position') }}">Positions</a></li>
						    
						    <li role="separator" class="divider"></li>
						    <li><a href="{{ url('/categorydefecttype') }}">Category-DefectType Link</a></li>
						    <li><a href="{{ url('/categoryposition') }}">Category-Position Link</a></li>

						    <li role="separator" class="divider"></li>
						    <li><a href="{{ url('/machine') }}">Machines</a></li>
						    <li><a href="{{ url('/model') }}">Models</a></li>

						    <li role="separator" class="divider"></li>
						    
						  </ul>
						</div>
					</li>
				</ul>

				<!-- <ul class="nav navbar-nav">
					<li><a href="{{ url('/defectlevel') }}">Defect Levels</a></li>
				</ul>

				<ul class="nav navbar-nav">
					<li><a href="{{ url('/category') }}">Categories</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/defecttype') }}">Defect Types</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/categorydefecttype') }}">Category-DefectType Link</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/position') }}">Positions</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/categoryposition') }}">Category-Position Link</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/machine') }}">Machines</a></li>
				</ul> -->
				
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	
	<script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('/js/bootstrap-table.js') }}" type="text/javascript" ></script>
	<script src="{{ asset('/js/jquery-ui.min.js') }}" type="text/javascript" ></script>
	<!-- <script src="{{ asset('/js/jquery.dataTables.min.js') }}" type="text/javascript" ></script>-->
	<!--<script src="{{ asset('/js/jquery.tablesorter.min.js') }}" type="text/javascript" ></script>-->
	<!--<script src="{{ asset('/js/custom.js') }}" type="text/javascript" ></script>-->
	<script src="{{ asset('/js/tableExport.js') }}" type="text/javascript" ></script>
	<!--<script src="{{ asset('/js/jspdf.plugin.autotable.js') }}" type="text/javascript" ></script>-->
	<!--<script src="{{ asset('/js/jspdf.min.js') }}" type="text/javascript" ></script>-->
	<script src="{{ asset('/js/FileSaver.min.js') }}" type="text/javascript" ></script>
	<script src="{{ asset('/js/bootstrap-table-export.js') }}" type="text/javascript" ></script>


<script type="text/javascript">
$(function() {
    	
	// $('#po').autocomplete({
	// 	minLength: 3,
	// 	autoFocus: true,
	// 	source: '{{ URL('getpodata')}}'
	// });
	// $('#module').autocomplete({
	// 	minLength: 1,
	// 	autoFocus: true,
	// 	source: '{{ URL('getmoduledata')}}'
	// });
	$('#filter').keyup(function () {

        var rex = new RegExp($(this).val(), 'i');
        $('.searchable tr').hide();
        $('.searchable tr').filter(function () {
            return rex.test($(this).text());
        }).show();
	});

	// $('#sort').bootstrapTable({
    
	// });

	//$('.table tr').each(function(){
  		
  		//$("td:contains('pending')").addClass('pending');
  		//$("td:contains('confirmed')").addClass('confirmed');
  		//$("td:contains('back')").addClass('back');
  		//$("td:contains('error')").addClass('error');
  		//$("td:contains('TEZENIS')").addClass('tezenis');

  		// $("td:contains('TEZENIS')").function() {
  		// 	$(this).index().addClass('tezenis');
  		// }
	//});

	// $('.to-print').each(function(){
	// 	var qty = $(this).html();
	// 	//console.log(qty);

	// 	if (qty == 0 ) {
	// 		$(this).addClass('zuto');
	// 	} else if (qty > 0) {
	// 		$(this).addClass('zeleno');
	// 	} else if (qty < 0 ) {	
	// 		$(this).addClass('crveno');
	// 	}
	// });

	// $('.status').each(function(){
	// 	var status = $(this).html();
	// 	//console.log(qty);

	// 	if (status == 'pending' ) {
	// 		$(this).addClass('pending');
	// 	} else if (status == 'confirmed') {
	// 		$(this).addClass('confirmed');
	// 	} else {	
	// 		$(this).addClass('back');
	// 	}
	// });

	// $('td').click(function() {
	//    	var myCol = $(this).index();
 	//    	var $tr = $(this).closest('tr');
 	//    	var myRow = $tr.index();

 	//    	console.log("col: "+myCol+" tr: "+$tr+" row:"+ myRow);
	// });

});
</script>

</body>
</html>
