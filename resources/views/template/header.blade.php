<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <!-- plugins:css -->

  <link rel="stylesheet" href="{{ asset('template/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('template/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('template/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('template/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('template/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template/images/favicon.png')}}" />

  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">

  <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />     
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <style>
    .kbw-signature { width: 100%;height: 300px;cursor: crosshair !important;}
    #sig canvas{ width: 100% !important;height: 300px;}
</style>  



<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>



  <!-- SweetAlert2 -->
  <link href="{{ asset('template/sweetalert/sweetalert2new.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('template/sweetalert/sweetalert2.min.js') }}"></script>
  <style>
    .swal2-popup {
      font-size: 0.9rem !important;
    }

    .swal2-icon {
      margin-top: 20px;
    }

    .swal2-modal .swal2-icon,
    .swal2-modal .swal2-success-ring {
      margin-top: 7px;
      margin-bottom: 0px;
    }


    .disabled {
      cursor: not-allowed;
    }

    .dashed {
      border: 1px black dashed;
    }

    .fs-20 {
      font-size: 20px
    }

    .fs-25 {
      font-size: 25px
    }

    .fs-30 {
      font-size: 30px
    }

    .fs-35 {
      font-size: 35px
    }

    .fs-40 {
      font-size: 40px
    }

    .fs-45 {
      font-size: 45px
    }

    .fs-50 {
      font-size: 50px
    }

    .modify-input {
      border: none;
      outline: none;
      box-shadow: none;
    }

    .modify-input:focus {
      box-shadow: none;
    }

    .border-bottom {
      border-bottom: 1px solid;
    }

    .select2-container .select2-selection--single {
  height: auto;
  padding: 1px;
  box-sizing: border-box;
}
.select2-container .select2-selection__rendered {
  white-space: normal;
  word-wrap: break-word;
}


.personal-image {
  text-align: center;
}
.personal-image input[type="file"] {
  display: none;
}
.personal-figure {
  position: relative;
  width: 137px;
  height: 137px;
}
.personal-avatar {
  cursor: pointer;
  width: 137px;
  height: 137px;
  box-sizing: border-box;
  border-radius: 100%;
  border: 2px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
  transition: all ease-in-out .3s;
}


.personal-figure-user {
  position: relative;
  width: 200px;
  height: 200px;
}

.personal-avatar-user {
  cursor: pointer;
  width: 200px;
  height: 200px;
  box-sizing: border-box;
  border-radius: 100%;
  border: 2px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
  transition: all ease-in-out .3s;
}


.personal-figcaption-user {
  cursor: pointer;
  position: absolute;
  top: 0px;
  width: inherit;
  height: inherit;
  border-radius: 100%;
  opacity: 0;
  background-color: rgba(0, 0, 0, 0);
  transition: all ease-in-out .3s;
}
.personal-figcaption-user:hover {
  opacity: 1;
  background-color: rgba(0, 0, 0, .5);
}
.personal-figcaption-user > img {
  margin-top: 58.5px;
  width: 80px;
  height: 80px;
}


.personal-figure-malasakit {
  position: relative;
  width: 100px;
  height: 100px;
}

.personal-avatar-malasakit {
  cursor: pointer;
  width: 100px;
  height: 100px;
  box-sizing: border-box;
  border-radius: 100%;
  border: 2px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
  transition: all ease-in-out .3s;
}


.personal-avatar:hover {
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
}
.personal-figcaption {
  cursor: pointer;
  position: absolute;
  top: 0px;
  width: inherit;
  height: inherit;
  border-radius: 100%;
  opacity: 0;
  background-color: rgba(0, 0, 0, 0);
  transition: all ease-in-out .3s;
}
.personal-figcaption:hover {
  opacity: 1;
  background-color: rgba(0, 0, 0, .5);
}
.personal-figcaption > img {
  margin-top: 32.5px;
  width: 50px;
  height: 50px;
}


#charge-chart {
  height: auto;
  width: 100%;
}

/* .signature-pad {
  position: relative;
  width: 100%;
  border: 1px solid #ccc;
  background-color: #fff;
} */




  </style>

  <script>
    function dateTime() {
      var format = "";
      var ndate = new Date();
      var hr = ndate.getHours();
      var h = hr % 12;

      if (hr < 12) {
        greet = 'Good Morning';
        format = 'AM';
      } else if (hr >= 12 && hr <= 17) {
        greet = 'Good Afternoon';
        format = 'PM';
      } else if (hr >= 17 && hr <= 24)
        greet = 'Good Evening';

      var m = ndate.getMinutes().toString();
      var s = ndate.getSeconds().toString();

      if (h < 12) {
        h = "0" + h;
        $("h1.day-message").html(greet);
      } else if (h < 18) {
        $("h1.day-message").html(greet);
      } else {
        $("h1.day-message").html(greet);
      }

      if (s < 10) {
        s = "0" + s;
      }

      if (m < 10) {
        m = "0" + m;
      }

      $('#date_today_header').html(h + ":" + m + ":" + s + format);
    }

    setInterval(dateTime, 1000);
  </script>

</head>

<body>
  <div class="container-scroller">
@auth
@php 
$count_approve = DB::table('patients')
                    ->where('request_status', 3)
                    ->where('created_at', Carbon\Carbon::now())
                    ->count();
@endphp
@endauth
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="javascript:void(0)">
          
            
            <img src="{{ asset('logo/logo-modified.png') }}" alt="logo">
            
            <div style="white-space: pre-line;font-size:17px;">
            Ospital ng
            Parañaque
            </div>

          </a>
          <a class="navbar-brand brand-logo-mini" href="javascript:void(0)">
          <img src="{{ asset('logo/logo-modified.png') }}" alt="logo" height="200" width="100" style="margin-top:-20px;">

          <!-- <div style="white-space: pre-line;font-size:12px;">
            Ospital ng
            Parañaque
          </div> -->


          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <div class="d-flex">
              <h1 class="welcome-text day-message"></h1><b class="mt-1 fs-20">,</b>&nbsp;<h1 class="welcome-text"><span class="text-black fw-bold">{{ Auth::user()->first_name }}</span></h1>
            </div>

            <h3 class="welcome-sub-text" id="date_today_header"></h3>

          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <!-- <li class="nav-item dropdown d-none d-lg-block">
						<a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
							<a class="dropdown-item py-3">
								<p class="mb-0 font-weight-medium float-left">Select category</p>
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item preview-item">
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">Bootstrap Bundle </p>
									<p class="fw-light small-text mb-0">This is a Bundle featuring 16 unique dashboards</p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">Angular Bundle</p>
									<p class="fw-light small-text mb-0">Everything you’ll ever need for your Angular projects</p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">VUE Bundle</p>
									<p class="fw-light small-text mb-0">Bundle of 6 Premium Vue Admin Dashboard</p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">React Bundle</p>
									<p class="fw-light small-text mb-0">Bundle of 8 Premium React Admin Dashboard</p>
								</div>
							</a>
						</div>
					</li> -->
					<!-- <li class="nav-item d-none d-lg-block">
						<div id="datepicker-popup" class="input-group date  navbar-date-picker">
							<span class="input-group-addon input-group-prepend border-right">
								<span class="icon-calendar input-group-text calendar-icon"></span>
							</span>
							<input type="text" class="form-control">
						</div>
					</li> -->
					<!-- <li class="nav-item">
						<form class="search-form" action="#">
							<i class="icon-search"></i>
							<input type="search" class="form-control" placeholder="Search Here" title="Search here">
						</form>
					</li> -->
					<!-- <li class="nav-item dropdown">
						<a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
							<i class="icon-mail icon-lg"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
							<a class="dropdown-item py-3 border-bottom">
								<p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
								<span class="badge badge-pill badge-primary float-right">View all</span>
							</a>
							<a class="dropdown-item preview-item py-3">
								<div class="preview-thumbnail">
									<i class="mdi mdi-alert m-auto text-primary"></i>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
									<p class="fw-light small-text mb-0"> Just now </p>
								</div>
							</a>
							<a class="dropdown-item preview-item py-3">
								<div class="preview-thumbnail">
									<i class="mdi mdi-settings m-auto text-primary"></i>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
									<p class="fw-light small-text mb-0"> Private message </p>
								</div>
							</a>
							<a class="dropdown-item preview-item py-3">
								<div class="preview-thumbnail">
									<i class="mdi mdi-airballoon m-auto text-primary"></i>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
									<p class="fw-light small-text mb-0"> 2 days ago </p>
								</div>
							</a>
						</div>
					</li> -->
          @if(Auth::user()->type == 5)
          <li class="nav-item dropdown">
						<a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="icon-bell"></i>
              @if($count_approve > 0)
							<span class="count"></span>
              @else
              @endif
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
							<a class="dropdown-item py-3">
								<p class="mb-0 font-weight-medium float-left">You have {{ $count_approve }} approve {{ $count_approve > 0 ? 'requests' : 'request' }}</p>
								<!-- <span class="badge badge-pill badge-primary float-right">View all</span> -->
							</a>
							<!-- <div class="dropdown-divider"></div>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
								</div>
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
									<p class="fw-light small-text mb-0"> The meeting is cancelled </p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
								</div>
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
									<p class="fw-light small-text mb-0"> The meeting is cancelled </p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
								</div>
								<div class="preview-item-content flex-grow py-2">
									<p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
									<p class="fw-light small-text mb-0"> The meeting is cancelled </p>
								</div>
							</a> -->
						</div>
					</li>
          @endif


          <li class="nav-item dropdown  d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">

            @if(Auth::user()->picture != null)
              <img src="{{ asset('upload/'.Auth::user()->picture )}}" alt="avatar"  class="rounded-circle" id="avatar-image"  style="max-height:30px;max-width:30px;">
              @else
            
              <img class="rounded-circle" src="{{ asset('template/images/faces/no-profile.png') }}" alt="Profile image"  style="max-height:30px;max-width:30px;">
              
              @endif

              
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">

              @if(Auth::user()->picture != null)
              <img src="{{ asset('upload/'.Auth::user()->picture )}}" class="rounded-circle" alt="avatar" id="avatar-image"  style="max-height:50px;max-width:50px;">
              @else
              <img class="rounded-circle" src="{{ asset('template/images/faces/no-profile.png') }}"  style="max-height:70px;max-width:70px;" alt="Profile image">
              
              @endif
                <p class="mb-1 mt-3 font-weight-semibold">{{Auth::user()->first_name.' '.Auth::user()->last_name }}</p>
                <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
              @guest @else

              <a href="javascript:void(0)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#change_password">
                <span class="iconify me-2 text-primary fs-20" data-icon="icon-park:lock"></span>{{ __('Reset Password') }}</a>
              
              <a href="javascript:void(0)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#change_account">
                <span class="iconify me-2 text-primary fs-25" style="position:relative;left:-4px;" data-icon="openmoji:envelope" data-bs-toggle="modal" data-bs-target="#change_account"></span>{{ __('Update Account') }}</a>

              <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_profile">
                <span class="iconify me-2 text-primary fs-20" data-icon="icomoon-free:profile"></span>{{ __('Update Profile') }}</a>


              <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                <span class="iconify me-2 text-primary fs-20" data-icon="mdi:sign-out"></span>{{ __('Logout') }}</a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>



              @endguest


            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border me-3"></div>Light
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->