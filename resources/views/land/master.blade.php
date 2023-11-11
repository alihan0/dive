<!doctype html>
<html class="no-js" lang="{{$system->site_lang}}">

<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- site favicon -->
	<link rel="icon" type="image/png" href="{{$system->site_favicon}}">
	<!-- Place favicon.ico in the root directory -->

	<!-- All stylesheet and icons css  -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/animate.css">
	<link rel="stylesheet" href="/assets/css/icofont.min.css">
	<link rel="stylesheet" href="/assets/css/swiper.min.css">
	<link rel="stylesheet" href="/assets/css/lightcase.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/style.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    @yield('style')
</head>

<body>
	<!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
	<!-- preloader ending here -->

	<!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-rounded-up"></i></a>
    <!-- scrollToTop ending here -->




	<!-- ==========Header Section Starts Here========== -->
	<header class="header-section style2">
		<div class="container">
			<div class="header-holder">
				<div class="header-menu-part">
					<div class="header-top">
						<div class="header-top-area">
							<ul class="left">
								<li>
									<i class="icofont-ui-email"></i> <span>{{$system->email}}</span>
								</li>
								<li>
									<i class="icofont-ui-call"></i> <span>{{$system->phone}}</span>
								</li>
							</ul>
							<ul class="social-icons d-flex align-items-center">

								@if ($system->facebook)
								<li>
									<a href="{{$system->facebook}}" target="_blank" class="fb"><i class="fab fa-facebook-f"></i></a>
								</li>
								@endif

								@if ($system->twitter)
								<li>
									<a href="{{$system->twitter}}" target="_blank" class="fb"><i class="fab fa-twitter"></i></a>
								</li>
								@endif

								@if ($system->instagram)
								<li>
									<a href="{{$system->instagram}}" target="_blank" class="fb"><i class="fab fa-instagram"></i></a>
								</li>
								@endif

								@if ($system->linkedin)
								<li>
									<a href="{{$system->linkedin}}" target="_blank" class="fb"><i class="fab fa-linkedin"></i></a>
								</li>
								@endif

								@if ($system->discord)
								<li>
									<a href="{{$system->discord}}" target="_blank" class="fb"><i class="fab fa-discord"></i></a>
								</li>
								@endif

								@if ($system->youtube)
								<li>
									<a href="{{$system->youtube}}" target="_blank" class="fb"><i class="fab fa-youtube"></i></a>
								</li>
								@endif

								@if ($system->twitch)
								<li>
									<a href="{{$system->twitch}}" target="_blank" class="fb"><i class="fab fa-twitch"></i></a>
								</li>
								@endif

								@if ($system->skype)
								<li>
									<a href="{{$system->skype}}" target="_blank" class="fb"><i class="fab fa-skype"></i></a>
								</li>
								@endif
							</ul>
						</div>
					</div>
					<div class="header-bottom d-flex flex-wrap justify-content-between align-items-center">
						<div class="brand-logo d-none d-lg-inline-block">
							<div class="logo">
								<a href="/">
									<img src="{{$system->logo_primary}}" alt="logo">
								</a>
							</div>
						</div>
						<div class="header-wrapper justify-content-lg-end">
							<div class="mobile-logo d-lg-none">
								<a href="/"><img src="{{$system->logo_primary_alt}}" alt="logo"></a>
							</div>
							<div class="menu-area">
								<ul class="menu">
									<li>
                                        <a href="/" class="active">Home</a>
                                    </li>

									<li>
										<a href="/teams">Teams</a>
									</li>
									<li><a href="/tournaments">Tournaments</a></li>
									<li><a href="/fixture">Fixture</a></li>
									<li><a href="/support">Support</a></li>
								</ul>
								<a href="/app/" class="login"><i class="icofont-user"></i> <span>LOG IN</span> </a>
								

								<!-- toggle icons -->
								<div class="header-bar d-lg-none">
									<span></span>
									<span></span>
									<span></span>
								</div>
								<div class="ellepsis-bar d-lg-none">
									<i class="icofont-info-square"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
	<!-- ==========Header Section Ends Here========== -->

    @yield('content')

	<!-- ================ footer Section start Here =============== -->
    <footer class="footer-section">
        <div class="footer-top">
            <div class="container">
                <div class="row g-3 justify-content-center g-lg-0">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-top-item lab-item">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="/assets/images/footer/icons/01.png" alt="Phone-icon">
                                </div>
                                <div class="lab-content">
                                    <span>Phone Number : +88012 345 678 912</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-top-item lab-item">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="/assets/images/footer/icons/02.png" alt="email-icon">
                                </div>
                                <div class="lab-content">
                                    <span>Email : youremail@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-top-item lab-item">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="/assets/images/footer/icons/03.png" alt="location-icon">
                                </div>
                                <div class="lab-content">
                                    <span>Address : 30 North West New York 240</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle padding-top padding-bottom" style="background-image: url(/assets/images/footer/bg-2.jpg);">
            <div class="container">
                <div class="row padding-lg-top">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-middle-item-wrapper">
                            <div class="footer-middle-item mb-lg-0">
                                <div class="fm-item-title mb-4">
                                    <img src="/assets/images/logo/logo.png" alt="logo">
                                </div>
                                <div class="fm-item-content">
                                    <p class="mb-4">Upropriate brand economca sound technolog after covalent technology enable prospective wastng markets whereas propriate and brand economca sound technolog</p>
									<ul class="match-social-list d-flex flex-wrap align-items-center">
										<li><a href="#"><img src="/assets/images/match/social-1.png" alt="vimeo"></a></li>
										<li><a href="#"><img src="/assets/images/match/social-2.png" alt="youtube"></a></li>
										<li><a href="#"><img src="/assets/images/match/social-3.png" alt="twitch"></a></li>
									</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-middle-item-wrapper">
                            <div class="footer-middle-item mb-lg-0">
                                <div class="fm-item-title">
                                    <h4>Top jackpot games</h4>
                                </div>
                                <div class="fm-item-content">
                                    <div class="fm-item-widget lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <a href="#"> <img src="/assets/images/footer/01.jpg" alt="footer-widget-img"></a>
                                            </div>
                                            <div class="lab-content">
                                                <h6><a href="blog-single.html">free Poker Game</a></h6>
                                                <p>Poker: <b>$230</b></p>
												<div class="rating">
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fm-item-widget lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <a href="#"><img src="/assets/images/footer/02.jpg" alt="footer-widget-img"></a>
                                            </div>
                                            <div class="lab-content">
                                                <h6><a href="blog-single.html">CLUB Poker Game</a></h6>
                                                <p>Poker: <b>$290</b></p>
												<div class="rating">
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fm-item-widget lab-item">
                                        <div class="lab-inner">
                                            <div class="lab-thumb">
                                                <a href="#"><img src="/assets/images/footer/03.jpg" alt="footer-widget-img"></a>
                                            </div>
                                            <div class="lab-content">
                                                <h6><a href="blog-single.html">ROYAL Poker Game</a></h6>
                                                <p>Poker: <b>$330</b></p>
												<div class="rating">
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
													<i class="icofont-ui-rating"></i>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="footer-middle-item-wrapper">
                            <div class="footer-middle-item-3 mb-lg-0">
                                <div class="fm-item-title">
                                    <h4>Our Newsletter</h4>
                                </div>
                                <div class="fm-item-content">
                                    <p>Bi-Gamer esports organization supported by community leaders</p>
                                    <form>
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" placeholder="Your Name">
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="email" class="form-control" placeholder="Your Email">
                                        </div>
										<button type="submit" class="default-button"><span>Send Massage <i class="icofont-circled-right"></i></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-content text-center">
                            <p>&copy;2022 <a href="index.html">Bi-Gamer</a> - eSpost And Gameing HTML Template.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================ footer Section end Here =============== -->







	<!-- All Needed JS -->
	<script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>
	<script src="/assets/js/vendor/modernizr-3.11.2.min.js"></script>
	<script src="/assets/js/circularProgressBar.min.js"></script>
	<script src="/assets/js/isotope.pkgd.min.js"></script>
	<script src="/assets/js/swiper.min.js"></script>
	<script src="/assets/js/lightcase.js"></script>
	<script src="/assets/js/waypoints.min.js"></script>
	<script src="/assets/js/wow.min.js"></script>
	<script src="/assets/js/vendor/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/plugins.js"></script>
	<script src="/assets/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>


	<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
	<script>
		window.ga = function () {
			ga.q.push(arguments)
		};
		ga.q = [];
		ga.l = +new Date;
		ga('create', 'UA-XXXXX-Y', 'auto');
		ga('set', 'anonymizeIp', true);
		ga('set', 'transport', 'beacon');
		ga('send', 'pageview')
	</script>
	<script src="https://www.google-analytics.com/analytics.js" async></script>
    @yield('script')


</body>

</html>