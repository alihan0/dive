@extends('admin.master')

@section('title', 'New Admin')
    
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                
                
                <form id="adminForm" action="javascript:;">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                      </div>
                    <div class="row mb-3">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email">
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                      </div>
                    <div class="row mb-3">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-secondary" onclick="newAdmin()">Save</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function newAdmin(){
        axios.post('/admin/account/new', $("#adminForm").serialize()).then((res) => {
            toastr[res.data.type](res.data.message);
            if(res.data.status){
                setInterval(() => {
                    window.location.assign('/admin/account/all');
                }, 500);
            }
        })
    }    
</script>    
@endsection