@extends('app.master')

@section('content')
    <div class="row">
        @foreach ($tournaments as $t)
        <div class="col-4">
            <div class="card shadow-sm">
              
                <img src="{{$t->cover}}" height="225" alt="" >
                <div class="alert alert-{{$t->status_info['color']}}" role="alert" style="background-size:cover;position:absolute;top:0;right:0;margin:10px;padding:4px;">
                  {{$t->status_info['title']}}
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$t->title}}</h4>
                  <p class="card-text">{{$t->description}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="/app/tournament/detail/{{ $t->id }}" class="btn btn-sm btn-outline-secondary">View</a>
                      
                    </div>
                    <small class="text-body-secondary">Start: <b>{{\Carbon\Carbon::parse($t->start_date)->format('d/m/Y')}}</b></small>
                    <small class="text-body-secondary">Max: <b>{{$t->max_participants}}</b></small>
                    <small class="text-body-secondary">Type: <b>{{$t->type_info['title']}}</b></small>
                  </div>
                </div>
              </div>
              
        </div>
        @endforeach
    </div>
@endsection