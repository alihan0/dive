@extends('app.master')

@section('title', 'Matches')
    
@section('content')




        



        


<div class="page" data-uia-timeline-skin="4" data-uia-timeline-adapter-skin-4="ui-card-skin-#1">
    <div class="uia-timeline">
      <div class="uia-timeline__container">
        <div class="uia-timeline__line"></div>
        


        
@php
$nestedMatches = [];

// Loop through each match
foreach ($matches as $match) {
    // Get the tournament value for the current match
    $tournament = $match['tournament'];

    // Check if the tournament key exists in the nestedMatches array
    if (!array_key_exists($tournament, $nestedMatches)) {
        // If not, create an empty array for that tournament
        $nestedMatches[$tournament] = [];
    }

    // Add the current match to the nestedMatches array
    $nestedMatches[$tournament][] = $match;
}
@endphp

@foreach ($nestedMatches as $tournament => $tournamentMatches)

<div class="uia-timeline__annual-sections">
    <span class="uia-timeline__year" aria-hidden="true">{{$tournament}}</span>
    <div class="uia-timeline__groups">
      



        @foreach ($tournamentMatches as $match)

      <section class="uia-timeline__group" aria-labelledby="timeline-demo-4-heading-1">
          <div class="d-flex">
            <div class="uia-timeline__point uia-card" data-uia-card-skin="1" data-uia-card-mod="1">
                <div class="bg-white py-2 px-4"  style="border-left:4px solid #4556BB">
                    <span class="text-dark">{{$match->Tournament->title ?? ''}}</span>
                  </div>
                <div class="uia-card__container">
                  <div class="uia-card__intro">
                    <div class="w-100 d-flex justify-content-between">
                      <div class="bg-white py-2 px-4">
                        <span class="uia-card__day text-dark">Round</span>
                        <span class="text-dark">{{$match->round}}</span>
                      </div>
                      
                    </div>
                  </div>
                  <div class="uia-card__body">
                    <div class="uia-card__description">
                      
                        <ul class="list-group w-100 ">
                            <li class="list-group-item text-white">[{{$match->Team1->abbreviation}}] - {{$match->Team1->name}}</li>
                            <li class="list-group-item text-white">[{{$match->Team2->abbreviation}}] - {{$match->Team2->name}}</li>
                        </ul>
    
                    </div>
                    
                  </div>
                  
                </div>
                <div class="bg-white py-2 px-4"  style="border-left:4px solid #4556BB">
                    <i class="fas fa-clock text-dark"></i>
                    @if ($match->MatchTime)
                    <span class="text-dark">{{ \Carbon\Carbon::parse($match->MatchTime->match_time)->format('d F, Y H:i') }}</span>
                    @endif
                  </div>
              </div>
              <div class="w-100">
                <img src="{{$match->Tournament->cover ?? ''}}" class="" style="height:241px" alt="">
              </div>
          </div>
        </section>
  
        @endforeach
        

        
      
    </div>
  </div>
@endforeach












        <div class="uia-timeline__annual-sections">
            
            <div class="uia-timeline__groups">
            </div>
        </div>
        <div class="uia-timeline__annual-sections">
            
            <div class="uia-timeline__groups">
            </div>
        </div>
        <div class="uia-timeline__annual-sections">
            
            <div class="uia-timeline__groups">
            </div>
        </div>
        <div class="uia-timeline__annual-sections">
            
            <div class="uia-timeline__groups">
            </div>
        </div>
        <div class="uia-timeline__annual-sections" class="text-center" style="text-center">
            <span class="uia-timeline__year" style="font-size:8px;text-center;padding-left:10px" aria-hidden="true">Before the Big Bang</span>
            <div class="uia-timeline__groups">
            </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
  
  
@endsection


@section('style')
    <style>
        /*
=====
RESET
=====
*/

:where(.ra-link){
  display: var(--ra-link-display, inline-flex);
}

:where(.ra-link[href]){
  color: var(--ra-link-color, inherit);
  text-decoration: var(--ra-link-text-decoration, none);
}

:where(.ra-heading){
  margin-block-start: var(--ra-heading-margin-block-start, 0);
  margin-block-end: var(--ra-heading-margin-block-end, 0);
}

/*
=====
HELPERS
=====
*/

.ha-screen-reader{
  width: var(--ha-screen-reader-width, 1px);
  height: var(--ha-screen-reader-height, 1px);
  padding: var(--ha-screen-reader-padding, 0);
  border: var(--ha-screen-reader-border, none);

  position: var(--ha-screen-reader-position, absolute);
  clip-path: var(--ha-screen-reader-clip-path, rect(1px, 1px, 1px, 1px));
  overflow: var(--ha-screen-reader-overflow, hidden);
}

/*
=====
UIA-TIMELINE
=====
*/

.uia-timeline__container{
  display: var(--uia-timeline-display, grid);
}

.uia-timeline__groups{
  display: var(--uia-timeline-groups-display, grid);;
  gap: var(--uia-timeline-groups-gap, 1rem);
}

/*
SKIN 1
*/

[data-uia-timeline-skin="skin-1"] .uia-timeline__step{
	line-height: 1;
	font-size: var(--uia-timeline-step-font-size, 2rem);
	font-weight: var(--uia-timeline-step-font-weight, 700);
	color: var(--uia-timeline-step-color);
}

[data-uia-timeline-skin="skin-1"] .uia-timeline__point-intro{
	display: grid;
	grid-template-columns: min-content 1fr;
	align-items: center;
	gap: var(--uia-timeline-point-intro-gap, .5rem);
}

	[data-uia-timeline-skin="skin-1"] .uia-timeline__point-date{
	grid-row: 1;
	grid-column: 2;
}

[data-uia-timeline-skin="skin-1"] .uia-timeline__point-heading{
	grid-column: span 2;
}

[data-uia-timeline-skin="skin-1"] .uia-timeline__point-description{
	margin-block-start: var(--uia-timeline-group-gap, 1rem);
	inline-size: min(100%, var(--uia-timeline-content-max-limit));
}

/*
SKIN 2
*/

[data-uia-timeline-skin="2"]{
	--_uia-timeline-line-color_default: #222;
	--_uia-timeline-minimal-gap: var(--uia-timeline-minimal-gap, .5rem);
	--_uia-timeline-space: calc(var(--_uia-timeline-arrow-size) + var(--_uia-timeline-dot-size) + var(--_uia-timeline-dot-size) / 2 + var(--_uia-timeline-minimal-gap));
	--_uia-timeline-dot-size: var(--uia-timeline-dot-size, 1rem);
	--_uia-timeline-arrow-size: var(--uia-timeline-arrow-size, .25rem);
	--_uia-timeline-arrow-position: var(--uia-timeline-arrow-position, 1rem);
}

[data-uia-timeline-skin="2"] .uia-timeline__container{
	position: relative;
	padding-inline-start: calc(var(--_uia-timeline-space));
}

[data-uia-timeline-skin="2"] .uia-timeline__line{
	inline-size: var(--uia-timeline-line-thickness, 3px);
	block-size: 100%;
	background-color: var(--uia-timeline-line-color, var(--_uia-timeline-line-color_default));

	position: absolute;
	inset-block-start: 0;
	inset-inline-start: calc(var(--_uia-timeline-dot-size) / 2);
	transform: translate(-50%);
}

[data-uia-timeline-skin="2"] .uia-timeline__group{
	position: relative;
}

[data-uia-timeline-skin="2"] .uia-timeline__dot{
	box-sizing: border-box;
	inline-size: var(--_uia-timeline-dot-size);
	block-size: var(--_uia-timeline-dot-size);

	border-radius: 50%;
	border: 
		var(--uia-timeline-dot-border-thickness, 1px) 
		solid 
		var(--uia-timeline-dot-border-color, var(--_uia-timeline-line-color_default));
	background-color: var(--uia-timeline-dot-color, var(--_uia-timeline-line-color_default));

	position: absolute;
	/* - 4px is used for set the default gap from the top border */
	inset-block-start: calc(var(--uia-timeline-dot-position, var(--_uia-timeline-arrow-position)) + 4px);
	inset-inline-start: calc(-1 * var(--_uia-timeline-space));
}	

[data-uia-timeline-skin="2"] .uia-timeline__point{
	position: relative;
	background-color: var(--uia-timeline-point-background-color, #fff);
}

[data-uia-timeline-skin="2"] .uia-timeline__point::before{
	content: "";
	inline-size: 0;
	block-size: 0;

	border: var(--_uia-timeline-arrow-size) solid var(--uia-timeline-arrow-color, var(--_uia-timeline-line-color_default));
	border-block-start-color: transparent;
	border-inline-end-color: transparent;

	position: absolute;
	/* - 6px is used for set the default gap from the top border */
	inset-block-start: calc(var(--_uia-timeline-arrow-position) + 6px);
	inset-inline-start: calc(-1 * var(--_uia-timeline-arrow-size) + 1px);
	transform: rotate(45deg);
}

[data-uia-timeline-adapter-skin-2="ui-card-skin-#1"]{
  --uia-card-padding: var(--uia-timeline-point-padding, 1.5rem 1.5rem 1.25rem);
  --uia-card-border-thickness: var(--uia-timeline-point-border-thickness, 3px);
	--uia-card-border-color: var(--uia-timeline-point-border-color, var(--_uia-timeline-line-color_default));		
  --uia-card-background-color: var(--uia-timeline-point-background-color);  
}

/*
SKIN 3
*/

[data-uia-timeline-skin="3"]{
  --_uia-timeline-line-color_default: #222;
  --_uia-timeline-space: var(--uia-timeline-space, 1rem);
  --_uia-timeline-line-thickness: var(--uia-timeline-line-thickness, 2px);
  --_uia-timeline-point-line-position: var(--uia-timeline-point-line-position, 1rem);
}

[data-uia-timeline-skin="3"] .uia-timeline__container{
  position: relative;
  gap: var(--uia-timeline-annual-sections-gap, 2.5rem);
}

[data-uia-timeline-skin="3"] .uia-timeline__line{
  inline-size: var(--_uia-timeline-line-thickness);
  block-size: 100%;
  background-color: var(--uia-timeline-line-color, var(--_uia-timeline-line-color_default));

  position: absolute;
  inset-block-start: 0;
  inset-inline-start: 0;
}

[data-uia-timeline-skin="3"] .uia-timeline__annual-sections{
  display: grid;
  gap: 2rem;
}

[data-uia-timeline-skin="3"] .uia-timeline__groups{
  padding-inline-start: calc(var(--_uia-timeline-space));
}

[data-uia-timeline-skin="3"] .uia-timeline__group{
  position: relative;
  isolation: isolate;
}

[data-uia-timeline-skin="3"] .uia-timeline__point{
  background-color: var(--uia-timeline-point-background-color, #fff);
}

[data-uia-timeline-skin="3"] .uia-timeline__point::before{
  content: "";
  inline-size: 100%;
  block-size: var(--_uia-timeline-line-thickness);
  background-color: var(--uia-timeline-line-color, var(--_uia-timeline-line-color_default));

  position: absolute;
  inset-block-start: var(--_uia-timeline-point-line-position);
  inset-inline-start: calc(-1 * var(--_uia-timeline-space));
  z-index: -1;
}

[data-uia-timeline-skin="3"] .uia-timeline__year{
  inline-size: fit-content;
  padding: var(--uia-timeline-year-padding, .25rem .75rem);
  background-color: var(--uia-timeline-year-background-color, var(--_uia-timeline-line-color_default));
  color: var(--uia-timeline-year-color, #f0f0f0);
}

[data-uia-timeline-adapter-skin-3="ui-card-skin-#1"]{
  --uia-card-padding: var(--uia-timeline-point-padding, 1.5rem 1.5rem 1.25rem);
  --uia-card-border-thickness:  var(--uia-timeline-point-border-thickness, 3px);
	--uia-card-border-color: var(--uia-timeline-point-border-color, var(--_uia-timeline-line-color_default));		
  --uia-card-background-color: var(--uia-timeline-point-background-color);  
}

/*
SKIN 4
*/

[data-uia-timeline-skin="4"]{
  --_uia-timeline-line-color_default: #222;
  --_uia-timeline-space: var(--uia-timeline-space, .5rem);
  --_uia-timeline-line-thickness: var(--uia-timeline-line-thickness, 2px);
	--_uia-timeline-annual-sections-safe-gap: var(--uia-timeline-annual-sections-safe-gap, 1.5rem); 
  --_uia-timeline-point-line-position: var(--uia-timeline-point-line-position, 1rem);
	--_uia-timeline-year-size: var(--uia-timeline-year-size, 3.5rem);
}

[data-uia-timeline-skin="4"] .uia-timeline__container{
  position: relative;
  gap: var(--uia-timeline-annual-sections-gap, 2.5rem);
}

[data-uia-timeline-skin="4"] .uia-timeline__line{
  inline-size: var(--_uia-timeline-line-thickness);
  block-size: 100%;
  background-color: var(--uia-timeline-line-color, var(--_uia-timeline-line-color_default));

  position: absolute;
  inset-block-start: 0;
  inset-inline-start: calc(var(--_uia-timeline-year-size) / 2);
	transform: translate(-50%);
	z-index: -1;
}

[data-uia-timeline-skin="4"] .uia-timeline__annual-sections{
  display: flex;
	align-items: flex-start;
	isolation: isolate;
}

[data-uia-timeline-skin="4"] .uia-timeline__groups{
  padding-inline-start: calc(var(--_uia-timeline-space));
	padding-block-start: calc(var(--_uia-timeline-year-size) + var(--_uia-timeline-annual-sections-safe-gap));
}

[data-uia-timeline-skin="4"] .uia-timeline__group{
  position: relative;
  isolation: isolate;
}

[data-uia-timeline-skin="4"] .uia-timeline__point{
  background-color: var(--uia-timeline-point-background-color, #fff);
}

[data-uia-timeline-skin="4"] .uia-timeline__point::before{
  content: "";
  inline-size: 100%;
  block-size: var(--_uia-timeline-line-thickness);
  background-color: var(--uia-timeline-line-color, var(--_uia-timeline-line-color_default));

  position: absolute;
  inset-block-start: var(--_uia-timeline-point-line-position);
  inset-inline-start: calc(-1 * (var(--_uia-timeline-space) + var(--_uia-timeline-year-size) / 2));
  z-index: -1;
}

[data-uia-timeline-skin="4"] .uia-timeline__year{
  box-sizing: border-box;
	flex: none;
	inline-size: var(--_uia-timeline-year-size);
	block-size: var(--_uia-timeline-year-size);
	
	border: 
		var(--uia-timeline-year-line-thickness, var(--_uia-timeline-line-thickness)) 
		var(--uia-timeline-year-line-style, solid) 
		var(--uia-timeline-line-color, var(--_uia-timeline-line-color_default));
	border-radius: 50%;
	
	display: grid;
	place-items: center;
  background-color: var(--uia-timeline-year-background-color, #f0f0f0);
	
	font-size: var(--uia-timeline-year-font-size, .75rem);
  color: var(--uia-timeline-year-color, #222);
}

[data-uia-timeline-adapter-skin-4="ui-card-skin-#1"]{
  --uia-card-padding: var(--uia-timeline-point-padding, 1.5rem 1.5rem 1.25rem);
  --uia-card-border-thickness:  var(--uia-timeline-point-border-thickness, 3px);
	--uia-card-border-color: var(--uia-timeline-point-border-color, var(--_uia-timeline-line-color_default));	
  --uia-card-background-color: var(--uia-timeline-point-background-color);  
}

/*
=====
UIA-CARD
=====
*/

.uia-card__time-divider::before{
  content: "—";
  margin-inline: var(--uia-card-time-divider-margin-inline, .15rem);
}

[data-uia-card-skin="1"] .uia-card__container{
  display: grid;
  gap: .5rem;
  padding: var(--uia-card-padding, 1rem 1.75rem);

  background-color: #333;
  border-radius: var(--uia-card-border-radius, 2px);
}

[data-uia-card-skin="1"] .uia-card__intro{
  display: grid;
  gap: var(--uia-card-intro-gap, 1rem);
}

[data-uia-card-skin="1"] .uia-card__time{
  grid-row: 1 / 1;
  inline-size: fit-content;
  padding: var(--uia-card-time-padding, .25rem 1.25rem .25rem);
  background-color: var(--uia-card-time-background-color, #f0f0f0);

  font-weight: var(--uia-card-time-font-weight, 700);
  font-size: var(--uia-card-time-font-size, .75rem);
  text-transform: var(--uia-card-time-text-transform, uppercase);
  color: var(--uia-card-time-color, currentColor);
}

[data-uia-card-skin="1"][data-uia-card-mod="1"] .uia-card__container{
    width: 300px;
	border-inline-start:	var(--uia-card-border-thickness, 2px) var(--uia-card-border-style, solid) var(--uia-card-border-color, currentColor);
	box-shadow: var(--uia-card-box-shadow, 0 1px 3px 0 rgba(0, 0, 0, .12), 0 1px 2px 0 rgba(0, 0, 0, .24));
}

/*
=====
DEMO
=====
*/

:root{
  --uia-timeline-line-color: #4557bb;
  --uia-timeline-dot-color: #4557bb;
  --uia-timeline-arrow-color: #4557bb;
  --uia-timeline-line-thickness: 3px;
  --uia-timeline-point-border-color: #4557bb;
  --uia-timeline-group-padding: 1.5rem 1.5rem 1.25rem;
}

[data-uia-timeline-skin="3"]{
	--uia-timeline-year-background-color: #4557bb;
}



p{
  margin-top: 0;
  margin-bottom: 1rem;
  line-height: 1.5;
}

p:last-child{
  margin-bottom: 0;
}

.page{
  max-inline-size: 80ch;
  padding: 5rem 2rem 3rem;
  margin-inline: auto;
}

.linktr{
  display: flex;
  justify-content: flex-end;
  padding: 2rem;
  text-align: center;
}

.linktr__goal{
  background-color: rgb(209, 246, 255);
  color: rgb(8, 49, 112);
  box-shadow: rgb(8 49 112 / 24%) 0 2px 8px 0;
  border-radius: 2rem;
  padding: .75rem 1.5rem;
}
    </style>
@endsection