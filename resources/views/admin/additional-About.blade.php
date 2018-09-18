@extends('layouts.admin.dashboard')
@section('section')
@section ('page_heading','Manage')
					<div class="diash-wrap-white">
						<div class="dash-page register">
							<div class="row dash-top page-title mb-2">
								<div class="col">
									<h3 class="small-head">Manage {{\Request::segment('3') == 'policy' ? 'policy' : 'about'}}</h3>
								</div>
 							</div>
							@include('message.message')

							<div class="content-wrap in-shadow">
								<form role="form" method="POST" action="{{ url('admin/additional').'/'.$about->id }}">
									{{ csrf_field() }}

									<input type="hidden" name="_method" value="PUT">
									<div class="form-group">
										<label for="title">Title</label>
										<input name="title" id="title" value="{{$about->title}}" class="form-control" required type="text">
										@if ($errors->has('title'))
											<span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
										@endif
									</div>
									<input name="slug" id="slug" value="{{\Request::segment('3') == 'policy' ? 'policy' : 'about'}}
                                            " class="form-control" required type="hidden">

									<div class="form-group">
										<label for="title">Description</label>
										<textarea id="description"  name="description">{{$about->description}}</textarea>
										@if ($errors->has('description'))
											<span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
										@endif
									</div>

									<button type="submit" class="btn btn-primary">Submit</button>

								</form>
								@if(!\Request::segment('3') == 'policy')
<a href="{{url('admin/additional/policy')}}">Policy</a>
								@else
                     <a href="{{url('admin/additional-faq')}}">FAQ</a>

                                @endif
							</div>
							
						</div>
					</div>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
@stop
