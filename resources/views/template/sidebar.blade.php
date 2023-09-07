   <!-- partial:partials/_sidebar.html -->

   <style>
     .sidebar .nav .nav-item .nav-link {
       border-radius: 0px;
     }

   
   </style>
   <nav class="sidebar sidebar-offcanvas"  id="sidebar">
     <ul class="nav">

@auth
@php 
$count_approve = DB::table('patients')
                    ->where('request_status', 3)
                    ->where('created_at', Carbon\Carbon::now())
                    ->count();

$count_complete = DB::table('patients')
                    ->where('request_status', 4)
                    ->where('created_at', Carbon\Carbon::now())
                    ->count();
@endphp
@endauth



       @if(Auth::user()->type == 1) <!-- admin -->
       <li class="nav-item">
         <a class="nav-link" href="{{ url('/home') }}">
           <span class="iconify fs-25" data-icon="mdi:monitor-dashboard"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Dashboard</span>
         </a>
       </li>


       <li class="nav-item">
         <a class="nav-link" href="{{route('departments.index')}}">
           <span class="iconify fs-30" data-icon="flat-color-icons:department"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Departments</span>
         </a>
       </li>


       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-hone" aria-expanded="false" aria-controls="ui-basic">
           <span class="iconify fs-25" data-icon="openmoji:male-doctor"></span></span>
           &nbsp;&nbsp;
           <span class="menu-title">Ospar One Staff</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-hone">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{route('doctors.index')}}">Department Staff</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('receptionists.index')}}">Malasakit Staff</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('accountants.index')}}">PPP Staff</a></li>
             <!-- <li class="nav-item"> <a class="nav-link" href="">Admin Staff</a></li> -->
           </ol>
         </div>
       </li>

       
       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-delivery" aria-expanded="false" aria-controls="ui-basic">
           <span class="iconify fs-25" data-icon="emojione:delivery-truck"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Deliveries</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-delivery">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{route('laboratory-deliveries.index')}}">Laboratory Deliveries</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('medicines.index')}}">Medicine Deliveries</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('radiology-deliveries.index')}}">Radiology Deliveries</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('dialysis-deliveries.index')}}">Hemodialysis Deliveries</a></li>
           </ol>
         </div>
       </li>


       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-ticket" aria-expanded="false" aria-controls="ui-basic">
           <!-- <span class="iconify fs-25" data-icon="emojione:delivery-truck"></span> -->
           <span class="iconify fs-25" data-icon="noto:ticket"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Charge Tickets</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-ticket">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{route('pharmacies.index')}}">Pharmacy</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('laboratories.index')}}">Laboratory</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('radiologies.index')}}">Radiology</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{route('hemodialysis.index')}}">Hemodialysis</a></li>
           </ol>
         </div>
       </li>



       
       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-inventory" aria-expanded="false" aria-controls="ui-basic">
           <span class="iconify fs-25" data-icon="fluent-emoji:card-file-box"></span></span>
           &nbsp;&nbsp;
           <span class="menu-title">Invetory</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-inventory">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{ route('pharmacy.inventory') }}">Pharmacy</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('laboratory.inventory') }}">Laboratoy</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('radiology.inventory') }}">Radiology</a></li>
             <li class="nav-item"> <a class="nav-link" href="">Hemodialysis</a></li>
           </ol>
         </div>
       </li>


       <li class="nav-item">
         <a class="nav-link" href="{{route('get-approve-patients')}}">
           <span class="iconify fs-25" data-icon="mdi:receipt-text-pending"></span>
           &nbsp;
           <span class="menu-title">Approved
           <span class="badge bg-primary" style="position:relative;top:-10px;">{{ $count_approve }}</span>
           </span>
         </a>
       </li>

       <li class="nav-item">
         <a class="nav-link" href="{{route('get-complete-patients')}}">
           <span class="iconify fs-25" data-icon="material-symbols:fact-check-outline-sharp"></span>
           &nbsp;
           <span class="menu-title">Complete
           <span class="badge bg-success" style="position:relative;top:-10px;">{{ $count_complete }}</span>
           </span>
         </a>
       </li>

       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-reports" aria-expanded="false" aria-controls="ui-basic">
           <span class="iconify fs-25" data-icon="iconoir:stats-report"></span></span>
           &nbsp;&nbsp;
           <span class="menu-title">Reports</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-reports">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{route('get-ppp-reports')}}">Daily</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('get-pppweekly-reports') }}">Weekly</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('get-pppmonthly-reports') }}">Monthly</a></li>
           </ol>
         </div>
       </li>


       <li class="nav-item">
         <a class="nav-link" href="{{route('admin.billing')}}">
         <span class="iconify fs-25" data-icon="uil:bill"></span>
           &nbsp;
           <span class="menu-title">Statement of Billing
           </span>
         </a>
       </li>


      
       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-settings" aria-expanded="false" aria-controls="ui-basic">
         <span class="iconify fs-25" data-icon="flat-color-icons:settings"></span></span>
           &nbsp;&nbsp;
           <span class="menu-title">Settings</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-settings">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{route('get-activitylogs')}}">Activity Logs</a></li>
             <li class="nav-item"> <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_password">Change Password</a></li>
             <li class="nav-item"> <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_profile">Change Profile</a></li>
             <li class="nav-item"> <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_account">Change Account</a></li>
           </ol>
         </div>
       </li>

       @endif








       @if(Auth::user()->type == 2) <!-- doctor / Departments -->

       <li class="nav-item">
         <a class="nav-link" href="{{ url('/home') }}">
           <span class="iconify fs-25" data-icon="mdi:monitor-dashboard"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Dashboard</span>
         </a>
       </li>

  
       <li class="nav-item">
         <a class="nav-link" href="{{route('get-approve_procedure')}}">
           <span class="iconify fs-25" data-icon="mdi:receipt-text-pending"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Approve Request</span>
         </a>
       </li>

       <li class="nav-item">
         <a class="nav-link" href="{{route('get-complete_procedure')}}">
           <span class="iconify fs-25" data-icon="material-symbols:fact-check-outline-sharp"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Complete Request</span>
         </a>
       </li>


       @endif



      

       @if(Auth::user()->type == 8) <!-- receptionist / malasakit-->

       <li class="nav-item">
         <a class="nav-link" href="{{ url('/home') }}">
           <span class="iconify fs-25" data-icon="mdi:monitor-dashboard"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Dashboard</span>
         </a>
       </li>

    
       <li class="nav-item">
         <a class="nav-link" href="{{route('get-approve-patients')}}">
           <span class="iconify fs-30" data-icon="mdi:receipt-text-pending"></span>
           &nbsp;
           <span class="menu-title">Approved
           <span class="badge bg-primary" style="position:relative;top:-10px;">{{ $count_approve }}</span>
           </span>
         </a>
       </li>

       <li class="nav-item">
         <a class="nav-link" href="{{route('get-complete-patients')}}">
           <span class="iconify fs-30" data-icon="material-symbols:fact-check-outline-sharp"></span>
           &nbsp;
           <span class="menu-title">Complete
           <span class="badge bg-success" style="position:relative;top:-10px;">{{ $count_complete }}</span>
           </span>
         </a>
       </li>

    
       <li class="nav-item">
         <a class="nav-link" href="{{route('get-malasakit-template')}}" data-toggle="tooltip" title="Malasakit Template Form">
           <span class="iconify fs-25" data-icon="icon-park:form-one"></span>
           &nbsp;
           <span class="menu-title">Form Template</span>
         </a>
       </li>


       
       @endif


       @if(Auth::user()->type == 5) <!-- accountant / Head Office -->

       <li class="nav-item">
         <a class="nav-link" href="{{ url('/home') }}">
           <span class="iconify fs-25" data-icon="mdi:monitor-dashboard"></span>
           &nbsp;&nbsp;
           <span class="menu-title">Dashboard</span>
         </a>
       </li>

   
       <li class="nav-item">
         <a class="nav-link" href="{{route('get-charge_ticket')}}">
           <span class="iconify fs-25" data-icon="noto:ticket"></span>
           &nbsp;
           <span class="menu-title">Charge Ticket</span>
         </a>
       </li>


  


       <li class="nav-item">
         <a class="nav-link" href="{{route('get-complete-procedure')}}">
         <span class="iconify fs-30" data-icon="icon-park:medical-files"></span>
           &nbsp;
           <span class="menu-title">Complete
           <span class="badge bg-secondary p-1" style="border-radius:3px;position:relative;top:-10px;">{{ $count_complete }}</span>
           </span>
         </a>
       </li>

       <li class="nav-item">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-reports" aria-expanded="false" aria-controls="ui-basic">
           <span class="iconify fs-25" data-icon="iconoir:stats-report"></span></span>
           &nbsp;&nbsp;
           <span class="menu-title">Reports</span>
           <!-- <i class="menu-arrow"></i> -->
         </a>
         <div class="collapse" id="ui-basic-reports">
           <ol class="nav flex-column sub-menu">
             <li class="nav-item"> <a class="nav-link" href="{{route('get-ppp-reports')}}">Daily</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('get-pppweekly-reports') }}">Weekly</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('get-pppmonthly-reports') }}">Monthly</a></li>
           </ol>
         </div>
       </li>


       @endif



     </ul>
   </nav>
   <!-- partial -->