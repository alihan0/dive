@extends('admin.master')

@section('title', 'Active Tournaments')
    
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom align-items-center self-center d-flex justify-content-between">
                    <h4 class="card-title ">Active Tournaments</h4>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        
                        <a href="/admin/tournament/applications" class="btn btn-outline-danger">Applications</a>
                        <a href="/admin/tournament/active" class="btn btn-outline-danger active">Active</a>
                        <a href="/admin/tournament/pending" class="btn btn-outline-danger">Pending</a>
                        <a href="/admin/tournament/all" class="btn btn-outline-danger ">All</a>
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
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Max Participant</th>
                            <th scope="col">Start/End</th>
                            <th scope="col">Status</th>
                            <th scope="col">Publish</th>
                            <th scope="col">@</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tournaments as $item)
                                <tr>
                                    <td>
                                        {{$item->id}}
                                    </td>
                                    <td>
                                        <span class="btn btn-outline-{{ $item->type_info['color'] }}">{{ $item->type_info['title'] }}</span>
                                    </td>
                                    <td>
                                        {{$item->title}}
                                    </td>
                                    <td>
                                        {{$item->description}}
                                    </td>
                                    <td>
                                        {{$item->max_participants}}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->start_at)->format('d.m.Y H:i') }} - {{ \Carbon\Carbon::parse($item->end_at)->format('d.m.Y H:i') }}
                                    </td>
                                    <td>
                                        <span class="btn btn-outline-{{ $item->status_info['color'] }}">{{ $item->status_info['title'] }}</span>
                                    </td>
                                    <td>
                                        <span class="btn btn-outline-{{ $item->publish_info['color'] }}">{{ $item->publish_info['title'] }}</span>
                                    </td>
                                    
                                    <td>
                                        <a href="/admin/tournament/detail/{{$item->id}}"><i class="fas fa-eye text-white"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection