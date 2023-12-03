@extends('admin.master')

@section('title', 'All Admins')
    
@section('content')
    <div class="row">
        <div class="col-12">
   
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">@</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($admins as $admin)
                              <tr>
                                <td>
                                    {{$admin->id}}
                                </td>
                                <td>
                                    {{$admin->name}}
                                </td>
                                <td>
                                    {{$admin->email}}
                                </td>
                                <td>
                                    {{$admin->phone ?? "-"}}
                                </td>
                                <td>
                                    {!! $admin->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}
                                </td>
                                <td>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editAdmin{{$admin->id}}"><i class="fas fa-edit text-white"></i></a>
                                    <a href="javascript:;" onclick="deleteAdmin({{$admin->id}})"><i class="fas fa-trash text-white"></i></a>
                                </td>
                              </tr>
                              <!-- Modal -->
                                <div class="modal fade" id="editAdmin{{$admin->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row mb-3">
                                                    <label for="name{{$admin->id}}" class="col-sm-2 col-form-label text-white">Name</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="name{{$admin->id}}" value="{{$admin->name}}">
                                                    </div>
                                                  </div>
                                                <div class="row mb-3">
                                                  <label for="email{{$admin->id}}" class="col-sm-2 col-form-label text-white">Email</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="email{{$admin->id}}" value="{{$admin->email}}">
                                                  </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="phone{{$admin->id}}" class="col-sm-2 col-form-label text-white">Phone</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="phone{{$admin->id}}" value="{{$admin->phone}}">
                                                    </div>
                                                  </div>
                                                
                                              </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editAdmin({{$admin->id}})">Save changes</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                          @endforeach
                        </tbody>
                      </table>
                </div>
          
    </div>
@endsection


@section('script')
    <script>
        function editAdmin(id){
            var name = document.getElementById("name"+id).value;
            var email = document.getElementById("email"+id).value;
            var phone = document.getElementById("phone"+id).value;

            axios.post('/admin/account/update', {
                id: id,
                name: name,
                email: email,
                phone: phone
            })
            .then(function (res) {
                toastr[res.data.type](res.data.message);
                if(res.data.status){
                    setInterval(() => {
                        window.location.reload();
                    }, 500);
                }
            })
        }
        
    </script>
@endsection