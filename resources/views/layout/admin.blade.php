<!DOCTYPE html>
<html lang="en">

@php
  // ទិន្នន័យពី Setting (ផ្តល់ដោយ View Composer ក្នុង AppServiceProvider)
  $appSetting = $appSetting ?? null;
  $brandName  = $appSetting->shop_name ?? 'Staradmin';
  $brandLogo  = ($appSetting && $appSetting->logo)
                  ? asset('uploads/' . $appSetting->logo)
                  : asset('assets/images/logo-mini.svg');
@endphp

<head>
  <!-- Required meta tags -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ $brandName }} - Dashboard Admin</title>
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

  <style>
    /* ===== Shop Information Popup ===== */
    .shop-popup { border-radius: 18px !important; overflow: hidden; box-shadow: 0 20px 60px rgba(30, 64, 255, .25) !important; }
    .shop-popup-body { margin: 0 !important; padding: 0 !important; overflow: visible !important; }
    .shop-popup .swal2-close { color: #fff; z-index: 5; }
    .shop-popup .swal2-close:hover { color: #ffd; background: transparent; }

    .shop-card { text-align: center; }
    .shop-card-cover {
      height: 110px;
      background: linear-gradient(135deg, #1e40ff 0%, #6a5cff 60%, #9b6bff 100%);
    }
    .shop-card-avatar {
      width: 110px; height: 110px; margin: -55px auto 0;
      border-radius: 50%; border: 5px solid #fff; background: #eef1ff;
      box-shadow: 0 6px 18px rgba(0, 0, 0, .2);
      overflow: hidden; display: flex; align-items: center; justify-content: center;
    }
    .shop-card-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .shop-card-avatar span { font-size: 42px; font-weight: 700; color: #1e40ff; }

    .shop-card-name { margin: 14px 0 2px; font-size: 24px; font-weight: 700; color: #222; }
    .shop-card-sub { margin: 0 0 18px; font-size: 13px; color: #9aa0b4; letter-spacing: 1px; text-transform: uppercase; }

    .shop-card-list { padding: 0 24px 6px; text-align: left; }
    .shop-card-item {
      display: flex; align-items: center; gap: 14px;
      padding: 12px 14px; margin-bottom: 10px;
      background: #f5f7ff; border-radius: 12px;
    }
    .shop-card-icon {
      flex: 0 0 42px; height: 42px; border-radius: 12px;
      background: linear-gradient(135deg, #1e40ff, #6a5cff); color: #fff;
      display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .shop-card-text small { display: block; color: #8b92a8; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
    .shop-card-text p { margin: 0; font-size: 16px; font-weight: 600; color: #2b2f3e; word-break: break-word; }

    .shop-popup-actions { margin: 14px 0 22px !important; gap: 10px; }
    .shop-btn { border: 0; border-radius: 10px; padding: 11px 22px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all .2s; }
    .shop-btn-primary { background: linear-gradient(135deg, #1e40ff, #6a5cff); color: #fff; box-shadow: 0 6px 16px rgba(30, 64, 255, .35); }
    .shop-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 64, 255, .45); }
    .shop-btn-light { background: #eceef6; color: #555b73; }
    .shop-btn-light:hover { background: #dfe2ef; }
  </style>
</head>


<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        {{-- ចុចលើ Logo/ឈ្មោះហាង => លោត popup បង្ហាញព័ត៌មានហាង --}}
        <a class="navbar-brand brand-logo d-flex align-items-center justify-content-center shop-info-btn"
           href="javascript:void(0)">
          <img src="{{ $brandLogo }}" alt="logo"
               style="width:36px;height:36px;object-fit:cover;border-radius:50%;margin-right:10px;">
          <span class="text-white font-weight-bold" style="font-size:20px;letter-spacing:1px;">{{ $brandName }}</span>
        </a>
        <a class="navbar-brand brand-logo-mini shop-info-btn" href="javascript:void(0)">
          <img src="{{ $brandLogo }}" alt="logo"
               style="width:32px;height:32px;object-fit:cover;border-radius:50%;">
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block">
            Help : {{ $appSetting->tel ?? '+088 999 911' }}
          </li>
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
          </li>
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
            {{-- Form តែមួយគត់ សម្រាប់ Sign Out (ប្រើ id="logout-form" ទាំង sidebar និង header) --}}
            <form id="logout-form" action="{{ route('process_logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('offer.list') }}">
              <i class="menu-icon typcn typcn-shopping-bag"></i>
              <span class="menu-title">Offers</span>
            </a>
          </li>

          <li class="nav-item nav-category">Online</li>
          <li class="nav-item">
            <a class="nav-link" href="/web">
              <i class="menu-icon typcn typcn-document-text"></i>
              <span class="menu-title">Online Order</span>
            </a>
          </li>
          <li class="nav-item nav-category">Operations</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('purchase.index') }}">
              <i class="menu-icon bi bi-cart-check"></i>
              <span class="menu-title">Purchases</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('inventory.index') }}">
              <i class="menu-icon bi bi-box-seam"></i>
              <span class="menu-title">Inventory / Stock</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('expense_income.index') }}">
              <i class="menu-icon bi bi-cash-stack"></i>
              <span class="menu-title">Expense / Income</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('delivery.index') }}">
              <i class="menu-icon bi bi-truck"></i>
              <span class="menu-title">Delivery</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('reviews.index') }}">
              <i class="menu-icon bi bi-star"></i>
              <span class="menu-title">Reviews</span>
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
                    <li><a href="{{ route('setting.list') }}">Settings</a></li>
                    <li>
                      <a class="nav-link" href="#"
                        onclick="event.preventDefault(); if(confirm('Do you want to logout?')) { document.getElementById('logout-form').submit(); }">
                        Sign Out <i class="dropdown-item-icon ti-power-off"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          @yield('content')

        </div><!-- /.content-wrapper -->
      </div><!-- /.main-panel -->
    </div><!-- /.page-body-wrapper -->
  </div><!-- /.container-scroller -->

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

  @yield('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function confirmDelete(url, name) {
      Swal.fire({
          title: 'Are you sure?',
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Auto-show session toasts
      const toastElements = document.querySelectorAll('.js-auto-toast');

      toastElements.forEach(function (toastEl) {
        const toast = new bootstrap.Toast(toastEl, {
          autohide: true,
          delay: 5000 // 5 seconds
        });
        toast.show();
      });
    });
  </script>

  {{-- ===== Popup ព័ត៌មានហាង (Shop Name, Logo, Address, Tel) ===== --}}
  @if($appSetting)
  <template id="shopInfoTemplate">
    <div class="shop-card">
      <div class="shop-card-cover"></div>

      <div class="shop-card-avatar">
        @if($appSetting->logo)
          <img src="{{ asset('uploads/' . $appSetting->logo) }}" alt="logo">
        @else
          <span>{{ mb_strtoupper(mb_substr($appSetting->shop_name, 0, 1)) }}</span>
        @endif
      </div>

      <h3 class="shop-card-name">{{ $appSetting->shop_name }}</h3>
      <p class="shop-card-sub">Shop Information</p>

      <div class="shop-card-list">
        <div class="shop-card-item">
          <div class="shop-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div class="shop-card-text">
            <small>Address</small>
            <p>{{ $appSetting->address ?: '-' }}</p>
          </div>
        </div>

        <div class="shop-card-item">
          <div class="shop-card-icon"><i class="bi bi-telephone-fill"></i></div>
          <div class="shop-card-text">
            <small>Tel</small>
            <p>{{ $appSetting->tel ?: '-' }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  @endif

  <script>
    document.querySelectorAll('.shop-info-btn').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();

        const tpl = document.getElementById('shopInfoTemplate');

        // បើមិនទាន់មាន Setting សោះ => ទៅទំព័រ Settings ដើម្បីបន្ថែម
        if (!tpl) {
          window.location.href = "{{ route('setting.list') }}";
          return;
        }

        Swal.fire({
          html: tpl.innerHTML,
          padding: 0,
          width: 420,
          showCloseButton: true,
          showCancelButton: true,
          confirmButtonText: '<i class="bi bi-gear-fill"></i>&nbsp; Go to Settings',
          cancelButtonText: 'Close',
          buttonsStyling: false,
          customClass: {
            popup: 'shop-popup',
            htmlContainer: 'shop-popup-body',
            actions: 'shop-popup-actions',
            confirmButton: 'shop-btn shop-btn-primary',
            cancelButton: 'shop-btn shop-btn-light'
          }
        }).then(function (result) {
          if (result.isConfirmed) {
            window.location.href = "{{ route('setting.list') }}";
          }
        });
      });
    });
  </script>
</body>

</html>