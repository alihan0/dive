@extends('app.master')

@section('content')
    <div class="row">
        @foreach ($tournaments as $t)
        <div class="col-4">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
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