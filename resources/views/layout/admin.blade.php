<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/ionicons/dist/css/ionicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/shared/style.css') }}">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
  <!-- End Layout styles -->
  {{-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> --}}
</head>


<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /> </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +088 999 911</li>
          <li class="nav-item dropdown language-dropdown">
            <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#"
              data-toggle="dropdown" aria-expanded="false">
              <div class="d-inline-flex mr-0 mr-md-3">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-us"></i>
                </div>
              </div>
              <span class="profile-text font-weight-medium d-none d-md-block">English</span>
            </a>
            <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
              <a class="dropdown-item">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-us"></i>
                </div>English
              </a>
              <a class="dropdown-item">
                <div class="flag-icon-holder">
                  <i class="flag-icon flag-icon-fr"></i>
                </div>Khmer
              </a>
            </div>
          </li>
        </ul>
        
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
              aria-labelledby="messageDropdown">
              <a class="dropdown-item py-3">
                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{ asset('assets/images/faces/face10.jpg') }}" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{ asset('assets/images/faces/face12.jpg') }}" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" class="img-sm profile-pic">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-email-outline"></i>
              <span class="count bg-success">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
              aria-labelledby="notificationDropdown">
              <a class="dropdown-item py-3 border-bottom">
                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-alert m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                  <p class="font-weight-light small-text mb-0"> Just now </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-settings m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                  <p class="font-weight-light small-text mb-0"> Private message </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-airballoon m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                  <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/user.jpg') }}" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="{{ asset('assets/images/faces/user.jpg') }}" alt="Profile image">
                <div class="">@if(auth()->check())
                  <p class=" mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                  <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
                  @else
                  <p class=" profile-name mb-1 mt-3 font-weight-semibold text-uppercase">Guest</p>
                  @endif
                </div>
              </div>
              
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/user.jpg') }}" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">@if(auth()->check())
                <p class=" profile-name mb-1 mt-3 font-weight-semibold text-uppercase">{{ auth()->user()->name }}</p>
                @else
                <p class=" profile-name mb-1 mt-3 font-weight-semibold text-uppercase">Guest</p>
                @endif
                <p class="designation">Admin</p>
              </div>
            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item">
            <a class="nav-link" href="/admin">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('auth.list') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.list') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Costumers</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier.list') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Suppliers</span>
            </a>
             <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Products</span>
            </a>
            </li>

             <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Categories</span>
            </a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.olders') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Orders</span>
            </a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.older_items') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Order Items</span>
            </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"
                onclick="event.preventDefault(); if(confirm('Do you want to logout?')) { document.getElementById('logout-form').submit(); }">
                Sign Out <i class="dropdown-item-icon ti-power-off"></i>
              </a>
              <form  action="{{ route('process_logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>


          </li>
          <li class="nav-item nav-category">Online</li>
          <li class="nav-item">
            <a class="nav-link" href="/web">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Online Order</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Page Title Header Starts-->
          <div class="row page-title-header">
            <div class="col-12">
              <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
                <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                  
                  <ul class="quick-links ml-auto">
                    <li><a href="#">Settings</a></li>
                    <li >
                      <a class="nav-link" href="#"
                        onclick="event.preventDefault(); if(confirm('Do you want to logout?')) { document.getElementById('logout-form').submit(); }">
                        Sign Out <i class="dropdown-item-icon ti-power-off"></i>
                      </a>
                      <form id="logout-form" action="{{ route('process_logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
        @yield('content')
 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
  </script>
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>

  <script src="{{ asset('assets/js/shared/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/shared/misc.js') }}"></script>

  <script src="{{ asset('assets/js/demo_1/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/shared/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="https://jsdelivr.net"></script>
  
 
  @yield('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script>
    function confirmDelete(url, name) {
      Swal.fire({
          title: 'Are you sure?',
          // FIXED: Enclosed the HTML snippet inside string backticks
          html: `<span style="color:red;">Do you want to delete <strong>${name}</strong>?</span>`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',   
          cancelButtonColor: '#3085d6', 
          confirmButtonText: 'Yes!',
          cancelButtonText: 'Cancel'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = url;
          }
      });
  }
  </script>
  {{-- <script src="https://jsdelivr.net"></script>
  <script>
    const ctx = document.getElementById('peakSalesChart').getContext('2d');
      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['7 AM', '9 AM', '11 AM', '1 PM', '3 PM', '5 PM'],
              datasets: [{
                  label: 'Orders Processed',
                  data: [42, 85, 38, 54, 73, 29],
                  backgroundColor: '#6f4e37', // Coffee Brown
                  borderRadius: 6
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: { legend: { display: false } }
          }
      });
  </script> --}}

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Find all session toasts on the page
    const toastElements = document.querySelectorAll('.js-auto-toast');
    
    toastElements.forEach(function (toastEl) {
    // Initialize Bootstrap toast with a 0.5s auto-hide delay
    const toast = new bootstrap.Toast(toastEl, {
    autohide: true,
    delay: 5000 // 500 milliseconds = 0.5 seconds
    });
    
    // Show the toast
    toast.show();
    });
    });
  </script>
</body>

</html>