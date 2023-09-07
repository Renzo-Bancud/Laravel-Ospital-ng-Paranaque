

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- plugins:js -->
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
<script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('template/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('template/vendors/progressbar.js/progressbar.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('template/js/off-canvas.js') }}"></script>
<script src="{{ asset('template/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('template/js/template.js') }}"></script>
<script src="{{ asset('template/js/settings.js') }}"></script>
<script src="{{ asset('template/js/todolist.js') }}"></script>
<!-- endinject -->
@include('messages.alert')

<script>
  flatpickr('#bdate', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
  });

  function submitBday() {
    var Q4A = "";
    var Bdate = document.getElementById('bdate').value;
    var Bday = +new Date(Bdate);
    Q4A += ~~((Date.now() - Bday) / (31557600000));
    document.getElementById('age').value = Q4A;
  }
</script>



</body>
</html>

