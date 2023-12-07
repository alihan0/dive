@extends('admin.master')

@section('title', 'All Tournaments')
    
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom align-items-center self-center d-flex justify-content-between">
                    <h4 class="card-title ">All Tournaments</h4>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Max Participant</th>
                            <th scope="col">Start/End</th>
                            <th scope="col">@</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection