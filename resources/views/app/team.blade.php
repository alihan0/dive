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
                            <tr {!! $member->status == 0 ? 'class="text-decoration-line-through text-muted" style="filter: grayscale(100%);"' : "" !!}>
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
                                @if (Auth::user()->Team->role == 1 || Auth::user()->Team->role == 2 || Auth::user()->Team->role == 3 || $member->user == Auth::user()->id )
                                
                                  @if($member->status == 1)
                                    <a href="javascript:;" onclick="removeMember({{$member->user}}, {{$member->team}})"><i class="fas fa-times text-danger"></i></a>
                                @endif
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
                    {!! $team->Team->description !!}
                  </div>
                </div>
              </div>
            </div>
            <hr>
            @if (Auth::user()->Team->role == 1 || Auth::user()->Team->role == 2 || Auth::user()->Team->role == 3 || $member->user == Auth::user()->id )

            <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inviteMemberModal"><i class="fas fa-plus"></i> Invite Member</a>
            <a href="javascript:;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeLogoModal"><i class="fas fa-camera"></i> Change Logo</a>
            <a href="javascript:;" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editDetailModal"><i class="fas fa-edit"></i> Edit Description</a>
            <a href="javascript:;" class="btn btn-danger text-white" onclick="leaveTeam({{$team->Team->id}})"><i class="fas fa-trash"></i> Leave Team</a>
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

   <!-- Modal -->
   <div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Team Description</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="desc" class="form-label">Description</label>
            <textarea class="form-control" id="desc"  rows="10">{{$team->Team->description}}</textarea>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="editDetail({{$team->Team->id}})">Save</button>
        </div>
      </div>
    </div>
  </div>
    @endif
@endsection

@section('script')
    <script>
      window.removeMember = function(user, team) {

        Swal.fire({
          icon: 'warning',
          title: "Are You Sure?",
          text: 'Are you sure you want to take him off the team? This action cannot be undone.',
          showCancelButton: true,
          confirmButtonText: "Yes",
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {

            axios.post('/app/team/remove', {
                user: user,
                team: team
            })
            .then(function (res) {
                toastr[res.data.type](res.data.message)
                if(res.data.status){
                  Swal.fire("Removed!", "", "success");
                    setInterval(() => {
                      window.location.reload();
                    }, 500);
                }
            });    
          }
        });
        
        
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

    function editDetail(team){
      var desc = $("#desc").val();

      axios.post('/app/team/edit', {desc:desc, team:team}).then((res) => {
        toastr[res.data.type](res.data.message);
        if(res.data.status){
          setInterval(() => {
            location.reload();
          }, 500);
        }
      })
    }

    function leaveTeam(team){
      Swal.fire({
          icon: 'warning',
          title: "Warning: You're About to Disband the Team",
          text: 'If you disband this team, all members will be automatically removed and team information will be permanently deleted. You will not be able to undo this action!',
          showCancelButton: true,
          confirmButtonText: "Yes",
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {

            axios.post('/app/team/remove', {
                user: user,
                team: team
            })
            .then(function (res) {
                toastr[res.data.type](res.data.message)
                if(res.data.status){
                  Swal.fire("Removed!", "", "success");
                    setInterval(() => {
                      window.location.reload();
                    }, 500);
                }
            });    
          }
        });
    }
    </script>
@endsection