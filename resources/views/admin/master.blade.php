
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
        <title>@yield('title') - {{$system->site_name}} ADMIN</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="/admins/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/admins/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="/admins/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
        <link href="/admins/plugins/pace/pace.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="/admins/css/main.min.css" rel="stylesheet">
        <link href="/admins/css/custom.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('style')
    </head>
    <body class="email-page page-sidebar-collapsed">
      

        <div class="page-container">
          <div class="page-sidebar">
            <a class="logo" href="/admin">G</a>
            <ul class="list-unstyled accordion-menu">
              <li>
                <a href="/admin"><i data-feather="airplay"></i></a>
                <ul class="">
                  <li class="sidebar-title text-center"><a href="/admin">Dashboard</a></li>
                </ul>
              </li>
              <li class="">
                <a href="#"><i data-feather="command"></i></a>
                <ul class="">
                    <li class="sidebar-title text-center">Tournaments</li>
                  <li><a href="/admin/tournament/active" class="active"><i class="far fa-circle"></i>Active</a></li>
                  <li><a href="/admin/tournament/all"><i class="far fa-circle"></i>All</a></li>
                  <li><a href="/admin/tournament/pending"><i class="far fa-circle"></i>Pending</a></li>
                  <li><a href="/admin/tournament/new"><i class="far fa-circle"></i>New</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i data-feather="users"></i></a>
                <ul class="">
                    <li class="sidebar-title text-center">Users</li>
                  <li><a href="/admin/user/all"><i class="far fa-circle"></i>All Users</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i data-feather="user"></i></a>
                <ul class="">
                    <li class="sidebar-title text-center">Admins</li>
                  <li><a href="/admin/account/all"><i class="far fa-circle"></i>All Admins</a></li>
                  <li><a href="/admin/account/new"><i class="far fa-circle"></i>New Admin</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i data-feather="award"></i></a>
                <ul class="">
                    <li class="sidebar-title text-center"><a href="/admin/team">Teams</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><i data-feather="calendar"></i></a>
                <ul class="">
                    <li class="sidebar-title text-center"><a href="/admin/calendar">Calendar</a></li>
                </ul>
              </li>
              <li>
                <a href="/admin/settings"><i data-feather="settings"></i></a>
                <ul class="">
                    <li class="sidebar-title text-center"><a href="/admin/settings">Settings</a></li>
                </ul>
              </li>
              
              
            </ul>
            
        </div>
          
            <div class="page-content">

              <div class="page-header">
                <nav class="navbar navbar-expand-lg d-flex justify-content-between">
                  <div class="header-title flex-fill">
                    <a href="#" id="sidebar-toggle"><i data-feather="arrow-left"></i></a>
                    <h5>@yield('title')</h5>
                  </div>
                    
                    <div class="flex-fill" id="headerNav">
                      <ul class="navbar-nav">
                        
                        
                        
                        <li class="nav-item dropdown">
                          <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-circle fa-2x"></i></a>
                          <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                            <a class="dropdown-item" href="/auth/logout"><i data-feather="log-out"></i>Logout</a>
                          </div>
                        </li>
                      </ul>
                  </div>
                </nav>
            </div>
                <div class="main-wrapper">
                  @yield('content')
                </div>
                <div class="page-footer">
                  <span class="page-footer-item page-footer-item-left">Copyright © 2024</span>
                  <span class="page-footer-item page-footer-item-right"> v1.0.0</span>
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
        @yield('script')
    </body>
</html>