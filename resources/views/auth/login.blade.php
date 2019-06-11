@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">User</label>
							<div class="col-md-6">
								<!-- <input type="email" class="form-control" name="email" value="{{ old('email') }}"> -->
								<!-- <input type="text" class="form-control" name="email" value="{{ old('email') }}"> -->

								<!-- <label>Select operator</label> -->
					            <select id = "email" class="form-control" name="email">
					            	<option name="email" value=""></option>
					               	{{--<option name="email" value="audit1">Audit1 - Zeljka MAjoros</option>--}}
					               	<option name="email" value="audit2">Audit2 - Biljana Zivanovic</option>
					               	<option name="email" value="audit3">Audit3 - Klementina Nikolajevic</option>
					               	<option name="email" value="audit4">Audit4 - Sandra Petrekanic</option>
					               	<option name="email" value="audit5">Audit5 - Dragana Zivanovic</option>
					               	{{-- <option name="email" value="audit6">Audit6 - Dajana Ivankovic</option> --}}
					               	<option name="email" value="audit7">Audit7 - Dijana Matkovic</option>
					               	<option name="email" value="audit8">Audit8 - Silvana Bajic</option>
					               	<option name="email" value="audit11">Audit9 - Sladjana Marinkovic</option>
					               	{{-- <option name="email" value="audit12">Audit10 - Svetlana Lukic</option> --}}
					               	{{-- <option name="email" value="audit13">Audit10 - Bernadet Tot</option> --}}
					               	{{-- <option name="email" value="audit14">Audit11 - Cila Curnovic</option> --}}
					               	<option name="email" value="audit15">Audit12 - Sanja Mujovic</option>
					               	{{-- <option name="email" value="audit16">Audit13 - Stanka Juric</option> --}}
					               	{{-- <option name="email" value="audit17">Audit14 - Marina Madzarevic</option> --}}
					               	<option name="email" value="audit18">Audit15 - Snezana Diklic</option>
					               	<option name="email" value="audit19">Audit16 - Anabela Puszti</option>
					               	<option name="email" value="audit20">Audit17 - Olja Lancuski</option>
					               	<option name="email" value="audit10">AuditX - Not check user</option>
					               	<option name="email" value="audit9">Planer</option>
					               	<option name="email" value="admin">Admin</option>
					               	<option name="email" value="guest">Guest</option>
					            </select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" checked> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<!-- <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a> -->
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
