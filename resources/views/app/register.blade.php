<!doctype html>
<html lang="{{$system->site_lang}}" class="dark-theme">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="/apps/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="/apps/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/apps/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/apps/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/apps/css/pace.min.css" rel="stylesheet" />
	<script src="/apps/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="/apps/css/bootstrap.min.css" rel="stylesheet">
	<link href="/apps/css/bootstrap-extended.css" rel="stylesheet">
	<link href="/apps/css/app.css" rel="stylesheet">
	<link href="/apps/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
	<title>Register - {{$system->site_name}}</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<a href="/" ><img src="{{$system->logo_primary}}" width="180" alt="" /></a>
						</div>
						<div class="card bg-dark shadow-none">
							<div class="card-body">
								<div class="border p-4 rounded">
									
									<div class="text-center mb-4">
										<h3 class="text-white fw-bold">Sign Up</h3>
									</div>
									
									<div class="form-body mb-4">
										<form class="row g-3" action="javascript:;">
                                            <div class="col-12">
												<label for="name" class="form-label text-white">Full Name</label>
												<input type="text" class="form-control" id="name" placeholder="Email Address">
											</div>
											<div class="col-12">
												<label for="email" class="form-label text-white">Email Address</label>
												<input type="text" class="form-control" id="email" placeholder="Email Address">
											</div>
											<div class="col-12">
												<label for="password" class="form-label text-white">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text "><i class='bx bx-hide'></i></a>
												</div>
											</div>
                                            <div class="col-12">
												<label for="birthdate" class="form-label text-white">Birthdate</label>
												<input type="date" class="form-control" id="birthdate" placeholder="Email Address">
											</div>
                                            <div class="col-12">
												<label for="gender" class="form-label text-white">Gender</label>
												<select name="gender" id="gender" class="form-control">
                                                    <option value="0">Choose...</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
											</div>
											<div class="col-md-6">
												
											</div>
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary" onclick="register()"><i class="bx bxs-lock-open"></i>Sign up</button>
												</div>
											</div>
										</form>
									</div>
									<div class="text-center">
										<p class="text-white">Do you have an account? <a href="/auth/login">Sign in.</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="/apps/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="/apps/js/jquery.min.js"></script>
	<script src="/apps/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/apps/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/apps/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script src="/apps/js/show-hide-password.js"></script>
	<!--app JS-->
	<script src="/apps/js/app.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<script>
		function register(){
			var email = $("#email").val();
			var password = $("#password").val();
			var name = $("#name").val();
			var birthdate = $("#birthdate").val();
			var gender = $("#gender").val();

			axios.post('/auth/register', {email:email, password:password, name:name, birthdate:birthdate, gender:gender}).then((res)=>{
				toastr[res.data.type](res.data.message);
				if(res.data.status){
					setInterval(() => {
						window.location.assign('/app');
					}, 500);
				}
			});
		}
	</script>
</body>

</html>
