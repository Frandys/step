@extends('layouts.admin.dashboard')
@section('section')
	@include('message.message')
			<div class="col-lg-10">
				<div class="admin-wrap">

					<div class="diash-wrap-white">
						<div class="dash-page register">
							<div class="row dash-top page-title mb-2">
								<div class="col">
									<h3 class="small-head">Changing password</h3>
								</div>

							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-md-offset-3 col-md-6">
											<form role="form" method="POST" action="{{ url('admin/change_password') }}">
												{{ csrf_field() }}
												<div class="form-group">
													<label for="disabledSelect">Old Password</label>
													<input required minlength="6" maxlength="255" name="old_password" class="form-control" type="password">
													@if ($errors->has('old_password'))
														<span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
													@endif
												</div>

												<div class="form-group">
													<label for="disabledSelect">New Password</label>
													<input required minlength="6" maxlength="255" name="password" class="form-control" type="password">
													@if ($errors->has('password'))
														<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
													@endif
												</div>

												<div class="form-group">
													<label for="disabledSelect">Confirm Password</label>
													<input required minlength="6" maxlength="255" name="confirm_password" class="form-control" type="password">
													@if ($errors->has('confirm_password'))
														<span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
													@endif
												</div>

												<button type="submit" class="btn btn-primary">Submit</button>

											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


@stop