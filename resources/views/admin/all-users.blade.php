@extends('admin.master')

@section('title', 'All Users')
    
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
                            <th scope="col">Gender</th>
                            <th scope="col">Birhdate</th>
                            <th scope="col">Verifications</th>
                            <th scope="col">Status</th>
                            <th scope="col">@</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                              <tr>
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->phone ?? "-"}}
                                </td>
                                <td>
                                    {!! $user->gender == 1 ? '<span class="badge bg-success">Male</span>' : '<span class="badge bg-danger">Female</span>' !!}
                                </td>
                                <td>
                                    {{$user->birthdate}}
                                </td>
                                <td>
                                    @if ($user->email_verification == 1)
                                        <i class="fas fa-envelope"></i>
                                    @else
                                    -
                                    @endif

                                    @if ($user->discord_verification == 1)
                                        <i class="fab fa-discord"></i>
                                    @else
                                    -
                                    @endif

                                    @if ($user->gender_verification == 1)
                                        <i class="fas fa-venus"></i>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    {!! $user->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}
                                </td>
                                <td>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#edituser{{$user->id}}"><i class="fas fa-edit text-white"></i></a>
                                    <a href="javascript:;" onclick="deleteuser({{$user->id}})"><i class="fas fa-trash text-white"></i></a>
                                </td>
                              </tr>
                              <!-- Modal -->
                                <div class="modal fade" id="edituser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row mb-3">
                                                    <label for="name{{$user->id}}" class="col-sm-2 col-form-label text-white">Name</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="name{{$user->id}}" value="{{$user->name}}">
                                                    </div>
                                                  </div>
                                                <div class="row mb-3">
                                                  <label for="email{{$user->id}}" class="col-sm-2 col-form-label text-white">Email</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="email{{$user->id}}" value="{{$user->email}}">
                                                  </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="phone{{$user->id}}" class="col-sm-2 col-form-label text-white">Phone</label>
                                                    <div class="col-sm-10">
                                                      <input type="text" class="form-control" id="phone{{$user->id}}" value="{{$user->phone}}">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="gender{{$user->id}}" class="col-sm-2 col-form-label text-white">Gender</label>
                                                    <div class="col-sm-10">
                                                      <select  class="form-control" id="gender{{$user->id}}">
                                                        <option value="0" {{$user->gender == 0 ? "selected" : ""}}>Male</option>
                                                        <option value="1" {{$user->gender == 1 ? "selected" : ""}}>Female</option>
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="birthdate{{$user->id}}" class="col-sm-2 col-form-label text-white">Birthdate</label>
                                                    <div class="col-sm-10">
                                                      <input type="date" class="form-control" id="birthdate{{$user->id}}" value="{{$user->birthdate}}">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-10 offset-sm-2">
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="emailVerification{{$user->id}}" {{$user->email_verification == 1 ? "checked" : ""}}>
                                                        <label class="form-check-label" for="emailVerification{{$user->id}}">
                                                          Email Verification
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="row mb-3">
                                                    <div class="col-sm-10 offset-sm-2">
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="discordVerification{{$user->id}}" {{$user->discord_verification == 1 ? "checked" : ""}}>
                                                        <label class="form-check-label" for="discordVerification{{$user->id}}">
                                                          Discord Verification
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row mb-3">
                                                    <div class="col-sm-10 offset-sm-2">
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="genderVerification{{$user->id}}" {{$user->gender_verification == 1 ? "checked" : ""}}>
                                                        <label class="form-check-label" for="genderVerification{{$user->id}}">
                                                          Gender Verification
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editUser({{$user->id}})">Save changes</button>
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
        function editUser(id){
            var name = document.getElementById("name"+id).value;
            var email = document.getElementById("email"+id).value;
            var phone = document.getElementById("phone"+id).value;
            var gender = document.getElementById("gender"+id).value;
            var birthdate = document.getElementById("birthdate"+id).value;

            if ($("#emailVerification"+id).is(':checked')) {
                var emailVerification = 1;
            }

            if ($("#discordVerification"+id).is(':checked')) {
                var discordVerification = 1;
            }

            if ($("#genderVerification"+id).is(':checked')) {
                var genderVerification = 1;
            }
            

            axios.post('/admin/user/update', {
                id: id,
                name: name,
                email: email,
                phone: phone,
                gender: gender,
                birthdate: birthdate,
                emailVerification: emailVerification,
                discordVerification: discordVerification,
                genderVerification: genderVerification
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

        function deleteuser(id){
          axios.post('/user/account/remove', {id:id}).then((res) => {
            toastr[res.data.type](res.data.message);
            if(res.data.status){
              setInterval(() => {
                window.location.reload();
              }, 500);
            }
          });
        }
    </script>
@endsection