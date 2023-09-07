@if(Session::has('success'))

<script>
  var message = "{{ Session::get('success') }}"

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 8000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: "success",
    title: "" + message + "",
  })
</script>
@endif


@if(Session::has('error'))

<script>
  var message = "{{ Session::get('error') }}"

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 8000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: "error",
    title: "" + message + "",
  })
</script>
@endif


@if(Session::has('warning'))
<script>
  var message = "{{ Session::get('warning') }}"

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 8000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: "warning",
    title: "" + message + "",
  })
</script>
@endif


@if (session('status'))
<script>
  var message = "{{ session('status') }}"

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 8000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: "success",
    title: "" + message + "",
  })
</script>
@endif


@if (session('resent'))
<script>
  var message = " {{ __('A fresh verification link has been sent to your email address.') }}"
  Swal.fire(
    "Mailbox",
    "" + message + "",
  )
</script>
@endif


@if (session('success_purchase'))
<script>
   var message = "{{ session('success_purchase') }}"
  Swal.fire({
    title: 'You Purchase Medicine!',
    icon: 'success',
    html: "" + message + "",
    showCloseButton: false,
    showCancelButton: false,
    focusConfirm: false,
    confirmButtonText: '<span class="iconify fs-20" data-icon="healthicons:medicines-outline"></span>&nbsp;Okay',
    // confirmButtonAriaLabel: 'Okay',
    // cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
    // cancelButtonAriaLabel: 'Thumbs down'
  })
</script>
@endif


@if (session('success_procedure'))
<script>
   var message = "{{ session('success_procedure') }}"
  Swal.fire({
    title: 'Request Submitted!',
    icon: 'success',
    html: "" + message + "",
    showCloseButton: false,
    showCancelButton: false,
    focusConfirm: false,
    confirmButtonText: '<span class="iconify fs-20" data-icon="healthicons:medicines-outline"></span>&nbsp;Okay',
    // confirmButtonAriaLabel: 'Okay',
    // cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
    // cancelButtonAriaLabel: 'Thumbs down'
  })
</script>
@endif

@if (session('error-printing'))
<script>
   var message = "{{ session('error-printing') }}"
  Swal.fire({
    title: 'Malasakit Form not yet Printed!',
    icon: 'warning',
    html: "" + message + "",
    showCloseButton: false,
    showCancelButton: false,
    focusConfirm: false,
    confirmButtonText: 'Okay',
    // confirmButtonAriaLabel: 'Okay',
    // cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
    // cancelButtonAriaLabel: 'Thumbs down'
  })
</script>
@endif


@if (session('item_exists'))
<script>
   var message = "{{ session('item_exists') }}"
  Swal.fire({
    title: 'Item Exists',
    icon: 'success',
    html: "" + message + "",
    showCloseButton: false,
    showCancelButton: false,
    focusConfirm: true,
    confirmButtonText: 'Okay',
    // confirmButtonAriaLabel: 'Okay',
    // cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
    // cancelButtonAriaLabel: 'Thumbs down'
  })
</script>
@endif



@if(Session::has('gen_no'))
<script>
  Swal.fire({
    width: 500,
    padding: '1em',
    html: `
  <center>
  <h4 class="lead">Patient Identification Card Generated</h4><br>
  <h3><b>{{ Session::get('gen_no') }}</b></h3><br><br>

  <a href="{{ route('print_identification_card',[ Session::get('lastgen') ]  ) }}" class="btn btn-primary">Print Hospital No.</a>
  </center>
  `,
    showConfirmButton: false,
  })
</script>
@endif


@if(Session::has('ticket'))
<script>
  Swal.fire({
    width: 500,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowOutsideClick: false,
    allowEnterKey: false,
    padding: '1em',
    html: `
  <center>
  <h3 class="lead">Patient Ticket Number</h3><br>
  <h5><b>{{ Session::get('ticket') }}</b></h5>
  <br>
  <a href="{{ route('print_patient_malasakit',[ Session::get('ticket'), Session::get('patient_id') ]  ) }}" class="btn btn-primary">Print Malasakit Form</a>
  </center>
  `,
    showCancelButton: false,
    showConfirmButton: false,
  })
</script>
@endif


@if(Session::has('error-logout'))
    <script>
        Swal.fire({
            title: "Need to Re-login", 
            text: "{{ Session::get('error-logout') }}",
            icon: "warning",
            confirmButtonText: "OK",
            onOpen: function() {
                var modalss = document.getElementsByClassName("swal-modal")[0];
                modalss.style.backgroundColor = "rgba(0, 0, 0, 0)";
            }
        });
    </script>
@endif

 <!-- MODAL MESSAGE -->
@if($errors->has('qty') || $errors->has('mid'))
<script>
  $(document).ready(function() {
    $('#buymed').modal('show');
  });

</script>
@endif

@if($errors->has('doctor_request') || $errors->has('department_id'))
<script>
  $(document).ready(function() {
    $('#doctor_request').modal('show');
  });
</script>
@endif

@if($errors->has('firstname') || $errors->has('lastname') || $errors->has('birthday')  || $errors->has('age') || $errors->has('gender') || $errors->has('address'))
<script>
  $(document).ready(function() {
    $('#addpatient').modal('show');
  });
</script>
@endif

@if($errors->has('department') || $errors->has('description'))
<script>
  $(document).ready(function() {
    $('#addDept').modal('show');
  });
</script>
@endif

@if($errors->has('name') 
              || $errors->has('category')
              || $errors->has('brand_number')
              || $errors->has('expired_date')
              || $errors->has('registration_number')
              || $errors->has('company')
              || $errors->has('purchase_price')
              || $errors->has('sale_price')
              || $errors->has('quantity')
              )
<script>
  $(document).ready(function() {
    $('#addmed').modal('show');
  });
</script>
@endif


@if($errors->has('category_name'))
<script>
  $(document).ready(function() {
    $('#addmedcategory,#addlabcategory').modal('show');
  });
</script>
@endif


