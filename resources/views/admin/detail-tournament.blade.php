@extends('admin.master')

@section('title', ' Tournament Details')
    
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom align-items-center self-center d-flex justify-content-between">
                    <h4 class="card-title ">Tournaments Details</h4>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        
                        <a href="/admin/tournament/applications" class="btn btn-outline-danger">Applications</a>
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
            <div class="profile-cover"></div>
            <div class="profile-header">
                
                <div class="profile-name">
                    <h3>{{$tournament->title}}</h3>
                </div>
                <div class="profile-header-menu">
                    <ul class="list-unstyled">
                        <li><a href="javascript:;" class="active">Max Participant: <b>{{$tournament->max_participants}}</b></a></li>
                        <li><a href="javascript:;" class="active">Current Participant: <b>0</b> </a></li>
                        <li><a href="javascript:;" class="active">Status: {{$tournament->status_info['title']}}</a></li>
                        <li><a href="javascript:;" class="active">Current Round: <b>1</b></a></li>
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
      </div>
      <div class="col-md-12 col-lg-9">
        <div class="card card-bg">
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
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                          </tr>
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
    </script>
@endsection