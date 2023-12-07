@extends('admin.master')

@section('title', 'New Tournament')
    

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom align-items-center self-center d-flex justify-content-between">
                <h4 class="card-title ">New Tournament</h4>
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    
                    <a href="/admin/tournament/applications" class="btn btn-outline-danger">Applications</a>
                    <a href="/admin/tournament/active" class="btn btn-outline-danger">Active</a>
                    <a href="/admin/tournament/pending" class="btn btn-outline-danger">Pending</a>
                    <a href="/admin/tournament/all" class="btn btn-outline-danger ">All</a>
                    <a href="/admin/tournament/new" class="btn btn-outline-danger active">New</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p>Tournaments you create will be created in a <code>pending</code> status. To broadcast the tournaments and collect applications, you need to publish them using the <code>publish</code> button. Tournaments you create cannot be viewed by players until they are published.</p>

                <form action="javascript:;" id="tournamentCreateForm">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Tournament Type</label>
                                        <select name="type" id="type" class="form-control mb-2">
                                            <option value="0">Choose...</option>
                                            <option value="1">Single Elemination</option>
                                            <option value="2">Double Elemination</option>
                                            <option value="3">Leauge</option>
                                        </select>
                                        <div id="typeHelp" class="form-text">Select tournament style.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Tournament Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                        <div id="titleHelp" class="form-text">Type tournament title.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Tournament Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="7"></textarea>
                                        <div id="titleHelp" class="form-text">Type tournament description.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="max_participant" class="form-label">Max Participant</label>
                                        <input type="number" class="form-control" id="max_participant" name="max_participant">
                                        <div id="max_participantHelp" class="form-text">Type max Participant number</div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="start_at_date" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="start_at_date" name="start_at_date">
                                            </div>
                                            <div class="col-6 mb-2">
                                                <label for="start_at_time" class="form-label">Start Time</label>
                                                <input type="time" class="form-control" id="start_at_time" name="start_at_time">
                                            </div>
                                            <div id="start_atHelp" class="form-text">Enter the date and time when the tournament appears to begin play.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="end_at_date" class="form-label">End Date</label>
                                                <input type="date" class="form-control" id="end_at_date" name="end_at_date">
                                            </div>
                                            <div class="col-6 mb-2">
                                                <label for="end_at_time" class="form-label">End Time</label>
                                                <input type="time" class="form-control" id="end_at_time" name="end_at_time">
                                            </div>
                                            <div id="start_atHelp" class="form-text">Enter the date and time when the tournament appears to be finished playing.</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="supervisor" class="form-label">Supervisor</label>
                                        <select name="supervisor" id="supervisor" class="form-control mb-2">
                                            <option value="0">Choose...</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <div id="typeHelp" class="form-text">Appoint a proctor for the tournament.</div>
                                    </div>
    
                                    <div class="mb-3">
                                        <button class="btn btn-primary float-end" onclick="createTournament()"><i class="fas fa-plus"></i> Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function createTournament(){
    axios.post('/admin/tournament/create', $("#tournamentCreateForm").serialize()).then((res) => {
        toastr[res.data.type](res.data.message);
        if(res.data.status){
            setInterval(() => {
                window.location.assign('/admin/tournament/detail/'+res.data.tournament_id);
            }, 500);
        }
    })
}
</script>    
@endsection