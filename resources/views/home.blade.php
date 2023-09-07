@guest

@else
@if(Auth::user()->type == 1) <!-- admin -->
@include('users.admin.index')

@elseif(Auth::user()->type == 2) <!-- departments -->
@include('users.doctors.index')

@elseif(Auth::user()->type == 5) <!-- accountant -->
@include('users.accountants.list') 

@else  <!-- receptionist -->
@include('users.receptionists.list')
@endif


@endguest