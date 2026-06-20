<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
  <!-- loader-->
  <link href="{{ asset('assets_ad/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('assets_ad/js/pace.min.js') }}"></script>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets_ad/images/favicon.ico') }}" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="{{ asset('assets_ad/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{ asset('assets_ad/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets_ad/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('assets_ad/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('assets_ad/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('assets_ad/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('assets_ad/css/app-style.css') }}" rel="stylesheet"/>
  
</head>

<<<<<<< HEAD
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                          <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Category</span>
                            </a>
                        </li>
                    </ul>
                </nav>
=======
<body class="bg-theme bg-theme1">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="{{ asset('assets_ad/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Dashtreme Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="index.html">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Users</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Costumers</span>
        </a>
      </li>

      <li>
        <a href="">
          <i class="zmdi zmdi-invert-colors"></i> <span>Products</span>
        </a>
      </li>

      <li>
        <a href="">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Categories</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Orders</span>
        </a>
      </li>

      <li>
        <a href="">
          <i class="zmdi zmdi-grid"></i> <span>Purchases</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Inventory(Stock)</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Suppliers</span>
        </a>
      </li>
      
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Reports</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Expense/Income</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Delivery</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Reviews</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Offers</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Settings</span>
        </a>
      </li>

      <li>
        <a href="" target="_blank">
          <i class="zmdi zmdi-lock"></i> <span>Login</span>
        </a>
      </li>

       <li>
        <a href="" target="_blank">
          <i class="zmdi zmdi-account-circle"></i> <span>Register</span>
        </a>
      </li>
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
            <p class="user-subtitle">mccoy@example.com</p>
>>>>>>> 0d9732e1bb8408df3b93210011c4aebd8cd2372c
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

  <!--Start Dashboard Content-->

	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">9526 <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Orders <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">8323 <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Revenue <span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">6200 <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Visitors <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0">5630 <span class="float-right"><i class="fa fa-envira"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Messages <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
        </div>
    </div>
 </div>  
	  
	
	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
		
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
         
        </div>
      </div>
    </footer>
	<!--End footer-->
	
  <!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets_ad/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets_ad/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets_ad/js/bootstrap.min.js') }}"></script>
	
 <!-- simplebar js -->
  <script src="{{ asset('assets_ad/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('assets_ad/js/sidebar-menu.js') }}"></script>
  <!-- loader scripts -->
  <script src="{{ asset('assets_ad/js/jquery.loading-indicator.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('assets_ad/js/app-script.js') }}"></script>
  <!-- Chart js -->
  
  <script src="{{ asset('assets_ad/plugins/Chart.js/Chart.min.js') }}"></script>
 
  <!-- Index js -->
  <script src="{{ asset('assets_ad/js/index.js') }}"></script>

  
</body>
</html>
