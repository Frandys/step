@extends('layouts.admin.dashboard')
@section('section')
@include('message.message')
			<div class="col-lg-10">
				<div class="admin-wrap">
					<div class="top-bar mb-4">
						<div class="row no-gutters">
							<div class="col">
								<div class="heading-wrap">
									<h2>Managing Users </h2>
								</div>
							</div>
							<div class="col text-right">
								<div class="dashtop row no-gutters">
									<div class="col">
										<div class="dropdown notif">
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												<img src="images/notification.png">
												<span class="count">2</span>
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="#">Link 1</a>
												<a class="dropdown-item" href="#">Link 2</a>
												<a class="dropdown-item" href="#">Link 3</a>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="dropdown admin">
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												<span class="name">Admin Name</span><img src="images/admin.png" class="img-fluid">
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="#">Link 1</a>
												<a class="dropdown-item" href="#">Link 2</a>
												<a class="dropdown-item" href="#">Link 3</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="diash-wrap-white">
						<div class="dash-page register">
							<div class="row dash-top mb-2">
								<div class="col-md-8 dash-title">
									<h3 class="small-head">Users <small>> John Doe</small></h3>
									
								</div>
								<div class="col-md-4 text-right">
									<button type="button" class="link block-link" data-toggle="modal" data-target="#blockModal">Block</button>
								</div>
							</div>
							<div class="individual-user">
								<div class="row">
									<div class="col-md-5 profile">
										<div class="row no-gutters profile-name in-shadow">
											<div class="col-lg-4 col-md-12 col-sm-12 text-md-center">
												<div class="img-wrap">
													<img src="images/profile.png" class="img-fluid">
												</div>
											</div>
											<div class="col-lg-8 col-md-12 col-sm-12 ">
												<div class="text-wrap">
													<div class="row no-gutters">
														<div class="col name">
															<strong>User Name</strong>
															<p>John Doe</p>
														</div>
														<div class="col name text-right">
															<button type="button" class="link block-link" data-toggle="modal" data-target="#maiilModal">Mail John Doe</button>
														</div>
													</div>
													<div class="row no-gutters">
														<div class="col name">
															<strong>Email</strong>
															<p>John.Doe@gmail.com</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="target in-shadow">
											<div class="row no-gutters title mb-2">
												<div class="col">
													<strong>Daily Target</strong>
												</div>
												<div class="col text-right">
													<span>Steps Vs Target</span>
												</div>
											</div>
											<div class="paw mb-2">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
											</div>
											<div class="row no-gutters title ">
												<div class="col">
													<p>Coupon Value: $25</p>
												</div>
												<div class="col timer">
													<strong>00:11:45 Left</strong>
												</div>
												<div class="col text-right">
													<p>1024</p>
												</div>
											</div>
										</div>
										<div class="target in-shadow">
											<div class="row no-gutters title mb-2">
												<div class="col">
													<strong>Weekly Target</strong>
												</div>
												<div class="col text-right">
													<span>Steps Vs Target</span>
												</div>
											</div>
											<div class="paw mb-2">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
											</div>
											<div class="row no-gutters title">
												<div class="col">
													<p>Coupon Value: $25</p>
												</div>
												<div class="col timer">
													<strong>00:11:45 Left</strong>
												</div>
												<div class="col text-right">
													<p>1024</p>
												</div>
											</div>
										</div>
										<div class="target in-shadow">
											<div class="row no-gutters title mb-2">
												<div class="col">
													<strong>Monthly Target</strong>
												</div>
												<div class="col text-right">
													<span>Steps Vs Target</span>
												</div>
											</div>
											<div class="paw mb-2">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
												<img src="images/step.png" class="img-fluid">
											</div>
											<div class="row no-gutters title">
												<div class="col">
													<p>Coupon Value: $25</p>
												</div>
												<div class="col timer">
													<strong>00:11:45 Left</strong>
												</div>
												<div class="col text-right">
													<p>1024</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-7 coupon ">
										<div class="coupon-wrap in-shadow">
											<div class="row no-gutters heading mb-4">
												<div class="col-lg-6">
													<h4>Target Achievment History</h4>
												</div>
												<div class="col-lg-6 text-lg-right">
													<h4>Total Money Won - <span class="bluee">$23</span></h4>
												</div>
											</div>
											<div class="row coupons-list">
												<div class="col-sm-6">
													<div class="coupon-wrap-box">
														<div class="img-wrap">
															<img src="images/coupon.png" class="img-fluid">
														</div>
														<p class="sps">Steps - 1300</p>
														<p class="status pending">Status - Pending</p>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="coupon-wrap-box">
														<div class="img-wrap">
															<img src="images/coupon.png" class="img-fluid">
														</div>
														<p class="sps">Steps - 1300</p>
														<p class="status reedmed">Status - Reedmed</p>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="coupon-wrap-box">
														<div class="img-wrap">
															<img src="images/coupon.png" class="img-fluid">
														</div>
														<p class="sps">Steps - 1300</p>
														<p class="status pending">Status - Pending</p>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="coupon-wrap-box">
														<div class="img-wrap">
															<img src="images/coupon.png" class="img-fluid">
														</div>
														<p class="sps">Steps - 1300</p>
														<p class="status pending">Status - Pending</p>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal-wrap">
	<div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-wrap">
						<p>Are you sure to block?</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade maiilModal" id="maiilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Compose Promotional Mail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-wrap">
						<!-- Form -->
						<form class="" style="">
							<div class="md-form mt-0">
								<input type="email" id="FormEmail" class="form-control">
								<label for="FormEmail">E-mail</label>
							</div>
							<div class="md-form mt-0">
								<input type="text" id="subEmail" class="form-control">
								<label for="subEmail">Subject</label>
							</div>
							<div class="md-form mt-0">
								<textarea class="form-control" id="textarea2" rows="3"></textarea>
								<label for="textarea2">Message</label>
							</div>
							
							<!-- Sign up button -->
							<button class="btn" type="submit">Sign in</button>
						</form>
						<!-- Form -->
					</div>
				</div>
				
			</div>
		</div>
	</div>

</div>
@stop