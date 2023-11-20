<!doctype html>
<html lang="{{$system->site_lang}}" class="dark-theme">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{$system->favicon}}" type="image/png" />
	<!--plugins-->
	<link href="/apps/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/apps/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/apps/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="/apps/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="/apps/css/pace.min.css" rel="stylesheet" />
	<script src="/apps/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="/apps/css/bootstrap.min.css" rel="stylesheet">
	<link href="/apps/css/bootstrap-extended.css" rel="stylesheet">
	<link href="/apps/css/app.css" rel="stylesheet">
	<link href="/apps/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="/apps/css/dark-theme.css" />
	<link rel="stylesheet" href="/apps/css/semi-dark.css" />
	<link rel="stylesheet" href="/apps/css/header-colors.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.0/sweetalert2.min.css"/>
	@yield('style')
	<title>@yield('title')</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="topbar-logo-header">
						<div class="">
							<img src="{{$system->logo_primary}}" class="" width="200" alt="logo icon">
						</div>
						
					</div>
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
					
					<div class="top-menu ms-auto">
						
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="/apps/images/icons/user.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{Auth::user()->name}}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="/app/profile"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="/auth/logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--navigation-->
		<div class="nav-container">
			<div class="mobile-topbar-header">
				<div>
					<img src="/apps/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Syndron</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<nav class="topbar-nav">
				<ul class="metismenu" id="menu">
					<li>
						<a href="/app" >
							<div class="parent-icon"><i class='bx bx-home-circle'></i>
							</div>
							<div class="menu-title">Dashboard</div>
						</a>
					</li>
					<li>
						<a href="/app/tournaments">
							<div class="parent-icon"><i class="fa-solid fa-ranking-star"></i>
							</div>
							<div class="menu-title">Tournaments</div>
						</a>
						
					</li>
					<li>
						<a href="/app/team">
							<div class="parent-icon"><i class="fa-solid fa-people-group"></i>
							</div>
							<div class="menu-title">My Team</div>
						</a>
						
					</li>
					<li>
						<a  href="/app/matches">
							<div class="parent-icon"><i class="fa-solid fa-diagram-project"></i>
							</div>
							<div class="menu-title">My Matches</div>
						</a>
						
					</li>
					<li>
						<a href="/support">
							<div class="parent-icon icon-color-6"> <i class="fa-solid fa-headset"></i>
							</div>
							<div class="menu-title">Support</div>
						</a>
						
					</li>
					
				</ul>
			</nav>
		</div>
		<!--end navigation-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				@if (Auth::user()->email_verification == null)
				<div class="alert bg-primary" style="text-shadow:0 1px 1px #000" role="alert">
					Your email is not verified. The email verification is required. Please verify your email.
					<a href="/auth/verification/email" class="float-end text-white text-decoration-underline">Verify Email</a>
				</div>
				@endif

				@if (Auth::user()->gender_verification == null)
				<div class="alert bg-primary" style="text-shadow:0 1px 1px #000" role="alert">
					Your birthday and gender is not verified. The birthday and gender verification is required. Please verify your birthday and gender.
					<a href="/app/verification/birthday-gender" class="float-end text-white text-decoration-underline">Verify Birthday and Gender</a>
				</div>
				@endif

				@if (Auth::user()->discord_verification == null)
				<div class="alert bg-primary" style="text-shadow:0 1px 1px #000" role="alert">
					Your discord username is not verified. The discord username verification is required. Please verify your discord username.
					<a href="/app/verification/discord" class="float-end text-white text-decoration-underline">Verify Discord Username</a>
				</div>
				@endif

				
				
				
				  
				
				  @yield('content')
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2024. All right reserved.<span class="float-end">v0.1.1</span></p>
			
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="/apps/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="/apps/js/jquery.min.js"></script>
	<script src="/apps/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/apps/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/apps/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="/apps/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="/apps/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="/apps/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="/apps/js/index.js"></script>
	<!--app JS-->
	<script src="/apps/js/app.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.0/sweetalert2.all.min.js"></script>
	@yield('script')
</body>

</html>