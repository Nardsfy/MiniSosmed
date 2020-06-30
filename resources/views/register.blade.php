<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
    <head> 
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="assets/css/register.css">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Register | sociify</title>
	</head>
	<body>
		<section class="bg-block">
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h2 class="title">Register Sociify</h2>
	               		<hr />
	               	</div>

	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action=" {{ route('register') }} ">
						@csrf
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="name" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Your Username"/>
                                     @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               		@enderror
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" name="email" id="email" placeholder="Your Email"/>
									@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                	@enderror
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="key" class="cols-sm-2 control-label required">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock aria-hidden="true"></i></span>
									<input type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" name="password" id="key"  placeholder="Your Password"/>
									 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                	@enderror
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password-confirm" class="cols-sm-2 control-label required">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock aria-hidden="true"></i></span>
									<input type="password" class="form-control" required autocomplete="new-password" name="password_confirmation" id="password-confirm"  placeholder="Confirm Your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
							<div class="batas">
								<hr/>
							</div>
							<div class="direct-login">
	               				Already have account? <a href=" {{ route('signin') }} ">Login</a>
	               			</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		</section>
	</body>
</html>