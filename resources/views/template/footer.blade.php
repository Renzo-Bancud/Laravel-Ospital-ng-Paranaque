<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Change Password</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('change-account-password') }}">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Crypt::encryptString(Auth::user()->id) }}">


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-3px;">Old Password:</label>
                                <div class="col-sm-8">
                                    <input 
                                        class="form-control  @error('old_password') is-invalid @enderror" type="password"
                                        name="old_password" value="{{ old('old_password') }}" placeholder="Enter old password"
                                        required>
                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top: -3px;">New Password:</label>
                                <div class="col-sm-8">
                                    <input 
                                        class="form-control  @error('new_password') is-invalid @enderror" type="password"
                                        name="new_password" value="{{ old('new_password') }}" placeholder="Enter new password"
                                        required>
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                    



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="change_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Change Profile</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('change-account-profile') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Crypt::encryptString(Auth::user()->id) }}">


                            <div class="form-group row" style="margin-bottom:-3px;">
                           
                                            <div class="personal-image">
                                                <label class="label">
                                                    <input type="file" id="image-input" name="picture"
                                                        value="{{ old('picture') }}" accept=".png, .jpg, .jpeg"
                                                        class="@error('picture') is-invalid @enderror image-input">
                                                    <figure class="personal-figure-user">
                                                        <img src="https://imagetolink.com/ib/zZEA6whofk.png"
                                                            class="personal-avatar-user avatar-image" alt="avatar">
                                                        <figcaption class="personal-figcaption-user">
                                                            <img
                                                                src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                                        </figcaption>
                                                    </figure>
                                                </label>
                                            </div>

                                            <small class="text-muted text-center">Hover me to select image</small>
                                            @error('picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                        
                            </div>
                    



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="change_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Change Account</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('change-account-info') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ Crypt::encryptString(Auth::user()->id) }}">


                            <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Firstname:</label>
                                            <div class="col-sm-8">
                                                <input id="first_name" class="form-control  @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="Enter Firstname" required>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Lastname:</label>
                                            <div class="col-sm-8">
                                                <input id="last_name" class="form-control  @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Enter Lastname" required>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        
                                        <div class="form-group row" style="margin-bottom:-3px;">
                                            <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Email:</label>
                                            <div class="col-sm-8">
                                                <input id="email" class="form-control  @error('email') is-invalid @enderror" type="text" name="email" value="{{ Auth::user()->email }}" placeholder="Enter Email Address" required>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
 
                    



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



<!-- partial:partials/_footer.html -->
<footer class="footer  pt-3">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">OSPITAL NG PARAÑAQUE – DISTRICT
            II</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © {{ date('Y') }}. All rights
            reserved.</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->



<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
<script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }}"></script>



<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>




<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/tinymce"></script> -->

<!-- endinject -->
<!-- Plugin js for this page -->
<!-- <script src="{{ asset('template/vendors/chart.js/Chart.min.js') }}"></script> -->
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
<!-- Custom js for this page-->
<script src="{{ asset('template/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/js/dashboard.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.1.1"></script>




<!-- End custom js for this page-->
@include('messages.alert')

<script>
    function initDataTable(tableSelector) {
        var table = $(tableSelector);
        if (table.DataTable().settings().length > 0) {
            table.DataTable().destroy();
        }
        table.DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)',
                dom: 'lrtip',
            },
            responsive: true,
            "ordering": false

        });

    }

    $(document).ready(function () {
        initDataTable('#data-table-one');

        $('[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("data-bs-target") // activated tab
            if (target == "#nav-prescription") {
                initDataTable('#data-table-three');
            }
            if (target == "#nav-allotment") {
                initDataTable('#data-table-four');
            }
        });
    });


    $(document).ready(function () {

        var table_main = $('#data-table, #data-table-med, #data-table-purchase, #data-table-pending, #data-table-category').DataTable({
            responsive: true,
            "ordering": false
        });

    });


    flatpickr('#bdate', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });

    flatpickr('#bdate_patient', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });

    


    flatpickr('#date', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
    });

    flatpickr('#start_time', {
        enableTime: true,
        time_24hr: true,
        noCalendar: true,
        defaultDate: '12:00',
        dateFormat: "H:i",
    });

    $("#start_time").change(function () {
        $("#endtimeDiv").show();
        flatpickr('#end_time', {
            enableTime: true,
            time_24hr: true,
            noCalendar: true,
            minTime: moment($("#start_time").val(), 'HH:mm').add(5, 'm').format('HH:mm'),
            defaultDate: moment($("#start_time").val(), 'HH:mm').add(1, 'H').format('HH:mm'),
            dateFormat: "H:i",
        });
    });





    $("#patient").change(function () {
        if ($(this).val() != 0) {
            $('#newPatientDiv').hide();
        } else {
            $('#newPatientDiv').show();
        }
    });

    /*ajax to get doctors by department*/
    $("#department").change(function () {
        $.ajax({
            url: "{{ route('get-doctors-by-department') }}?id=" + $(this).val(),
            method: 'GET',
            success: function (data) {
                $('#doctor').html(data.html);
            }
        });
    });

    $("#status").change(function () {
        if ($("#status").val() == 'confirmed') {
            $('#priceDiv').show();
        } else {
            $('#priceDiv').hide();
        }
    });

    /*ajax to get time schedule of each doctor*/
    $("#doctor").change(function () {


        $.ajax({
            url: "{{ route('get-time-schedule-by-doctor') }}?id=" + $(this).val(),
            method: 'GET',
            success: function (data) {
                $('#dateDiv').show();
                $('#timeScheduleDiv').show();
                // display Time Schedule Week Day
                $('#timeSchedule').html(data.html);
                // return Arr of Week Day Num
                var arr = [];
                $(".tm").each(function (index, obj) {
                    if ($(this).text() == 'saturday') {
                        arr.push(6);
                    } else if ($(this).text() == 'sunday') {
                        arr.push(0);
                    } else if ($(this).text() == 'monday') {
                        arr.push(1);
                    } else if ($(this).text() == 'tuesday') {
                        arr.push(2);
                    } else if ($(this).text() == 'wednesday') {
                        arr.push(3);
                    } else if ($(this).text() == 'thursday') {
                        arr.push(4);
                    } else if ($(this).text() == 'friday') {
                        arr.push(5);
                    }
                });


                // create flat picker with specific Week Days
                flatpickr('#appointment_date', {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    enable: [function (date) {
                        // return (date === 2020-01-30);
                        if (arr.length == 1) {
                            return (date.getDay() === arr[0]);
                        } else if (arr.length == 2) {
                            return (date.getDay() === arr[0] || date.getDay() === arr[1]);
                        } else if (arr.length == 3) {
                            return (date.getDay() === arr[0] || date.getDay() === arr[1] || date.getDay() === arr[2]);
                        } else if (arr.length == 4) {
                            return (date.getDay() === arr[0] || date.getDay() === arr[1] || date.getDay() === arr[2] || date.getDay() === arr[3]);
                        } else if (arr.length == 5) {
                            return (date.getDay() === arr[0] || date.getDay() === arr[1] || date.getDay() === arr[2] || date.getDay() === arr[3] || date.getDay() === arr[4]);
                        } else if (arr.length == 6) {
                            return (date.getDay() === arr[0] || date.getDay() === arr[1] || date.getDay() === arr[2] || date.getDay() === arr[3] || date.getDay() === arr[4] || date.getDay() === arr[5]);
                        } else if (arr.length == 7) {
                            return (date.getDay() === arr[0] || date.getDay() === arr[1] || date.getDay() === arr[2] || date.getDay() === arr[3] || date.getDay() === arr[4] || date.getDay() === arr[5] || date.getDay() === arr[6]);
                        }
                    }],
                });

            }
        });
    });



    // Fill Time Slots By The Date & check appointments & check day offs
    $("#appointment_date").change(function () {
        var date = moment($(this).val());
        var dadada = $(this).val();
        var time = [];
        // check appointments already reserved
        $.ajax({
            url: "{{route('get-appointments-by-date')}}?date=" + $(this).val(),
            method: 'GET',
            success: function (data) {
                jsonar = JSON.parse(data.html);
                $.each(jsonar, function (i, value) {
                    time.push(jsonar[i].time);
                });
            }
        });

        /*ajax to get day off schedule of each doctor*/
        $.ajax({
            url: "{{ route('get-dayoff-schedule-by-doctor') }}?id=" + $("#doctor").val(),
            method: 'GET',
            success: function (data) {
                check = 0;
                dayoffs = JSON.parse(data.html);

                $.each(dayoffs, function (i, value) {
                    if (dayoffs[i].date == dadada) {
                        check = 1;
                    }
                });

                if (check == 1) {
                    /*check if the Date is day off*/
                    $("#timeSlots").empty();
                    $('#timeSlotsDiv').show();
                    $("#timeSlots").append('<option>This is a Day off</option>');

                } else if (check == 0) {
                    /*ajax to Fill Time Slots By The Date if the Date not day off*/
                    $.ajax({
                        url: "{{ route('get-time-by-time-schedule') }}?week_num=" + date.day() + "&doctor_id=" + $('#doctor').val(),
                        method: 'GET',
                        success: function (data) {
                            res = JSON.parse(data.html);
                            $("#timeSlots").empty();
                            $('#timeSlotsDiv').show();
                            $.each(res, function (i, value) {
                                start = moment(res[i].start_time, 'HH:mm').format('HH:mm');
                                end = moment(res[i].end_time, 'HH:mm').format('HH:mm');
                                while (start <= moment(end, 'HH:mm').subtract(res[i].duration, 'm').format('HH:mm')) {
                                    for (j = 0; j < time.length; j++) {
                                        if (moment(start, 'HH:mm').isSame(moment(time[j], 'HH:mm'))) {
                                            start = moment(start, 'HH:mm').add(res[i].duration, 'm').format('HH:mm');
                                            j = 0;
                                        }
                                    }
                                    $("#timeSlots").append('<option value=' + moment(start, 'HH:mm').format('HH:mm') + '>' + moment(start, 'HH:mm').format('HH:mm') + '</option>');
                                    start = moment(start, 'HH:mm').add(res[i].duration, 'm').format('HH:mm');
                                }
                            });
                        }
                    });
                }
            }
        });





        // create flat picker with specific Week Days
        $(".lap_date").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        flatpickr('.timepicker', {
            enableTime: true,
            time_24hr: true,
            noCalendar: true,
            dateFormat: "H:i",
        });


    });


    flatpickr('#expire_date', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
    });



    // tinymce.init({
    //   selector: '#report', // change this to your textarea element
    //   plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    //   toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    // });



    $('.timepicker').flatpickr({
        minuteStep: 15,
        format: 'H:i',
        showSeconds: false,
        showMeridian: false,
        snapToStep: true,
    });

    flatpickr('.datepicker', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        minDate: "today",
        defaultDate: "today",
    });




    function PrintElem(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }



    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;

        for (var i = 0; i < colCount; i++) {
            var newRow = row.insertCell(i);

            newRow.innerHTML = table.rows[0].cells[i].innerHTML;
            newRow.childNodes[0].value = "";
        }
    }

    function addRowtwo(tableIDs) {
        var table_addtwo = document.getElementById(tableIDs);
        var rowCount_addtwo = table_addtwo.rows.length;
        var row_addtwo = table_addtwo.insertRow(rowCount_addtwo);
        var colCount_addtwo = table_addtwo.rows[0].cells.length;

        for (var is = 0; is < colCount_addtwo; is++) {
            var newRow_addtwo = row_addtwo.insertCell(is);

            newRow_addtwo.innerHTML = table_addtwo.rows[0].cells[is].innerHTML;
            newRow_addtwo.childNodes[0].value = "";
        }
    }

    function deleteRow(row) {
        var table = document.getElementById("data");
        var rowCount = table.rows.length;
        if (rowCount > 1) {
            var rowIndex = row.parentNode.parentNode.rowIndex;
            document.getElementById("data").deleteRow(rowIndex);
        } else {
            alert("Please specify at least one value.");
        }
    }

    function deleteRowtwo(row_two) {
        var table_two = document.getElementById("data_two");
        var rowCount_two = table_two.rows.length;
        if (rowCount_two > 1) {
            var rowIndex_two = row_two.parentNode.parentNode.rowIndex_two;
            document.getElementById("data_two").deleteRow(rowIndex_two);
        } else {
            alert("Please specify at least one value.");
        }
    }

    @if (Auth:: user() -> type == 2 && Auth:: user() -> dept_id == 3)

    function addRows() {
        var table = document.getElementById("service_table");
        var select = table.rows[0].cells[0].children[0].cloneNode(true);
        var newRow = table.insertRow(-1);
        var selectCell = newRow.insertCell(0);
        var inputCell = newRow.insertCell(1);
        var inputCell2 = newRow.insertCell(2);
        var removeCell = newRow.insertCell(3);
        selectCell.appendChild(select);
        inputCell.innerHTML = '<select  class="form-control" name="type[]" required><option selected disabled>-- Select Radiology Type --</option> <option value="X-ray">X-ray</option> <option value="Ultrasound">Ultrasound</option> <option value="CT-Scan">CT-Scan</option> </select>';
        inputCell2.innerHTML = '<input type="number" class="form-control" name="amount[]" placeholder="Amount" required>';
        removeCell.innerHTML = '<button type="button" onclick="removeRows(this)" class="btn btn-danger rounded-0 p-2"><span class="iconify fs-20" data-icon="tabler:trash-x"></span></button>';
    }

    @else

    function addRows() {
        var table = document.getElementById("service_table");
        var select = table.rows[0].cells[0].children[0].cloneNode(true);
        var newRow = table.insertRow(-1);
        var selectCell = newRow.insertCell(0);
        var inputCell = newRow.insertCell(1);
        var removeCell = newRow.insertCell(2);
        selectCell.appendChild(select);
        inputCell.innerHTML = '<input type="number" class="form-control amount-test" oninput="calculateTestGrandTotal()" name="amount[]" placeholder="Amount" required  style="max-width:135px;margin-left:13px;">';
        removeCell.innerHTML = '<button type="button" onclick="removeRows(this)" class="btn btn-danger rounded-0 p-2"><span class="iconify fs-20" data-icon="tabler:trash-x"></span></button>';
    }

    // Calculate the grand total after adding a new row test
    calculateTestGrandTotal();

    @endif

    //set to initial value 0 first before calculate grabd total
    document.getElementById("grand-total-test").innerHTML = "Grand Total: " + 0.00;

    function calculateTestGrandTotal() {
        const testamountElements = document.querySelectorAll(".amount-test");
        let grandtestTotal = 0;

        for (let is = 0; is < testamountElements.length; is++) {
            grandtestTotal += parseFloat(testamountElements[is].value) || 0;
        }

        document.getElementById("grand-total-test").innerHTML = "<strong>Grand Total:</strong> " + grandtestTotal.toFixed(2);
    }

    function removeRows(button) {
        var table = document.getElementById("service_table");
        var rows = table.rows.length;
        if (rows === 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "error",
                title: "At least one row must be left",
            })

        } else {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            calculateTestGrandTotal();
        }
    }


    function addRowstwo() {
        var table_two = document.getElementById("service_table_two");
        var select_two = table_two.rows[0].cells[0].children[0].cloneNode(true);
        var newRow_two = table_two.insertRow(-1);
        var selectCell_two = newRow_two.insertCell(0);
        var inputCell1_two = newRow_two.insertCell(1);
        var inputCell_two = newRow_two.insertCell(2);
        var inputCell2_two = newRow_two.insertCell(3);
        var removeCell_two = newRow_two.insertCell(4);
        selectCell_two.appendChild(select_two);
        inputCell1_two.innerHTML = '<input type="text" class="form-control" readonly placeholder="Category"   style="margin-left:13px;">';
        inputCell_two.innerHTML = '<input type="number" class="form-control qty"  oninput="calculateGrandTotal()" name="qty[]" placeholder="Qty" required  style="margin-left:13px;">';
        inputCell2_two.innerHTML = '<input type="number" class="form-control amount" name="amount[]" placeholder="Amount" required  style="margin-left:23px;">';
        removeCell_two.innerHTML = '<button type="button" onclick="removeRowstwo(this)" class="btn btn-danger rounded-0 p-2"><span class="iconify fs-20" data-icon="tabler:trash-x"></span></button>';

        // Add change event listener to the select tag
        select_two.addEventListener("change", function () {
            var selectedOption = this.options[this.selectedIndex];
            var selectedAmount = selectedOption.dataset.amount;
            var selectedCategory = selectedOption.dataset.category;
            inputCell1_two.children[0].value = selectedCategory;
            inputCell2_two.children[0].value = selectedAmount;
            
        });

        // Calculate the grand total after adding a new row medicine
        calculateGrandTotal();
    }

    function updateAmount(select) {
        const selectedOption = select.options[select.selectedIndex];
        const amount = selectedOption.getAttribute("data-amount");
        const category = selectedOption.getAttribute("data-category");
        const input_amt = select.closest("tr").querySelector("input[name='amount[]']");
        const input_category = select.closest("tr").querySelector("input[name='category']");
        input_amt.value = amount;
        input_category.value = category;
    }

    function removeRowstwo(buttontwo) {
        var tabletwo = document.getElementById("service_table_two");
        var rowss = tabletwo.rows.length;
        if (rowss === 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "error",
                title: "At least one row must be left",
            })

        } else {
            var rowtwo = buttontwo.parentNode.parentNode;
            rowtwo.parentNode.removeChild(rowtwo);
            calculateGrandTotal();
        }
    }

    //GRAND TOTAL CALCULATION SCRIPT

    //set to initial value 0 first before calculate grabd total
    document.getElementById("grand-total").innerHTML = "Grand Total: " + 0.00;

    function calculateGrandTotal() {
        const qtyElements = document.querySelectorAll(".qty");
        const amountElements = document.querySelectorAll(".amount");
        let grandTotal = 0;
        // let subTotal = 0;

        for (let i = 0; i < qtyElements.length; i++) {
            grandTotal += qtyElements[i].value * amountElements[i].value;
        }
        // document.getElementById("sub-total").innerHTML = "Sub Total: " + subTotal.toFixed(2);
        document.getElementById("grand-total").innerHTML = "<strong>Grand Total:</strong> " + grandTotal.toFixed(2);
    }

    const qtyInputs = document.querySelectorAll(".qty");
    const amountInputs = document.querySelectorAll(".amount");

    qtyInputs.forEach(input => {
        input.addEventListener("input", calculateGrandTotal);
    });

    amountInputs.forEach(input => {
        input.addEventListener("input", calculateGrandTotal);
    });

  //END GRAND TOTAL SCRIPT




</script>

<script>
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;
    document.getElementById("thedate").value = today;

</script>

@if(Auth::user()->type == 3 && Auth::user()->status == null )
<script type="text/javascript">
    $(document).ready(function () {
        $("#doctor_request").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#doctor_request").modal("show");
    });

</script>
@else
<script type="text/javascript">
    $(document).ready(function () {
        $("#doctor_request").modal("hide");
    });

</script>
@endif


<script>
    $(document).ready(function() {
    //MODALS
    $('#buymed').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var mid = button.data('id')
        var purchase = button.data('purchase')
        var qty = button.data('qty')
        var company = button.data('company')
        var expiry = button.data('expiry')
        var modal = $(this)
        modal.find('.modal-body #mid').val(mid)
        modal.find('.modal-body #purchase').text(purchase)
        modal.find('.modal-body #qty').text(qty)
        modal.find('.modal-body #company').text(company)
        modal.find('.modal-body #expiry').text(expiry)
    })



    $('#generatePID').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        var pid = button.data('pid')
        var dep = button.data('dep')
        var ppid = button.data('ppid')

        var modal = $(this)
        modal.find('.modal-body #pid').val(pid)
        modal.find('.modal-body #dep').val(dep)
        modal.find('.modal-body #ppid').val(ppid)

    })


    $('#approve').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var tnid = button.data('tnid')
        var modal = $(this)
        modal.find('.modal-body #identify_id').val(id)
        modal.find('.modal-body #tnid').val(tnid)
    })


    $('#disapprove').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var tnid = button.data('tnid')
        var modal = $(this)
        modal.find('.modal-body #identify_id').val(id)
        modal.find('.modal-body #tnid').val(tnid)
    })


    $('#complete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var pid = button.data('pid')
        var tid = button.data('tid')
        var modal = $(this)
        modal.find('.modal-body #pid').val(pid)
        modal.find('.modal-body #tid').val(tid)
    })


    $('#editmed').on('show.bs.modal', function (event) {

        $(".select_delivery_med").select2({
    dropdownParent: $("#editmed"),
    width: '100%',
    });


        var button = $(event.relatedTarget)
        var medid = button.data('medid')
        var medname = button.data('medname')
        var catid = button.data('catid')
        var brand = button.data('brand')
        var reg = button.data('reg')
        var purchaseprice = button.data('purchaseprice')
        var saleprice = button.data('saleprice')
        var qty = button.data('qty')
        var company = button.data('company')
        var expiry = button.data('expiry')
        var modal = $(this)
        modal.find('.modal-body #med_id').val(medid)
        modal.find('.modal-body #edit_name').val(medname)
        modal.find('.modal-body #edit_category').val(catid)
        modal.find('.modal-body #brand_number').val(brand)
        modal.find('.modal-body #registration_number').val(reg)
        modal.find('.modal-body #edit_purchase_price').val(purchaseprice)
        modal.find('.modal-body #edit_sale_price').val(saleprice)
        modal.find('.modal-body #quantity').val(qty)
        modal.find('.modal-body #company').val(company)
        modal.find('.modal-body #expire_date').val(expiry)
        if ($.isFunction($.fn.flatpickr)) {
            $("#expire_date").flatpickr().destroy();
        }

        flatpickr('#expire_date', {
            altInput: true,
            dateFormat: "Y-m-d",
        });
    })

    $('#removemed').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #remove_med').val(id)
    })

    $('#editdelivery').on('show.bs.modal', function (event) {

    $(".select_delivery_edit").select2({
    dropdownParent: $("#editdelivery"),
    width: '100%',
    });

    var button = $(event.relatedTarget)
    var id = button.data('id')
    var item = button.data('item')
    var category = button.data('category')
    var brand = button.data('brand')
    var lotno = button.data('lotno')
    var expiry = button.data('expiry')
    var qty = button.data('qty')
    var unitprice = button.data('unitprice')
 
    var modal = $(this)
    modal.find('.modal-body #delivery_id').val(id)
    modal.find('.modal-body #edit_name').val(item)
    modal.find('.modal-body #edit_category').val(category)
    modal.find('.modal-body #brand').val(brand)
    modal.find('.modal-body #lot_number').val(lotno)
    modal.find('.modal-body #expire_date').val(expiry)
    modal.find('.modal-body #quantity').val(qty)
    modal.find('.modal-body #edit_unit_price').val(unitprice)
    if ($.isFunction($.fn.flatpickr)) {
        $("#expire_date").flatpickr().destroy();
    }

    flatpickr('#expire_date', {
        altInput: true,
        dateFormat: "Y-m-d",
    });
})



    $('#removedelivery').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #delivery_id').val(id)
    })


    $('#addpatient').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var ticket = button.data('ticket')
        var depid = button.data('depid')
        var modal = $(this)
        modal.find('.modal-body #ticket_no').val(ticket)
        modal.find('.modal-body #depid').val(depid)
    })
    

 
    $('#editpatient').on('show.bs.modal', function (event) {
        try {
      var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
    } catch (e) {
      console.error("Error initializing SignaturePad:", e);
    }
      var button = $(event.relatedTarget)
      var pid = button.data('pid')
      var fname = button.data('fname')
      var lname = button.data('lname')
      var bdate = button.data('bdate')
      var age = button.data('age')
      var gender = button.data('gender')
      var address = button.data('address')
      var fundtype = button.data('fundtype')
      var modal = $(this)
      modal.find('.modal-body #pid').val(pid)
      modal.find('.modal-body #fname').val(fname)
      modal.find('.modal-body #lname').val(lname)
      modal.find('.modal-body #bdate_update').val(bdate)

      if ($.isFunction($.fn.flatpickr)) {
        $("#bdate_update").flatpickr().destroy();
      }

      flatpickr('#bdate_update', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
          var Bdate = document.getElementById('bdate_update').value;
          var Bday = +new Date(Bdate);
          var age = ~~((Date.now() - Bday) / (31557600000));
          document.getElementById('age_update').value = age;
        }
      });

      modal.find('.modal-body #age_update').val(age)
      modal.find('.modal-body select[name="gender"] option').each(function () {
        if ($(this).val() == gender) {
          $(this).prop('selected', true);
        }
      });
      modal.find('.modal-body #address').val(address)
      modal.find('.modal-body select[name="fund_type"] option').each(function () {
        if ($(this).val() == fundtype) {
          $(this).prop('selected', true);
        }
      });
    }) 



    $('#editDept').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var department = button.data('department')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #dept_id').val(id)
        modal.find('.modal-body #department').val(department)
        modal.find('.modal-body #description').val(description)
    })



    $('#approve_patientrequest').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var pid = button.data('pid')
        var ticket = button.data('ticket')
        var modal = $(this)
        modal.find('.modal-body #pid').val(pid)
        modal.find('.modal-body #ticket').val(ticket)
    })

    $('#editmedcategory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #mcid').val(id)
        modal.find('.modal-body #category_name_edit').val(name)
    })



    $('#edit_ticket').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var test = button.data('test')
        var category = button.data('category')
        var amount = button.data('amount')
        var modal = $(this)
        modal.find('.modal-body #ticket_id').val(id)
        modal.find('.modal-body #test').val(test)
        modal.find('.modal-body #category').val(category)
        modal.find('.modal-body #amount').val(amount)
    })


    $('#removeticket').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #remove_item').val(id)
    })



    $('#editcategory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #mcid').val(id)
        modal.find('.modal-body #category_name_edit').val(name)
    })

    $('#removecategory').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #remove_category').val(id)
    })

  //ACCOUNTS

  $('#editstaff').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var fname = button.data('fname')
        var lname = button.data('lname')
        var empid = button.data('empid')
        var email = button.data('email')
        var password = button.data('password')
        // var picture = button.data('picture')
        var bday = button.data('bday')
        var age = button.data('age')
        var mobile = button.data('mobile')
        var gender = button.data('gender')
        var department = button.data('department')
        var modal = $(this)
        modal.find('.modal-body #staff_id').val(id)
        modal.find('.modal-body #first_name').val(fname)
        modal.find('.modal-body #last_name').val(lname)
        modal.find('.modal-body #employee_id').val(empid)
        modal.find('.modal-body #email').val(email)
        modal.find('.modal-body #password').val(password)
        // modal.find('.modal-body #picture-edit').html(picture)
        modal.find('.modal-body #bdate_edit').val(bday)
        modal.find('.modal-body #age_edit').val(age)
        modal.find('.modal-body #mobile-edit').val(mobile) 
        modal.find('.modal-body #gender').val(gender)
        modal.find('.modal-body #departments').val(department)

        if ($.isFunction($.fn.flatpickr)) {
            $("#bdate_edit").flatpickr().destroy();
        }

        flatpickr('#bdate_edit', {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
  })

  $('#removestaff').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #remove_staff').val(id)
  })

  $('#deactivate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #staff_id').val(id)
  })

  $('#activate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('.modal-body #staff_id').val(id)
  })


});
</script>
<!-- END MODAL -->


<script>
    $(document).ready(function () {
        $('.zoom-image').click(function (e) {
            e.preventDefault();
            var image = $(this).find('img').clone();
            $('body').append('<div class="zoomed-image">' + image.prop('outerHTML') + '</div>');
            $('.zoomed-image').click(function () {
                $(this).remove();
            });
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })


    });

</script>

<script>
    $('.Show').click(function () {
        $('#toggle').show(200);
        $('.Show').hide(0);
        $('.Hide').show(0);
    });
    $('.Hide').click(function () {
        $('#toggle').hide(500);
        $('.Show').show(0);
        $('.Hide').hide(0);
    });
    $('.toggle').click(function () {
        $('#toggle').toggle('slow');
    });

    function submitBdayPatient() {
        var Q4A = "";
        var Bdate = document.getElementById('bdate_patient').value;
        var Bday = +new Date(Bdate);
        Q4A += ~~((Date.now() - Bday) / (31557600000));
        document.getElementById('age_patient').value = Q4A;
    }

    function submitBday() {
        var Q4A = "";
        var Bdate = document.getElementById('bdate').value;
        var Bday = +new Date(Bdate);
        Q4A += ~~((Date.now() - Bday) / (31557600000));
        document.getElementById('age').value = Q4A;
    }

    function submitBday_edit() {
        var Q4A = "";
        var Bdate = document.getElementById('bdate_edit').value;
        var Bday = +new Date(Bdate);
        Q4A += ~~((Date.now() - Bday) / (31557600000));
        document.getElementById('age_edit').value = Q4A;
    }






   

</script>

<!-- <script>
    const dropdown = document.querySelector('#department_id');
    const radiology_test = document.querySelector('#radiology_test');
    const another_select = document.querySelector('#another_select');


    dropdown.addEventListener('change', function () {
        if (this.value == 3) {
            radiology_test.style.visibility = 'visible';
        } else {
            radiology_test.style.visibility = 'hidden';
            another_select.selectedIndex = 0;
        }
    });

</script> -->

<script>
$(document).ready(function() {
  $(".select_pharmacy").select2({
    dropdownParent: $("#addmed"),
    width: '100%',
  });

  $(".select_pharmacy_category").select2({
    dropdownParent: $("#addmed"),
    width: '100%',
  });

  $(".select_delivery").select2({
    dropdownParent: $("#addDelivery"),
    width: '100%',
  });

//   $(".select_delivery").select2({
//     dropdownParent: $("#editdelivery"),
//     width: '100%',
//   });








  

});

//IMAGE CHAGE DYNAMIC ADD

const imageInputs = document.querySelectorAll('.image-input');
const avatarImages = document.querySelectorAll('.avatar-image');

for (let i = 0; i < imageInputs.length; i++) {
  imageInputs[i].addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (event) => {
      avatarImages[i].src = event.target.result;
    };
  });
}


// GENERATE ID MODAL IN CREATING STAFF
// Get the button and the modal elements for add staff
const addstaff_button = document.getElementById('add-staff-modal');
const addstaff_modal = document.getElementById('addstaff');

// Get the input element that will display the employee ID
const addEmployeeIdInput = addstaff_modal.querySelector('#add_employee_id');


// Attach an event listener to the button for add staff
addstaff_button.addEventListener('click', function() {
  // Generate a random number between 1 and 1000
  const randomNumber = Math.floor(Math.random() * 1000) + 1;

  // Get the current year and time
  const currentDate = new Date();
  const year = currentDate.getFullYear();
  //const time = currentDate.getTime();  this will get milli seconds
  //const time = Math.floor(currentDate.getTime() / 1000); // Convert to seconds
  const time = Math.floor(currentDate.getTime() / (1000 * 60)); // Convert to minutes

  // Combine the random number, year, and time to create the employee ID
  const employeeId_add = `${randomNumber}-${year}-${time}`;

  // Set the employee ID in the input field for add staff
  addEmployeeIdInput.value = employeeId_add;

  // Display the modal for add staff
  addstaff_modal.style.display = 'block';
});

// Attach an event listener to the close button in the add staff modal
const addCloseButton = addstaff_modal.querySelector('.close');
addCloseButton.addEventListener('click', function() {
  addstaff_modal.style.display = 'none';
});

// Attach an event listener to the reset button for add staff
const addResetButtons = addstaff_modal.querySelectorAll('.resetStaff');
addResetButtons.forEach(function(addResetButton) {
  addResetButton.addEventListener('click', function(event) {
    // Clear all input fields except for the employee ID field for add staff
    const addInputs = addstaff_modal.querySelectorAll('input:not(#add_employee_id)');
    addInputs.forEach(function(input) {
      input.value = '';
    });

    // Prevent the default behavior of the reset button, which is to clear all input fields
    event.preventDefault();
  });
});
//END OF AUTO GENERATE EMPLOYEE ID WITH RESET



//GENERATE SECURE PASSWORD ADD STAFF

/*
CAN USE THIS ON SINGLE MODAL ONLY THAT UNIQUE INPUT ID

const passwordInput = document.getElementById('password');   
const generatePasswordButton = document.getElementById('generate-password'); 

generatePasswordButton.addEventListener('click', function() { it will run only single modal
const password = generatePassword();
passwordInput.value = password;   
 }); */

// loop the input class so that script can also run both add and edit modal
const passwordInputs = document.querySelectorAll('.password-input');
const generatePasswordButtons = document.querySelectorAll('.generate-password');

generatePasswordButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    const password = generatePassword();
    const passwordInput = button.closest('.modal').querySelector('.password-input');
    passwordInput.value = password;

  });
});



function generatePassword() {
  // Define the character sets to use
  const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
  const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const numberChars = '0123456789';
  const specialChars = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';

  // Combine the character sets into one string
  const allChars = lowercaseChars + uppercaseChars + numberChars + specialChars;

  // Generate a random password
  let password = '';
  for (let i = 0; i < 12; i++) {
    const randomIndex = Math.floor(Math.random() * allChars.length);
    password += allChars[randomIndex];
  }

  return password;
}



//ADD STAFF VALIDATE MOBILE NUMBER

const mobileInput = document.getElementById("mobile");
const submitBtn = document.querySelector(".submitBtn");

submitBtn.addEventListener("click", function(event) {

  const mobileRegex = /^\+63\d{10}$/;
  const mobileNumber = mobileInput.value.trim();

  if (!mobileNumber.match(mobileRegex)) {
    Swal.fire({
      icon: "error",
      title: "Invalid Mobile Number",
      text: "Please enter a Philippine mobile number with a country code of +63 (e.g. +639171234567).",
      toast: true,
      position: "top-right",
      showConfirmButton: false,
      timer: 3000
    });
    return false;
  }

  const form = document.querySelector("#addstaff-form-id");
  form.submit();

  event.preventDefault();
});

</script>

<script>
var ctx = document.getElementById('charge-chart').getContext('2d');
var chartData = {
    labels: {!! json_encode(session('chartData.months')) !!},
    datasets: [{
    label: 'Total Sales',
    data: {!! json_encode(session('chartData.totalCharges')) !!},
    borderColor: 'rgba(0, 128, 255, 1)',
    backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ],
    borderWidth: 2,
    pointRadius: 4,
    pointBackgroundColor: 'rgba(0, 128, 255, 1)',
    pointBorderColor: 'rgba(0, 128, 255, 1)',
    pointHoverRadius: 6,
    pointHoverBackgroundColor: 'rgba(0, 128, 255, 1)',
    pointHoverBorderColor: 'rgba(0, 128, 255, 1)'
}]

};
var chartOptions = {
    animation: {
        duration: 1000
    },
    plugins: {
        datalabels: {
            color: 'rgba(0, 0, 0, 1)',
            font: {
                weight: 'bold'
            },
            formatter: function(value, context) {
                if (value === 0) {
                    return 'No data';
                } else {
                    return 'PHP ' + value.toFixed(2);
                }
            }
        },
        zoom: {
            wheel: {
                enabled: true,
            },
            pinch: {
                enabled: true
            },
            mode: 'xy',
            speed: 0.05
        },
        pan: {
            enabled: true,
            mode: 'xy'
        },
        limits: {
            x: {
                min: 'auto',
                max: 'auto'
            },
            y: {
                min: 'auto',
                max: 'auto'
            }
        }
    },
    plugins: {
            chartjsPluginChart3d: {
                // set the desired angle for the chart
                rotation: {
                    x: -10,
                    y: 0
                },
                // set the desired depth for the chart
                depth: 50,
                // set the desired bevel size for the chart
                bevelSize: 1,
                // set the desired bevel angle for the chart
                bevelAngle: Math.PI / 6
            }
        },
    scales: {
        x: {
            grid: {
                display: false
            },
            ticks: {
                font: {
                    size: 12
                },
                color: 'rgba(0, 0, 0, 1)'
            }
        },
        y: {
            grid: {
                color: 'rgba(128, 128, 128, 0.2)',
                lineWidth: 1
            },
            ticks: {
                font: {
                    size: 12
                },
                color: 'rgba(0, 0, 0, 1)',
                callback: function(value) {
                    return 'PHP ' + value.toFixed(2);
                }
            }
        }
    },
    barThickness: 20
};
var chart = new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: chartOptions
});

</script>



<script>
const exportBtns = document.querySelectorAll('.export-btn');
exportBtns.forEach(btn => {
  btn.addEventListener('click', () => {

    // Get the table element
    const tableId = btn.dataset.tableId; // get the table id from the button
    const table = document.querySelector(`#${tableId}`); // select the table using the id

    // Convert the table to a workbook object
    const workbook = XLSX.utils.table_to_book(table);

    // Get the first sheet of the workbook
    const sheetName = workbook.SheetNames[0];
    const sheet = workbook.Sheets[sheetName];

    // Set the column widths and cell styling
    const columns = ['A', 'B', 'C', 'D', 'E'];
    const padding = 2; // set the padding value
    columns.forEach(col => {
      // Set the column width
      sheet['!cols'] = sheet['!cols'] || [];
      sheet['!cols'].push({ wch: 20 + padding });

      // Set the cell padding
      for (let i = 2; i <= table.rows.length; i++) {
        const cellRef = col + i;
        if (sheet[cellRef] && sheet[cellRef].s) {
          sheet[cellRef].s = { 
            alignment: { vertical: 'center', horizontal: 'center' },
            border: { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } },
            font: { sz: 14, bold: true },
            padding: { top: padding, bottom: padding, left: padding, right: padding } // set the padding value
          };
        }
      }

      // Set the row height
      for (let i = 1; i <= table.rows.length; i++) {
        const rowRef = i.toString();
        sheet['!rows'] = sheet['!rows'] || [];
        sheet['!rows'][i-1] = { hpx: 23 };
      }

    });

    // Download the workbook as an Excel file
    XLSX.writeFile(workbook, 'report.xlsx');
  });
});
</script>


<script type="text/javascript">
  var sig = $('#sig').signature({
    syncField: '#signature',
    syncFormat: 'PNG'
  });
  
  // adjust the position of the signature pad when the mouse is down
  $('#sig').on('mousedown touchstart', function(e) {
    var offset = $(this).offset(),
        left = e.pageX - offset.left,
        top = e.pageY - offset.top;
    
    sig.signature('reset');
    sig.signature('draw', left, top);
  });
  
  $('#clear').click(function(e) {
    e.preventDefault();
    sig.signature('clear');
    $("#signature").val('');
  });
</script>

<script>
function showReport() {
    var select = document.getElementById("alldepartments");
    var value = select.value;
    if (value == "0") {
        // Show the laboratory report
        document.getElementById("laboratory_report").style.display = "block";
        document.getElementById("pharmacy_report").style.display = "none";
        document.getElementById("radiology_report").style.display = "none";
        document.getElementById("dialysis_report").style.display = "none";
    } else if (value == "1") {
        // Show the pharmacy report
        document.getElementById("laboratory_report").style.display = "none";
        document.getElementById("pharmacy_report").style.display = "block";
        document.getElementById("radiology_report").style.display = "none";
        document.getElementById("dialysis_report").style.display = "none";
    } else if (value == "2") {
        // Show the radiology report
        document.getElementById("laboratory_report").style.display = "none";
        document.getElementById("pharmacy_report").style.display = "none";
        document.getElementById("radiology_report").style.display = "block";
        document.getElementById("dialysis_report").style.display = "none";
    } else if (value == "3") {
        // Show the dialysis report
        document.getElementById("laboratory_report").style.display = "none";
        document.getElementById("pharmacy_report").style.display = "none";
        document.getElementById("radiology_report").style.display = "none";
        document.getElementById("dialysis_report").style.display = "block";
    }
}
</script>

<script>
function exportToExcel() {
  // Select the table element
  var table = document.querySelector('table');

  // Create a new Excel workbook
  var workbook = XLSX.utils.book_new();

  // Convert the table to a worksheet and add it to the workbook
  var worksheet = XLSX.utils.table_to_sheet(table);
  XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

  // Set column widths
  worksheet['!cols'] = [
    { width: 10 }, // A
    { width: 15 }, // B
    { width: 15 }, // C
    { width: 15 }, // D
    { width: 15 }, // E
    { width: 15 }, // F
    { width: 15 }, // G
    { width: 15 }, // H
    { width: 15 }, // I
    { width: 15 }, // J
    { width: 15 }, // K
    { width: 40 }, // L
  ];

// Set background color for Radiology header
worksheet['H1'].s = {
    fill: {
      fgColor: { rgb: "FFC0CB" } // pink
    },
    alignment: {
      horizontal: "center",
      vertical: "center"
    }
  };

  // Center the text in cell H1
  worksheet['H1'].s.alignment.horizontal = "center";

  // Save the workbook as a file
  var filename = 'SOA.xlsx';
  XLSX.writeFile(workbook, filename);
}

</script>

</body>
</html>