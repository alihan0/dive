@extends('app.master')

@section('title', 'Match Details')
    
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <!-- code here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="match">
                                <div class="match-header">
                                    <div class="match-status">Round {{$match->round}}</div>
                                    <div class="match-tournament text-dark"><img src="{{$match->Tournament->cover}}" />{{$match->Tournament->title}}</div>
                                    <div class="match-actions">
                                        @if ($match->MatchTime)
                                        <button class="btn-icon text-dark"><i class="material-icons-outlined"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($match->MatchTime->match_time)->format('d F, Y') }}</i></button>
                                        <button class="btn-icon text-dark"><i class="material-icons-outlined"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($match->MatchTime->match_time)->format('H:i') }}</i></button>
                                        @endif
                                    </div>
                                </div>
                                <div class="match-content">
                                    <div class="column">
                                        <div class="team team--home">
                                            <div class="team-logo">
                                                <img src="{{$match->Team1->logo}}" />
                                            </div>
                                            <h2 class="team-name text-dark">[{{$match->Team1->abbreviation}}] - {{$match->Team1->name}}</h2>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="match-details">
                                            
                                            @if ($match->status == 1)
                                           
                                            <div class="match-score text-dark">
                                                <span class="match-score-number match-score-number--leading">0</span>
                                                <span class="match-score-divider text-dark">:</span>
                                                <span class="match-score-number">0</span>
                                            </div>
                                            @else
                                            <div class="match-score text-dark">
                                                <span class="match-score-number match-score-number--leading">{{$match->winner == 1 ? '1':'0'}}</span>
                                                <span class="match-score-divider text-dark">:</span>
                                                <span class="match-score-number">{{$match->winner == 2 ? '1':'0'}}</span>
                                            </div>
                                            @endif
                                            
                                            
                                            
                                            <button class="match-bet-place text-white" {{$match->status == 2 ? 'disabled':''}}>
                                                {{$match->status == 1 ? 'Report Results':'Match End'}}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="team team--away">
                                            <div class="team-logo">
                                                <img src="{{$match->Team2->logo}}" />
                                            </div>
                                            <h2 class="team-name text-dark">[{{$match->Team2->abbreviation}}] - {{$match->Team2->name}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <ul class="list-group bg-white">
                                @foreach ($match->Team1Members->where('role',4) as $member)
                                    <li class="list-group-item bg-white d-flex justify-content-between">
                                        <span>[{{$match->Team1->abbreviation}}] - {{$member->User->username}}</span>
                                        <button class="btn btn-sm py-0 btn-outline-primary" disabled>Member</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <ul class="list-group bg-white">
                                @foreach ($match->Team2Members->where('role',4) as $member)
                                    <li class="list-group-item bg-white d-flex justify-content-between">
                                        <span>[{{$match->Team2->abbreviation}}] - {{$member->User->username}}</span>
                                        <button class="btn btn-sm py-0 btn-outline-primary" disabled>Member</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="h5 card-title text-dark" style="font-size:16px">Manager</h4>
                                <hr style="border:1px solid #222">
                                <span class="text-dark" style="font-size:10px">
                                    [{{$match->Team1->abbreviation}}] - {{$match->Team1Members->where('role',1)->first()->User->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="h5 card-title text-dark" style="font-size:16px">Coach</h4>
                                <hr style="border:1px solid #222">
                                <span class="text-dark" style="font-size:10px">
                                    [{{$match->Team1->abbreviation}}] - {{$match->Team1Members->where('role',2)->first()->User->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="h5 card-title text-dark" style="font-size:16px">Captain</h4>
                                <hr style="border:1px solid #222">
                                <span class="text-dark" style="font-size:10px">
                                    [{{$match->Team1->abbreviation}}] - {{$match->Team1Members->where('role',3)->first()->User->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="h5 card-title text-dark" style="font-size:16px">Manager</h4>
                                <hr style="border:1px solid #222">
                                <span class="text-dark" style="font-size:10px">
                                    [{{$match->Team2->abbreviation}}] - {{$match->Team2Members->where('role',1)->first()->User->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="h5 card-title text-dark" style="font-size:16px">Coach</h4>
                                <hr style="border:1px solid #222">
                                <span class="text-dark" style="font-size:10px">
                                    [{{$match->Team2->abbreviation}}] - {{$match->Team2Members->where('role',2)->first()->User->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="h5 card-title text-dark" style="font-size:16px">Captain</h4>
                                <hr style="border:1px solid #222">
                                <span class="text-dark" style="font-size:10px">
                                    [{{$match->Team2->abbreviation}}] - {{$match->Team2Members->where('role',3)->first()->User->name}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('style')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap");

*,
*:after,
*:before {
	box-sizing: border-box;
}

:root {
	--color-text-primary: #1c2a38;
	--color-text-secondary: #8A8F98;
	--color-text-alert: #d72641;
	--color-text-icon: #dbdade;
	--color-bg-primary: #fff;
	--color-bg-secondary: #f3f5f9;
	--color-bg-alert: #fdeaec;
	--color-theme-primary: #623ce6;
}

button,
input,
select,
textarea {
	font: inherit;
}

img {
	display: block;
}

strong {
	font-weight: 600;
}

body {
	font-family: "Inter", sans-serif;
	line-height: 1.5;
	color: var(--color-text-primary);
	background-color: var(--color-bg-secondary);
}

.match {
	background-color: var(--color-bg-primary);
	display: flex;
	flex-direction: column;
	min-width: 600px;
	border-radius: 10px;
	box-shadow: 0 0 2px 0 rgba(#303030, 0.1), 0 4px 4px 0 rgba(#303030, 0.1);
}

.match-header {
	display: flex;
	border-bottom: 1px solid #999;
	padding: 16px;
}

.match-status {
	background-color: var(--color-bg-alert);
	color: var(--color-text-alert);
	padding: 8px 12px;
	border-radius: 6px;
	font-weight: 600;
	font-size: 14px;
	display: flex;
	align-items: center;
	line-height: 1;
	margin-right: auto;
}

.match-tournament {
	display: flex;
	align-items: center;
	font-weight: 600;
	img {
		width: 20px;
		margin-right: 12px;
	}
}

.match-actions {
	display: flex;
	margin-left: auto;
}

.btn-icon {
	border: 0;
	background-color: transparent;
	color: var(--color-text-icon);
	display: flex;
	align-items: center;
	justify-content: center;
}

.match-content {
	display: flex;
	position: relative;
}

.column {
	padding: 32px;
	display: flex;
	justify-content: center;
	align-items: center;
	width: calc(100% / 3);
}

.team {
	display: flex;
	flex-direction: column;
	align-items: center;
}

.team-logo {
	width: 100px;
	height: 100px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 50%;
	background-color: var(--color-bg-primary);
	box-shadow: 0 4px 4px 0 rgba(#303030, 0.15),
		0 0 0 15px var(--color-bg-secondary);
	img {
		width: 50px;
	}
}

.team-name {
	text-align: center;
	margin-top: 24px;
	font-size: 20px;
	font-weight: 600;
}

.match-details {
	display: flex;
	flex-direction: column;
	align-items: center;
}

.match-date, .match-referee {
	font-size: 14px;
	color: var(--color-text-secondary);
	strong {
		color: var(--color-text-primary);
	}
}

.match-score {
	margin-top: 12px;
	display: flex;
	align-items: center;
}

.match-score-number {
	font-size: 48px;
	font-weight: 600;
	line-height: 1;
	&--leading {
		color: var(--color-theme-primary);
	}
}

.match-score-divider {
	font-size: 28px;
	font-weight: 700;
	line-height: 1;
	color: var(--color-text-icon);
	margin-left: 10px;
	margin-right: 10px;
}

.match-time-lapsed {
	color: #DF9443;
	font-size: 14px;
	font-weight: 600;
	margin-top: 8px;
}

.match-referee {
	margin-top: 12px;
}

.match-bet-options {
	display: flex;
	margin-top: 8px;
	padding-bottom: 12px;
}

.match-bet-option {
	margin-left: 4px;
	margin-right: 4px;
	border: 1px solid var(--color-text-icon);
	background-color: #F9f9f9;
	border-radius: 2px;
	color: var(--color-text-secondary);
	font-size: 14px;
	font-weight: 600;
	padding: 4px 8px;
}

.match-bet-place {
	position: absolute;
	bottom: -16px;
	left: 50%;
	transform: translateX(-50%);
	border: 0;
	background-color: var(--color-theme-primary);
	border-radius: 6px;
	padding: 10px 48px;
	color: rgba(#fff, 0.9);
	font-size: 14px;
	box-shadow: 0 4px 8px 0 rgba(#303030, 0.25);
}

// Codepen spesific styling - only to center the elements in the pen preview and viewport
.container {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
}
// End Codepen spesific styling

    </style>
@endsection