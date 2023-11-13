@extends('app.master')

@section('title', 'Create Team')
    
@section('content')
    
<div class="container col-6">
    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title border-bottom pb-3">Create Team</h4>
                        <div class="mb-3">
                            <label for="team_name" class="form-label">Team Name</label>
                            <input type="email" class="form-control" id="team_name" placeholder="Enter Your Team Name">
                        </div>

                        <div class="mb-3">
                            <label for="team_abbreviation" class="form-label">Team Abbreviation</label>
                            <input type="email" class="form-control" id="team_abbreviation" placeholder="Enter Your Team Abbreviation">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Your Role</label>
                            <select id="role" class="form-control">
                                <option value="0">Choose..</option>
                                <option value="1">Manager</option>
                                <option value="2">Coach</option>
                                <option value="3">Captain</option>
                            </select>
                          </div>
                        <div class="mb-3">
                            <label for="team_description" class="form-label">Team Description</label>
                            <textarea class="form-control" id="team_description" rows="3" placeholder="Enter Your Team Description (optional)"></textarea>
                          </div>
                          
                          <button class="btn btn-primary float-end" onclick="createTeam({{Auth::user()->id}})"><i class="fas fa-save"></i> Create Team</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function createTeam(id){
            var team_name = $("#team_name").val();
            var team_abbreviation = $("#team_abbreviation").val();
            var team_description = $("#team_description").val();
            var role = $("#role").val();

            axios.post('/app/team/create', {team_name:team_name, team_description:team_description, team_abbreviation:team_abbreviation, id:id, role:role}).then((res)=>{
                toastr[res.data.type](res.data.message);
                if(res.data.status){
                    setInterval(() => {
                        location.reload();
                    }, 500)
                }
            });
        }
    </script>
@endsection