<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin</title>
  <link href="{{ asset('assets_ad/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('assets_ad/js/pace.min.js') }}"></script>
  <link href="{{ asset('assets_ad/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets_ad/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets_ad/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets_ad/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets_ad/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets_ad/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <link href="{{ asset('assets_ad/css/app-style.css') }}" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>
<style>
  * {
    font-family: 'Kantumruy Pro', sans-serif;
  }
</style>

<body class="bg-theme bg-theme1">
 
<div id="wrapper">
 
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <h5 class="logo-text">Dashtreme Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="{{ url('/admin') }}">
          <i class="zmdi zmdi-view-dashboard"></i> <span>ផ្ទាំងគ្រប់គ្រង</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-person-fill"></i> <span>អ្នកប្រើប្រាស់</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-people"></i> <span>អតិថិជន</span>
        </a>
      </li>

      <li>

        </a>
      </li>

      <li>
        <a href="">
          <i class="bi bi-bookmark-fill"></i> <span>ប្រភេទផលិតផល</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>ការបញ្ជាទិញ</span>
        </a>
      </li>

      <li>
         <a href="{{ url('/purchases') }}">
            <i class="bi bi-cart4"></i>
            <span>ការទិញផលិតផល</span>
         </a>
      </li>
      <li>
        <a href="{{ url('/stock_logs') }}">
           <i class="bi bi-box-seam-fill"></i>
           <span>Inventory (Stock)</span>
         </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-person-lines-fill"></i> <span>អ្នកផ្គត់ផ្គង់</span>
        </a>
      </li>
      
      <li>
        <a href="">
          <i class="bi bi-clipboard2-data"></i> <span>របាយការណ៍</span>
        </a>
      </li>
     <li>
      <a href="{{ url('/cash_transactions') }}">
         <i class="bi bi-cash"></i>
         <span>Expense/Income</span>
       </a>
      </li>
      <li>
        <a href="{{ url('/delivery') }}">
         <i class="bi bi-truck"></i>
           <span>Delivery</span>
        </a>
      </li>
      <li>
       <a href="{{ url('/reviews') }}">
          <i class="bi bi-bookmark-star-fill"></i>
          <span>Reviews</span>
       </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-tags-fill"></i> <span>បញ្ចុះតំលៃផលិតផល</span>
        </a>
      </li>
      <li>
        <a href="">
          <i class="bi bi-gear"></i> <span>Settings</span>
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
<div class="clearfix"></div>
  
   <div class="content-wrapper">
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-lg-12">
                @yield('content')
            </div>
        </div>

    </div>
</div>
      </div>
    </footer>
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
  </div><script src="{{ asset('assets_ad/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets_ad/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets_ad/js/bootstrap.min.js') }}"></script>
  
 <script src="{{ asset('assets_ad/plugins/simplebar/js/simplebar.js') }}"></script>
  <script src="{{ asset('assets_ad/js/sidebar-menu.js') }}"></script>
  <script src="{{ asset('assets_ad/js/jquery.loading-indicator.js') }}"></script>
  <script src="{{ asset('assets_ad/js/app-script.js') }}"></script>
  <script src="{{ asset('assets_ad/plugins/Chart.js/Chart.min.js') }}"></script>
 
  <script src="{{ asset('assets_ad/js/index.js') }}"></script>

</body>
</html>