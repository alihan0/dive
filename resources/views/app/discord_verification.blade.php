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
	<title>Verification Email - {{$system->site_name}}</title>
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
										<h3 class="text-white fw-bold">Discord Verify</h3>
                                        <p class="text-white text-start">
                                            Please enter discord username. We check your discord verification.
                                        </p>
									</div>
									
									<div class="form-body mb-4">
										<form class="row g-3" action="javascript:;">
                                            <div class="col-12">
												<label for="username" class="form-label text-white">Discord username</label>
												<input type="text" class="form-control" id="username" placeholder="@username">
											</div>
											
											
                                            
                                            
											<div class="col-md-6">
												
											</div>
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary mb-4" onclick="verifyDiscord({{Auth::user()->id}})"><i class="bx bxs-lock-open"></i>Verify Discord</button>
                                                    <p>
                                                        In order to perform this verification, you must be on our Official Discord Server and have previously been assigned to the "Verified" role. Otherwise this validation will fail. If you are not on the server or do not have a verified role, please perform "Gender&Birthday Verification".
                                                    </p>
												</div>
											</div>
										</form>
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
		function verifyDiscord(user){
			var username = $("#username").val();

			axios.post('/discord/check_role', {user:user, username:username}).then((res)=>{
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
