@extends('admin.master')

@section('title', ' Team Details')
    
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom align-items-center self-center d-flex justify-content-between">
                    <h4 class="card-title ">Team Details</h4>
                    
                </div>
            </div>
        </div>
    </div>
    



    <div class="row">
        <div class="col-xl-12">
            <div class="profile-cover"></div>
            <div class="profile-header">
                <div class="profile-img">
                    <img src="{{$team->logo}}" alt="">
                </div>
                <div class="profile-name">
                    <h3> [{{$team->abbrovation}}] - {{$team->name}}</h3>
                </div>
                <div class="profile-header-menu">
                    <ul class="list-unstyled">
                        <li><a href="javascript:;" class="active">Owner: <b>{{$team->ownerUser->name}}</b></a></li>
                        <li><a href="javascript:;" class="active">Member Count: <b>{{$team->Members->count()}}</b> </a></li>
                        <li><a href="javascript:;" class="active">Status: {{$team->status == 1 ? 'Active':'Inactive'}}</a></li>
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
              <p>{{$team->description}}</p>
              
          </div>
      </div>

      <div class="card">
        <div class="card-body">
            
            <ul class="list-unstyled profile-about-list">
                <li>Created at: <span class="fw-bold">{{$team->created_at}}</span></li>
                <li>Updated at: <span class="fw-bold">{{$team->updated_at}}</span></li>
            </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
            <div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">
                

                <button type="button" class="btn btn-outline-primary" onclick="remove({{$team->id}})">Delete</button>
              </div>
        </div>
      </div>
      </div>
      <div class="col-md-12 col-lg-9">
        <div class="card card-bg">
          <div class="card-body">
              <div class="post">
                  <div class="post-header">
                      
                      <div class="post-info">
                          <span class="post-author">Members</span><br>
                      </div>
                      
                  </div>
                  <div class="post-body">
                      
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Verification</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($team->Members as $index => $member)
                                <tr>
                                    <td>
                                        {{$index + 1}}
                                    </td>
                                    <td>
                                        {{$member->User->name}}
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
                                        @if ($member->User->email_verification == 1)
                                        <i class="fas fa-envelope"></i>
                                    @else
                                    -
                                    @endif

                                    @if ($member->User->discord_verification == 1)
                                        <i class="fab fa-discord"></i>
                                    @else
                                    -
                                    @endif

                                    @if ($member->User->gender_verification == 1)
                                        <i class="fas fa-venus"></i>
                                    @else
                                    -
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                  </div>
                  
                  
              </div>
          </div>
      </div>
      </div>
      
@endsection

@section('script')
    <script>
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