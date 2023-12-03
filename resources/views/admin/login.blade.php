
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Neo - Responsive Admin Dashboard Template</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="/admins/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admins/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="/admins/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
        <link href="/admins/plugins/pace/pace.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />

      
        <!-- Theme Styles -->
        <link href="/admins/css/main.min.css" rel="stylesheet">
        <link href="/admins/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-4">
                    <div class="card login-box-container">
                        <div class="card-body">
                            <div class="authent-logo">
                                <a href="#"><img src="{{$system->logo_primary}}" alt="" width="250"></a>
                            </div>
                            <div class="authent-text">
                                <p>Please Sign-in to your admin account.</p>
                            </div>

                            <form action="javascript:;">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                        <label for="email">Email address</label>
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                      </div>
                                </div>
                                
                                <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs" onclick="login()">Sign In</button>
                            </div>
                              </form>
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
        <!-- Javascripts -->
        <script src="/admins/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="/admins/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="/admins/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="/admins/plugins/pace/pace.min.js"></script>
        <script src="/admins/js/main.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.1/axios.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

        <script>
            function login(){
                axios.post('/admin/login', {email:$('#email').val(), password:$('#password').val()}).then((res)=>{
                    toastr[res.data.type](res.data.message);
                    if(res.data.status){
                        setInterval(() => {
                            window.location.href = '/admin';
                        }, 500);
                    }
                })
            }
        </script>
    </body>
</html>