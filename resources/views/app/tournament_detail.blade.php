@extends('app.master')

@section('content')
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{$tournament->cover}}" alt="Admin" class="w-100" height="225">
                            <div class="mt-3">
                                <h4>{{$tournament->title}}</h4>
                                <p class="text-secondary mb-4">{{$tournament->description}}</p>
                                <button class="btn btn-primary" onclick="applyTournament({{$tournament->id}})">Apply</button>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Type</h6>
                                <span class="text-secondary">{{$tournament->type_info['title']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Max Participants</h6>
                                <span class="text-secondary">{{$tournament->max_participants}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Start at</h6>
                                <span class="text-secondary">{{$tournament->start_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">End at</h6>
                                <span class="text-secondary">{{$tournament->end_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Round</h6>
                                <span class="text-secondary">{{$tournament->round}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Status</h6>
                                <span class="text-secondary">{{$tournament->status_info['title']}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Participants</h5>
        
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Bracket</h5>
        
                                <div id="minimal" class="demo"></div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('script')
<script>

    function applyTournament(id){
        axios.post('/app/tournament/apply', {id:id}).then((res)=>{
            toastr[res.data.type](res.data.message)
            if(res.data.status){
                setInterval(() => {
                    window.location.reload();
                }, 500);
            }
        });
    }

</script>
@endsection