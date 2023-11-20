@extends('land.master')

@section('title')
    Home - {{$system->site_name}}
@endsection

@section('content')
<!-- HERO SECTION -->
@if ($hero = $sections->where('section','hero')->first())
     <!-- ===========Banner Section start Here========== -->
	<div class="banner__slider overflow-hidden">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="banner" style="background-image: url({{$hero->cover}});">
                    <div class="container">
                        <div class="row g-0">
                            <div class="col-lg-6 col-12">
                                <div class="banner__content" style="min-height: 250px">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- ===========Banner Section Ends Here========== -->
@endif
   

@if ($match = $sections->where('section','match')->first())
    <!-- ===========Collection Section Start Here========== -->
	<section class="collection-section padding-top padding-bottom">
		<div class="container">
			<div class="section-header">
				<p>{!!$match->sub_title!!}</p>
				<h2>{!!$match->title!!}</h2>
			</div>
			<div class="section-wrapper">
				<div class="row g-4 justify-content-center">
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="game-item item-layer">
							<div class="game-item-inner bg-1">
								<div class="game-thumb">
									<ul class="match-team-list d-flex flex-wrap align-items-center justify-content-center">
										<li class="match-team-thumb"><a href="team-single.html"><img src="assets/images/match/team-1.png" alt="team-img"></a>
										</li>
										<li class="text-center"><img class="w-75 w-md-100" src="assets/images/match/vs.png" alt="vs"></li>
										<li class="match-team-thumb"><a href="team-single.html"><img src="assets/images/match/team-2.png" alt="team-img"></a>
										</li>
									</ul>
								</div>
								<div class="game-overlay">
									<h4><a href="team-single.html">Witch Sports Team</a> </h4>
									<ul class="rating-star d-flex flex-wrap justify-content-center align-items-center">
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="game-item item-layer">
							<div class="game-item-inner bg-1">
								<div class="game-thumb">
									<ul class="match-team-list d-flex flex-wrap align-items-center justify-content-center">
										<li class="match-team-thumb"><a href="team-single.html"><img src="assets/images/match/teamsm/teamsm-4.png" alt="team-img"></a>
										</li>
										<li class="text-center"><img class="w-75 w-md-100" src="assets/images/match/vs.png" alt="vs"></li>
										<li class="match-team-thumb"><a href="team-single.html"><img src="assets/images/match/teamsm/teamsm-3.png" alt="team-img"></a>
										</li>
									</ul>
								</div>
								<div class="game-overlay">
									<h4><a href="team-single.html">Witch Sports Team</a> </h4>
									<ul class="rating-star d-flex flex-wrap justify-content-center align-items-center">
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="game-item item-layer">
							<div class="game-item-inner bg-1">
								<div class="game-thumb">
									<ul class="match-team-list d-flex flex-wrap align-items-center justify-content-center">
										<li class="match-team-thumb"><a href="team-single.html"><img src="assets/images/match/teamsm/teamsm-2.png" alt="team-img"></a>
										</li>
										<li class="text-center"><img class="w-75 w-md-100" src="assets/images/match/vs.png" alt="vs"></li>
										<li class="match-team-thumb"><a href="team-single.html"><img src="assets/images/match/teamsm/teamsm-1.png" alt="team-img"></a>
										</li>
									</ul>
								</div>
								<div class="game-overlay">
									<h4><a href="team-single.html">Witch Sports Team</a> </h4>
									<ul class="rating-star d-flex flex-wrap justify-content-center align-items-center">
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
										<li class="li"><i class="icofont-star"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="button-wrapper text-center mt-5">
					<a href="{{$match->button1_src}}" class="default-button">{!!$match->button1_text!!}</a>
				</div>
			</div>
		</div>
	</section>
	<!-- ===========Collection Section Ends Here========== -->

    
@endif

@if ($about = $sections->where('section','about')->first())
    <!-- ===========About Section start Here========== -->
	<section class="about-section">
		<div class="container">
			<div class="section-wrapper padding-top">
				<div class="row">
					<div class="col-lg-6">
						<div class="about-image">
							<img src="{{$about->cover}}" alt="about-image">
						</div>
					</div>
					<div class="col-lg-6 col-md-10">
						<div class="about-wrapper">
							<div class="section-header">
								<p>{!!$about->sub_title!!}</p>
								<h2>{!!$about->title!!}</h2>
							</div>
							<div class="about-content">
								<p>{!!$about->detail!!}</p>
								{!!$about->content!!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ===========About Section Ends Here========== -->
@endif

@if ($dcbanner = $sections->where('section','dcbanner')->first())
    <!-- ===========CTA Section start Here========== -->
	<section class="cta-section padding-bottom ">
		<div class="container">
			<div class="cta-wrapper item-layer ">
				<div class="cta-item px-4 px-sm-5 py-5" style="background-image: url({{$dcbanner->cover}});">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="cta-content">
								<p class="theme-color text-uppercase ls-2">{!!$dcbanner->sub_title!!}</p>
								<h2 class="mb-3">{!!$dcbanner->title!!}</h2>
								<p class="mb-4">{!!$dcbanner->detail!!}</p>
								<a href="{{$dcbanner->button1_src}}" class="default-button">{!!$dcbanner->button1_text!!}</a>
							</div>
						</div>
						<div class="col-lg-6">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ===========CTA Section Ends Here========== -->
@endif

@if ($team = $sections->where('section','teams')->first())
    <!-- ===========Sponsor Section Start Here========== -->
	<div class="sponsor-section padding-top padding-bottom">
		<div class="container">
			<div class="section-header">
				<p>{!!$team->sub_title!!}</p>
				<h2>{!!$team->title!!}</h2>
			</div>
			<div class="section-wrapper">
				<div class="row g-5 justify-content-center row-cols-md-5 row-cols-sm-3 row-cols-2">
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/01.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/02.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/03.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/04.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/05.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/06.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/07.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="sponsor-item">
							<div class="sponsor-inner">
								<div class="sponsor-thumb text-center">
									<img src="assets/images/sponsor/home-2/08.png" alt="sponsor-thumb">
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- ===========Sponsor Section Ends Here========== -->
@endif
@endsection