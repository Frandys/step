<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset("assets/admin/css/bootstrap.css") }}">
	<!-- Material Design Bootstrap -->
	<link rel="stylesheet" href="{{ asset("assets/admin/css/mdb.min.css") }}">
 	<link rel="stylesheet" href="{{ asset("assets/admin/css/style.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/css/responsive.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/css/all.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/admin/css/dataTables.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/admin/owlcarousel/owl.carousel.min.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/owlcarousel/owl.theme.default.min.css") }}">
</head>


<body>
	@yield('body')
	<script src="{{ asset("assets/admin/js/jquery-3.3.1.min.js") }}" type="text/javascript"></script>
	<script src="{{ asset("assets/admin/js/popper.min.js") }}" type="text/javascript"></script>

    <script src="{{ asset("assets/admin/js/dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/admin/js/bootstrap.js") }}" type="text/javascript"></script>

	<!-- MDB core JavaScript -->
	<script src="{{ asset("assets/admin/js/mdb.min.js") }}" type="text/javascript"></script>
	<script src="{{ asset("assets/admin/owlcarousel/owl.carousel.js") }}" type="text/javascript"></script>
	<script src="{{ asset("assets/admin/js/script.js") }}" type="text/javascript"></script>
	@stack('scripts')

</body>
</html>