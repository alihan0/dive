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
	<title>Verification Gender&Birthday - {{$system->site_name}}</title>
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
										<h3 class="text-white fw-bold">Gender&Birthday Verify</h3>
                                        <p class="text-white text-start">
                                            Please enter your available date.
                                        </p>
									</div>
									
									<div class="form-body mb-4">
										<form class="row g-3" action="javascript:;">
                                            <div class="col-12">
												<label for="date1" class="form-label text-white">Your Available Date-Time 1</label>
												<div class="row">
                                                    <div class="col-6">
                                                        <input type="date" class="form-control" id="date1">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="time" class="form-control" id="time1">
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-12">
												<label for="date2" class="form-label text-white">Your Available Date-Time 2</label>
												<div class="row">
                                                    <div class="col-6">
                                                        <input type="date" class="form-control" id="date2">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="time" class="form-control" id="time2">
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-12">
												<label for="date3" class="form-label text-white">Your Available Date-Time 3</label>
												<div class="row">
                                                    <div class="col-6">
                                                        <input type="date" class="form-control" id="date3">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="time" class="form-control" id="time3">
                                                    </div>
                                                </div>
											</div>
                                            
                                            <div class="col-12">
												<label for="username" class="form-label text-white">Discord username</label>
												<input type="text" class="form-control" id="username" placeholder="@username">
											</div>
											
											
                                            
                                            
											<div class="col-md-6">
												
											</div>
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary mb-4" onclick="createMeeting({{Auth::user()->id}})"><i class="fa-solid fa-plus"></i>Create Meeting</button>
                                                    <p>
                                                        Please specify 3 dates and times that you are available to meet face to face. Make sure your Discord username is correct. Your interview will be held on one of the dates and times you specify. You will be informed about your interview date and time.
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
		function createMeeting(user){
            var date1 = $("#date1").val();
            var date2 = $("#date2").val();
            var date3 = $("#date3").val();
            var time1 = $("#time1").val();
            var time2 = $("#time2").val();
            var time3 = $("#time3").val();
			var username = $("#username").val();

			axios.post('/app/create-meeting', {user:user, username:username, date1:date1,date2:date2,date3:date3,time1:time1,time2:time2,time3:time3}).then((res)=>{
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
