<!doctype html>
<html lang="en">
  <head>
  	<title> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="asset/css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(asset/images/image01.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
 <form method="POST" action="{{ route('login') }}">
                        @csrf
              <div class="form-group ">
                <label for="username">ADRESSE EMAIL</label>
                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
              <div class="form-group  mb-3">
                <label for="password">MOT DE PASSE</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
              <button type="submit" class="btn btn-block btn-lg btn-dark bg-gradient-dark">
                                    {{ __('connecter') }}
                                </button>

            </form>

		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="asset/js/jquery.min.js"></script>
  <script src="asset/js/popper.js"></script>
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/main.js"></script>

	</body>
</html>

