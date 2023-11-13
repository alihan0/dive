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
            <a href="/app/team/create" class="btn btn-outline-secondary btn-lg px-4">Create a Team</a>
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
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
    @else

    @endif
@endsection