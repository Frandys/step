<!doctype html>
<html lang="en">
<head>
<title>Login</title>
<!-- Required meta tags -->
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset("assets/admin/css/bootstrap.css") }}">

	<link rel="stylesheet" href="{{ asset("assets/admin/css/mdb.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/css/style.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/css/responsive.css") }}">

</head>
<body>

<section class="form-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-wrap">
					<img src="{{asset('assets/admin/images/steps.png')}}" class="img-fluid logo"/>
					<h2 class="text-center mb-3">Sign In</h2>
				@include('message.message')
					<!-- Default form login -->
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
					
						<div class="form-group email">
						<!-- Email -->
							<input type="email" id="defaultLoginFormEmail" class="form-control "name="email" value="{{ old('email') }}" required autofocus  placeholder="E-mail">
							@if ($errors->has('email'))
								<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
							@endif
						</div>
						<!-- Password -->
						<div class="form-group password">
							<input type="password" id="defaultLoginFormPassword" class="form-control" name="password" required placeholder="Password">

							@if ($errors->has('password'))
								<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
							@endif
						</div>
						<div class="d-flex justify-content-end">
							<div>
								<!-- Forgot password -->
								<a href="">Forgot password?</a>
							</div>
						</div>
						<!-- Sign in button -->
						<button class="btn btn-info btn-block mt-2" type="submit">Sign in</button>
					</form>
					<!-- Default form login -->
				</div>
			</div>
		</div>
	</div>
</section>

</body>
</html>