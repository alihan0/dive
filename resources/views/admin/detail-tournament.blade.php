@extends('admin.master')

@section('title', ' Tournament Details')
    
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom align-items-center self-center d-flex justify-content-between">
                    <h4 class="card-title ">Tournaments Details</h4>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="/admin/tournament/active" class="btn btn-outline-danger">Active</a>
                        <a href="/admin/tournament/pending" class="btn btn-outline-danger">Pending</a>
                        <a href="/admin/tournament/all" class="btn btn-outline-danger active">All</a>
                        <a href="/admin/tournament/new" class="btn btn-outline-danger">New</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <div class="row">
        <div class="col-xl-12">
            <div class="profile-cover" style="background: url({{$tournament->cover}})">
                @if ($tournament->status == 3)
                <div class="winner"><i class="fas fa-trophy fa-lg"></i> [{{$tournament->Winner->abbreviation}}] - {{$tournament->Winner->name}}</div>
                @endif
            </div>
            
            <div class="profile-header">
                
                

                <div class="profile-name">
                    <h3>{{$tournament->title}}</h3>
                </div>
                <div class="profile-header-menu">
                    <ul class="list-unstyled">
                        <li><a href="javascript:;" class="active">Max Participant: <b>{{$tournament->max_participants}}</b></a></li>
                        <li><a href="javascript:;" class="active">Current Participant: <b>{{$participants->count()}}</b> </a></li>
                        <li><a href="javascript:;" class="active">Status: {{$tournament->status_info['title']}}</a></li>
                        <li><a href="javascript:;" class="active">Current Round: <b>{{$tournament->current_round}}</b></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Detail</h5>
              <p>{{$tournament->description}}</p>
              
          </div>
      </div>

      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tournament Dates</h5>
            <ul class="list-unstyled profile-about-list">
                <li>Start: <span class="fw-bold"> {{$tournament->start_at}}</span></li>
                <li>End: <span class="fw-bold"> {{$tournament->end_at}}</span></li>
            </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
            <div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">
                @if ($tournament->is_published == 0)
                    <button type="button" class="btn btn-outline-primary" onclick="setPublish({{$tournament->id}}, 1)">Publish</button>
                @else
                    <button type="button" class="btn btn-outline-primary" onclick="setPublish({{$tournament->id}}, 0)">unPublish</button>
                @endif

                @if ($tournament->status == 1)
                    <button type="button" class="btn btn-outline-primary" onclick="setStatus({{$tournament->id}} , 2)">Set Active</button>
                @else
                    <button type="button" class="btn btn-outline-primary" onclick="setStatus({{$tournament->id}} , 1)">Set Pending</button>
                @endif



                <button type="button" class="btn btn-outline-primary" onclick="remove({{$tournament->id}})">Delete</button>
              </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
            <div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">
            
                @if ($tournament->status == 2)
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#setMatch">Set Match</button>

                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#nextRound">Next Round</button>
                    
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#completeGame">Complete Game</button>
                @endif

                
              </div>
        </div>
      </div>
      </div>
      <div class="col-md-12 col-lg-9">
        <div class="card card-bg mb-4">
          <div class="card-body">
              <div class="post">
                  <div class="post-header">
                      
                      <div class="post-info">
                          <span class="post-author">Participants</span><br>
                      </div>
                      
                  </div>
                  <div class="post-body">
                      
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Team</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Member</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $p)
                                <tr>
                                    <td>
                                        {{$p->id}}
                                    </td>
                                    <td>
                                        [{{$p->Team->abbreviation}}] - {{$p->Team->name}}
                                    </td>
                                    <td>
                                        {{$p->Team->ownerUser->name}}
                                    </td>
                                    <td>
                                        {{$p->Team->members->count()}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                  </div>
                  
                  
              </div>
          </div>
      </div>

      <div class="card card-bg">
        <div class="card-body">
            <div class="post">
                <div class="post-header">
                    
                    <div class="post-info">
                        <span class="post-author">Matches</span><br>
                    </div>
                    
                </div>
                <div class="post-body">
                    
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Round</th>
                          <th scope="col">Team 1</th>
                          <th scope="col">Team 2</th>
                          <th scope="col">Winner</th>
                          <th scope="col">Status</th>
                          <th scope="col">#</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($matches as $m)
                              <tr class="round-{{$m->round}}">
                                  <td>
                                      {{$m->id}}
                                  </td>
                                  <td>
                                    {{$m->round}}
                                  </td>
                                  <td class="@if($m->status == 2) @if($m->winner == 1) text-success @else text-danger @endif @endif">
                                   [{{$m->Team1->abbreviation}}] - {{$m->Team1->name}}
                                  </td>
                                  <td class="@if($m->status == 2) @if($m->winner == 2) text-success @else text-danger @endif @endif">
                                    [{{$m->Team2->abbreviation}}] - {{$m->Team2->name}}
                                  </td>
                                  
                                  <td>
                                    <span class="btn btn-outline-{{ $m->winner_info['color'] }}">{{ $m->winner_info['title'] }}</span>
                                </td>
                                  <td>
                                    <span class="btn btn-outline-{{ $m->status_info['color'] }}">{{ $m->status_info['title'] }}</span>
                                </td>
                                  <td>
                                    <a href="javscript:;" data-bs-toggle="modal" data-bs-target="#setMatchTime{{$m->id}}"><i class="fas fa-clock text-white fa-sm"></i></a>
                                    <a href="javscript:;" data-bs-toggle="modal" data-bs-target="#setWinner{{$m->id}}"><i class="fas fa-trophy text-white fa-sm"></i></a>
                                    <a href="javscript:;" onclick="removeMatch({{$m->id}})" data-bs-toggle="tooltip" title="Remove Match"><i class="fas fa-trash text-white fa-sm"></i></a>
                                  </td>
                              </tr>
                              <tr class="round-{{$m->round}}">
                                <td colspan="4" class="text-center">
                                    <i class="fas fa-calendar me-2"></i> {{$m->Time->match_time ?? "?"}}
                                </td>
                                <td colspan="5" class="text-end">
                                    <a href="javascript:;" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#UserResultModal{{$m->id}}">Results</a>
                                </td>
                              </tr>

                              <div class="modal fade" tabindex="-1" id="UserResultModal{{$m->id}}">
                                <div class="modal-dialog ">
                                  <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-white">
                                        @if ($m->id == 1)
                                        <span class="custom-number">
                                            <span class="num">1</span>
                                            <sup>ST</sup>
                                          </span>
                                        @elseif($m->id == 2)
                                        <span class="custom-number">
                                            <span class="num">2</span>
                                            <sup>ND</sup>
                                          </span>
                                          @elseif ($m->id == 3)
                                          <span class="custom-number">
                                              <span class="num">3</span>
                                              <sup>RD</sup>
                                        </span>
                                        @else
                                        <span class="custom-number">
                                            <span class="num">{{$m->id}}</span>
                                            <sup>TH</sup>
                                          </span>
                                        @endif
                                        Match User Results
                                      </h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                          @foreach ($m->UserResults as $item)
                                          <div class="mb-3">
                                            <label for="team2" class="form-label text-white">{{$item->team == 1 ? 'Team 1' : 'Team 2'}}'s Winner</label>
                                            <input type="text" disabled class="form-control mb-2" value="Team {{$item->result}}">
                                            <img src="{{$item->image}}" class="img-thumbnail border-dark" alt="">
                                          </div>
                                          <hr>
                                          @endforeach
                                        </div>
                                  </div>
                                </div>
                              </div>

                              <div class="modal fade" tabindex="-1" id="setMatchTime{{$m->id}}">
                                <div class="modal-dialog ">
                                  <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-white">
                                        @if ($m->id == 1)
                                        <span class="custom-number">
                                            <span class="num">1</span>
                                            <sup>ST</sup>
                                          </span>
                                        @elseif($m->id == 2)
                                        <span class="custom-number">
                                            <span class="num">2</span>
                                            <sup>ND</sup>
                                          </span>
                                          @elseif ($m->id == 3)
                                          <span class="custom-number">
                                              <span class="num">3</span>
                                              <sup>RD</sup>
                                        </span>
                                        @else
                                        <span class="custom-number">
                                            <span class="num">{{$m->id}}</span>
                                            <sup>TH</sup>
                                          </span>
                                        @endif
                                        Match
                                      </h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="team1" class="form-label text-white">Team 1</label>
                                            <input type="text" disabled class="form-control" value="{{$m->Team1->abbreviation}} - {{$m->Team1->name}}">
                                          </div>
                                          <div class="text-center">
                                            <span class=" px-5 py-2 my-4 text-white">--- VS ---</span>
                                          </div>
                                          <div class="mb-3">
                                            <label for="team2" class="form-label text-white">Team 2</label>
                                            <input type="text" disabled class="form-control" value="{{$m->Team2->abbreviation}} - {{$m->Team2->name}}">
                                          </div>
                                    </div>

                                    <div class="modal-body">
                                        
                                        
                                          
                                          <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="team1" class="form-label text-white">Match Date</label>
                                                    <input type="date" class="form-control" id="date{{$m->id}}">
                                                  </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="team1" class="form-label text-white">Match Time</label>
                                                    <input type="time" class="form-control" id="time{{$m->id}}">
                                                  </div>
                                            </div>
                                          </div>
                                          
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <button type="button" class="btn btn-primary" onclick="setMatchTime({{$tournament->id}}, {{$tournament->current_round}}, {{$m->id}})">Set Match Time</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="modal fade" tabindex="-1" id="setWinner{{$m->id}}">
                                <div class="modal-dialog ">
                                  <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-white">
                                        @if ($m->id == 1)
                                        <span class="custom-number">
                                            <span class="num">1</span>
                                            <sup>ST</sup>
                                          </span>
                                        @elseif($m->id == 2)
                                        <span class="custom-number">
                                            <span class="num">2</span>
                                            <sup>ND</sup>
                                          </span>
                                          @elseif ($m->id == 3)
                                          <span class="custom-number">
                                              <span class="num">3</span>
                                              <sup>RD</sup>
                                        </span>
                                        @else
                                        <span class="custom-number">
                                            <span class="num">{{$m->id}}</span>
                                            <sup>TH</sup>
                                          </span>
                                        @endif
                                        Match Winner is
                                      </h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="team1" class="form-label text-white">Team 1</label>
                                            <select id="winner{{$m->id}}" class="form-control">
                                                <option value="0">Choose Winner Team</option>
                                                <option value="1">[{{$m->Team1->abbreviation}}] - {{$m->Team1->name}}</option>
                                                <option value="2">[{{$m->Team2->abbreviation}}] - {{$m->Team2->name}}</option>
                                            </select>
                                          </div>
                                    </div>

                                    
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <button type="button" class="btn btn-primary" onclick="setWinner({{$m->id}})">Set Winner</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          @endforeach
                      </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
      </div>

      

      
     
      

      <div class="modal fade" tabindex="-1" id="setMatch">
        <div class="modal-dialog ">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h5 class="modal-title text-white">
                @if ($tournament->current_round == 1)
                <span class="custom-number">
                    <span class="num">1</span>
                    <sup>ST</sup>
                  </span>
                @elseif($tournament->current_round == 2)
                <span class="custom-number">
                    <span class="num">2</span>
                    <sup>ND</sup>
                  </span>
                  @elseif($tournament->current_round == 3)
                  <span class="custom-number">
                      <span class="num">3</span>
                      <sup>RD</sup>
                </span>
                @else
                <span class="custom-number">
                    <span class="num">{{$tournament->current_round}}</span>
                    <sup>TH</sup>
                  </span>
                @endif
                Round
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="team1" class="form-label text-white">Team 1</label>
                    <select class="form-control" id="team1">
                        <option value="0">Select Team</option>
                        @foreach ($participants as $item)
                            <option value="{{$item->Team->id}}">[{{$item->Team->abbreviation}}] - {{$item->Team->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="text-center">
                    <span class=" px-5 py-2 my-4 text-white">--- VS ---</span>
                  </div>
                  <div class="mb-3">
                    <label for="team2" class="form-label text-white">Team 2</label>
                    <select class="form-control" id="team2">
                        <option value="0">Select Team</option>
                        @foreach ($participants as $item)
                            <option value="{{$item->Team->id}}">[{{$item->Team->abbreviation}}] - {{$item->Team->name}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" onclick="saveMatch({{$tournament->id}}, {{$tournament->current_round}})">Save Match</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" tabindex="-1" id="nextRound">
        <div class="modal-dialog ">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h5 class="modal-title text-white">Next
                Round
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($tournament->current_round < $tournament->round)
            <div class="modal-body">
                
                    
                <h5 class="modal-title text-white mb-4">
                    Are you sure?
                </h5>

                <div class="alert alert-warning" role="alert">
                    The tournament will be advanced to the next round. This action cannot be undone. Please only perform this action if all matches have been completed.
                  </div>
                  <span class="badge bg-primary">Current Round: <b>{{$tournament->current_round}}</b></span>
                  <span class="badge bg-primary">Next Round: <b>{{$tournament->current_round + 1 < $tournament->round ? $tournament->current_round + 1 : $tournament->round}}</b></span>

                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" onclick="nextRound({{$tournament->id}})">Yes, do it</button>
            </div>
            @else
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    The last round of the tournament is being played. You can't upgrade this tournament any higher. If this round has been played, please complete the tournament.
                  </div>
            </div>
            @endif
          </div>
        </div>
      </div>

    



      <div class="modal fade" id="completeGame" aria-hidden="true" aria-labelledby="completeGame" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h5 class="modal-title text-white">Complete Game
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($tournament->current_round == $tournament->round)
            <div class="modal-body">
                
                    
                <h5 class="modal-title text-white mb-4">
                    Are you sure?
                </h5>

                <div class="alert alert-warning" role="alert">
                    Are you sure you want to complete the game? This action cannot be undone.
                  </div>
           
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#completeGameModal">Yes, do it</button>
            </div>
            @else
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    The tournament is still ongoing. Wait for the last round to complete the game...
                  </div>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="modal fade" id="completeGameModal" aria-hidden="true" aria-labelledby="completeGameModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h5 class="modal-title text-white">
                Complete Game
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="team1" class="form-label text-white">Choose Winner Team</label>
                    <select class="form-control" id="winnerTeam">
                        <option value="0">Select Team</option>
                        @foreach ($participants as $item)
                            <option value="{{$item->Team->id}}">[{{$item->Team->abbreviation}}] - {{$item->Team->name}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" onclick="completeGame({{$tournament->id}})">Save Match</button>
            </div>
          </div>
        </div>
      </div>
    
      
@endsection

@section('script')
    <script>

        function completeGame(tournament){
            axios.post('/admin/tournament/completeGame', {tournament:tournament, winner: $("#winnerTeam").val()}).then((res) => {
                toastr[res.data.type](res.data.message)
                if (res.data.status) {
                    setInterval(() => {
                        window.location.reload()
                    }, 500);
                }
            })
        }

        function nextRound(tournament){
            axios.post('/admin/tournament/nextRound', {tournament:tournament}).then((res) => {
                toastr[res.data.type](res.data.message)
                if (res.data.status) {
                    setInterval(() => {
                        window.location.reload()
                    }, 500);
                }
            })
        }

        function removeMatch(match){
            axios.post('/admin/tournament/removeMatch', {
                match:match
            }).then((res) => {
                toastr[res.data.type](res.data.message)
                if (res.data.status) {
                    setInterval(() => {
                        window.location.reload()
                    }, 500);
                }
            })
        }

        function setWinner(match){
            axios.post('/admin/tournament/setWinner', {
                match:match,
                winner: $("#winner"+match).val()
            }).then((res) => {
                toastr[res.data.type](res.data.message)
                if (res.data.status) {
                    setInterval(() => {
                        window.location.reload()
                    }, 500);
                }
            })
        }

        function setMatchTime(tournament, round, match){
            axios.post('/admin/tournament/setMatchTime', {
                tournament:tournament,
                round:round,
                match:match,
                date: $("#date"+match).val(),
                time: $("#time"+match).val()
            }).then((res) => {
                toastr[res.data.type](res.data.message)
                if (res.data.status) {
                    setInterval(() => {
                        window.location.reload()
                    }, 500);
                }
            })
        }
        
        function saveMatch(tournament, round){
            axios.post('/admin/tournament/setMatch', {
                tournament:tournament,
                round:round,
                team1: $("#team1").val(),
                team2: $("#team2").val()
            }).then((res) => {
                toastr[res.data.type](res.data.message)
                if(res.data.status){
                    setInterval(() => {
                        window.location.reload()
                    }, 500);
                }
            })
        }

        function setPublish(id,status){
            axios.post('/admin/tournament/setPublish', {id:id,status:status})
            .then((res) => {
                toastr[res.data.type](res.data.message);
                if(res.data.status){
                    setInterval(() => {
                        window.location.reload();
                    }, 500);
                }
            })
        }

        function setStatus(id,status){
            axios.post('/admin/tournament/setStatus', {id:id,status:status})
            .then((res) => {
                toastr[res.data.type](res.data.message);
                if(res.data.status){
                    setInterval(() => {
                        window.location.reload();
                    }, 500);
                }
            })
        }

        function remove(id){
            axios.post('/admin/tournament/remove', {id:id}).then((res) => {
                toastr[res.data.type](res.data.message);
                if(res.data.status){
                    setInterval(() => {
                        window.location.assign('/admin/tournament/all');
                    }, 500);
                }
            })
        }
    </script>
@endsection

@section('style')
    <style>
.custom-number{
    margin-right: 10px;
}
.custom-number .num {
    display: inline-block;
    font-size: 2rem;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline; /* Değişiklik burada */
    border-radius: 0.25rem;
}

.custom-number sup {
    display: inline-block;
    font-size: 1rem;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: top; /* Değişiklik burada */
    white-space: nowrap;
    vertical-align: text-top; /* Değişiklik burada */
    border-radius: 0.25rem;
}

.winner{
    position: absolute;
    border-top:10px solid #000;
    border-bottom:10px solid #000;
    padding: 40px 20px;
    top:0;
    margin-top:7%;
    background: rgba(00,00,00,0.5);
    width: 100%;
    text-align: center;
    color:#fff;
    font-size:33px;
    font-weight: bold;
    z-index: 9999;display: flex;
      flex-direction: row;
      justify-content: center;
}

.winner i{
    font-size:72px;
    margin-right: 20px;
}

    </style>
@endsection