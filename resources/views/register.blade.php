<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>User Sign-Up</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('auth/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('auth/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{asset('auth/font/flaticon.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('auth/style.css')}}">
	<script src="{{asset('auth/sweetalert.min.js')}}"></script>
	<script src="{{asset('auth/jquery/3.6.1/jquery.min.js')}}"></script>
    
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	
</head>
<body>
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
	<section class="fxt-template-animation fxt-template-layout14">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
					<div class="fxt-content">
						<div class="fxt-header">
							<p>Sign-Up</p>
							<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							</div>
							<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							</div>
						</div>
						<div class="fxt-form">
							<form method="POST" action="{{ route('registration-post') }}" >
							@csrf
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
									<input class="form-control" type="text" placeholder="Name" name="name" id="name" value="{{ old('name') }}" required>
                  @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif	
                </div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
									<input class="form-control" type="email" placeholder="Enter Email" name="email" id="email" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif	
                </div>
				</div>
				<div class="form-group">
				<div class="fxt-transformY-50 fxt-transition-delay-1">
				<input class="form-control" type="text" placeholder="Mobile Number" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" required oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                  @if ($errors->has('mobile_number'))
                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                  @endif		
                </div>
				</div>
                <a href="{{route(name: 'login')}}" class="switcher-text">Login Here</a>

								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" id="butlogin" class="fxt-btn-fill">Registartion</button>
									</div>
								</div>
							</form>
						</div>
            </div>
				</div>
			</div>
		</div>
	</section>
    <!-- jquery-->
	<script src="{{asset('auth/js/jquery-3.5.0.min.js')}}"></script>
	<!-- Bootstrap js -->
	<script src="{{asset('auth/js/bootstrap.min.js')}}"></script>
	<!-- Imagesloaded js -->
	<script src="{{asset('auth/js/imagesloaded.pkgd.min.js')}}"></script>
	<!-- Validator js -->
	<script src="{{asset('auth/js/validator.min.js')}}"></script>
	<!-- Custom Js -->
	<script src="{{asset('auth/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
    @endif
    @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
    @endif
    @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
    @endif
  </script>
</body>
</html>