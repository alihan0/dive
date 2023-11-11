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
                                <div class="banner__content">
                                    <h1>{!!$hero->title!!}</h1>
                                    <h2>{!!$hero->sub_title!!}</h2>
                                    <p>{!!$hero->detail!!}</p>
                                    <a href="{{$hero->button1_src}}" class="default-button">{!!$hero->button1_text!!}</a>
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

@endsection