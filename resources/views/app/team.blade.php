@extends('app.master')

@section('title', 'My Team')

    
@section('content')
    @if (!$team)
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">You Are Not a Member of a Team</h1>
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4">You are not currently a member or founder of any team. To participate in our tournaments, you must be on a team. You can create a team or join a team if you have an invitation code.</p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button type="button" class="btn btn-primary btn-lg px-4 gap-3" data-bs-toggle="modal" data-bs-target="#inviteModal">Use Invite Code</button>
            <a href="/app/team/new" class="btn btn-outline-secondary btn-lg px-4">Create a Team</a>
          </div>
        </div>
      </div>


      <!-- Modal -->
  <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Join a Team</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="inviteCode" class="form-label">Invite Code</label>
            <input type="text" class="form-control" id="inviteCode" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Please type your team invite code.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="joinTeam()">Join</button>
        </div>
      </div>
    </div>
  </div>
  
    @else
    <div class="container row">
      <div class="mx-auto col-8">
        <div class="card border">
          <div class="card-body">
            <div class="card border">
              <div class="card-body">
                <h1 class="card-title d-flex align-items-center">
                  <img src="{{$team->Team->logo ?? "/apps/images/circle-dashed.png"}}" class="me-4" alt="" width="100">
                  <span class="gap-1 fw-bold">{{$team->Team->abbreviation}} - {{$team->Team->name}}</h1></span>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title border-bottom pb-3">Team Members</h5>

                    <table class="table">
                      <thead>
                        <tr>
                          
                          <th scope="col">Name</th>
                          <th scope="col">Username</th>
                          <th scope="col">Role</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach ($team->Team->Members as $member)
                            <tr>
                              <td>
                                {{$member->User->name}}
                              </td>
                              <td>
                                {{$member->User->username}}
                              </td>
                              <td>
                                @if ($member->role == 1)
                                  <span class="badge bg-danger">Manager</span>
                                @elseif ($member->role == 2)
                                  <span class="badge bg-primary">Coach</span>
                                @elseif ($member->role == 3)
                                  <span class="badge bg-warning">Captain</span>
                                @else
                                  <span class="badge bg-success">Member</span>
                                @endif
                              </td>
                              <td>
                                @if ($member->User->id == Auth::user()->id || $member->role == 1 || $member->role == 2 || $member->role == 3)
                                    <a href="javascript:;" onclick="removeMember({{$member->User->id}},{{$member->team}})"><i class="fas fa-times text-danger"></i></a>
                                @endif
                              </td>
                            </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title border-bottom pb-3">Team Detail</h5>
                    {{$team->Team->description}}
                  </div>
                </div>
              </div>
            </div>
            <hr>
            @if ($member->role == 1 || $member->role == 2 || $member->role == 3)

            <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inviteMemberModal"><i class="fas fa-plus"></i> Invite Member</a>
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeLogoModal"><i class="fas fa-camera"></i> Change Logo</a>
            <a href="javascript:;" class="btn btn-warning text-white"><i class="fas fa-edit"></i> Edit Description</a>
            <a href="javascript:;" class="btn btn-danger text-white"><i class="fas fa-trash"></i> Leave Team</a>
            @endif
          </div>
        </div>
        
      </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="inviteMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Invite Member</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="inviteEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="inviteEmail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Please type your member e-mail address. We will send a invite code.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="sendInvite({{$team->Team->id}})">Send</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="changeLogoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Change Team Logo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="file" id="file" onchange="upload({{$team->Team->id}})">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    @endif
@endsection

@section('script')
    <script>
      window.removeMember = function(user, team) {
        alert(user + " " + team);
    };

    function upload(team) {
            var formData = new FormData();
            var fileInput = document.getElementById('file');
            formData.append('file', fileInput.files[0]);
            formData.append('team', team);

            axios.post('/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (res) {
                toastr[res.data.type](res.data.message)
                if(res.data.status){
                    window.location.reload();
                }
            });
    }

    function sendInvite(team){
        var email = document.getElementById('inviteEmail').value;
        axios.post('/app/team/invite', {
            email: email,
            team: team
        })
        .then(function (res) {
            toastr[res.data.type](res.data.message)
            if(res.data.status){
                setInterval(() => {
                  window.location.reload();
                }, 500);
            }
        });
    }
        
    function joinTeam(){
      var code = $("#inviteCode").val();

      axios.post('/app/team/join', {code:code}).then((res) => {
        toastr[res.data.type](res.data.message);
        if(res.data.status){
          setInterval(() => {
            location.assign('/app/team/');
          },500);
        }
      })
    }
    </script>
@endsection