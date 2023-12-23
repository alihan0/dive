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
            <div class="profile-cover" style="background: url({{$tournament->cover}})"></div>
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
                @endif

                
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
                    <label for="exampleInputEmail1" class="form-label text-white">Team 1</label>
                    <select class="form-control" name="" id="">
                        <option value="0">Select Team</option>
                        @foreach ($participants as $item)
                            <option value="">[{{$item->Team->abbreviation}}] - {{$item->Team->name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="text-center">
                    <span class=" px-5 py-2 my-4 text-white">--- VS ---</span>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-white">Team 2</label>
                    <select class="form-control" name="" id="">
                        <option value="0">Select Team</option>
                        @foreach ($participants as $item)
                            <option value="">[{{$item->Team->abbreviation}}] - {{$item->Team->name}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary">Save Match</button>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('script')
    <script>

        
        var match_count = $("#match_count").val();
        let input;

        for (let i = 0; i < match_count; i++) {
            input += i
            $("#matchForm").html(input)
            
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

    </style>
@endsection