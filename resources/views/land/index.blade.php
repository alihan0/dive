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
   

@endsection