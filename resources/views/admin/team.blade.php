@extends('admin.master')

@section('title', 'All Teams')
    
@section('content')
    <div class="row">
        <div class="col-12">
   
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Abbrevation</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Owner</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($teams as $team)
                              <tr>
                                <td>
                                    {{$team->id}}
                                </td>
                                <td>
                                    <img src="{{$team->logo}}" alt="" width="50">
                                </td>
                                <td>
                                    {{$team->abbrevation}}
                                </td>
                                <td>
                                    {{$team->name}}
                                </td>
                                <td>
                                    {{$team->description}}
                                </td>
                                <td>
                                    {{$team->ownerUser->name}}
                                </td>
                                <td>
                                  <a href="/admin/team/detail/{{$team->id}}"><i class="fas fa-eye"></i></a>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
          
    </div>
@endsection