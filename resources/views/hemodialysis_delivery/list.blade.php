@extends('layouts.dashboard')

@section('content')

<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    @if(Auth::user()->type == 1)
                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Manage Hemodialysis Items</h4>
                                </div>
                                <div>


                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addDelivery"
                                        class="btn btn-primary btn-lg text-white mb-0 me-0">
                                        <span class="iconify fs-20 text-white"
                                            data-icon="carbon:delivery-add"></span>&nbsp;Add</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                    

                                        @if(count($hemodialysis_deliveries) > 0)

                                        <tr>
                                            <th>Item</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Lot No.</th>
                                            <th>Expiry</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Actions</th>
                                        </tr>
                                        @else

                                        @endempty


                                    </thead>
                                    <tbody>
                                        @forelse($hemodialysis_deliveries  as $hd)
                                        <tr>
                                            <td>{{$hd->test }}</td>
                                            <td>{{$hd->category_name}}</td>
                                            <td>{{$hd->brand }}</td>
                                            <td>{{$hd->lot_no}}</td>
                                            <td>{{$hd->expiry }}</td>
                                            <td>{{$hd->qty}}</td>
                                            <td>{{$hd->unit_price}}</td>
                                          

                                            <td>
                                                <div class="d-flex">
                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#editdelivery"
                                                        data-id="{{$hd->hid}}"
                                                        data-category="{{$hd->category_id}}"
                                                        data-item="{{$hd->dialysis_id}}"
                                                        data-brand="{{$hd->brand}}"
                                                        data-lotno="{{$hd->lot_no }}"
                                                        data-expiry="{{$hd->expiry}}"
                                                        data-qty="{{$hd->qty}}"
                                                        data-unitprice="{{$hd->unit_price}}"
                                                       
                                                        class="btn  btn-primary fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="tabler:edit"></span></a>
                                                    
                                                    <a href="javascript:void()" data-bs-toggle="modal"
                                                        data-bs-target="#removedelivery" data-id="{{ $hd->hid }}"
                                                        class="btn  btn-danger fs-5 text-white p-2">
                                                        <span class="iconify" data-icon="iwwa:trash"></span></a>

                                        
                                                </div>
                                            </td>


                                        </tr>
                                        @empty
                                        <tr>
                                            <td>No Data</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    @else

                    <script>
                        Swal.fire({
                            title: "Intruder!",
                            text: "You need to contact administrator to access this page.",
                            icon: "warning",
                            confirmButtonText: "OK",
                            onOpen: function () {
                                var modalss = document.getElementsByClassName("swal-modal")[0];
                                modalss.style.backgroundColor = "rgba(0, 0, 0, 0)";
                            }
                        }).then(function () {
                            document.getElementById('logout-form').submit();
                        });
                    </script>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    @endif





                </div>
            </div>
        </div>

        <!-- begin:: Content -->

        <div class="modal fade" id="addDelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Add Delivery</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('dialysis-deliveries.store')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                        
                            <div class="form-group row" style="margin-bottom:-3px;" id="existing_hemodialysis">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Item:</label>
                                <div class="col-sm-8">
                                        <select class="form-control select_delivery @error('name') is-invalid @enderror" name="name"
                                        id="existing_name" onchange="populateFields()">
                                        <option value="" selected disabled>-- Choose Hemodialysis Name --</option>
                                        @foreach($hemodialysis as $dialysis)
                                        <option value="{{$dialysis->id }}" data-amount="{{$dialysis->amount}}" data-category="{{$dialysis->category_id}}" 
                                        >{{$dialysis->test}}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                           
                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Category:</label>
                                <div class="col-sm-8">
                                    <select class="form-control select_delivery_category @error('category') is-invalid @enderror" name="category"
                                        id="category" required>
                                        <option selected disabled>-- Choose Category --</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                              

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Brand:</label>
                                <div class="col-sm-8">
                                    <input id="brand"
                                        class="form-control  @error('brand') is-invalid @enderror" type="text"
                                        name="brand" value="{{ old('brand') }}"
                                        placeholder="Enter Brand" required>
                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Lot #:</label>
                                <div class="col-sm-8">
                                    <input id="lot_number"
                                        class="form-control  @error('lot_number') is-invalid @enderror"
                                        type="number" name="lot_number"
                                        value="{{ old('lot_number') }}" placeholder="Enter Lot #"
                                        required>
                                    @error('lot_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Expiry Date:</label>
                                <div class="col-sm-8">
                                    <input id="expire_date"
                                        class="form-control  @error('expire_date') is-invalid @enderror" type="number"
                                        name="expire_date" value="{{ old('expire_date') }}"
                                        placeholder="Select Date of Expiry" required>
                                    @error('expire_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Quantity:</label>
                                <div class="col-sm-8">
                                    <input id="quantity" class="form-control  @error('quantity') is-invalid @enderror"
                                        type="number" name="quantity" value="{{ old('quantity') }}"
                                        placeholder="Enter Delivered Qty." required>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                    

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Unit Price:</label>
                                <div class="col-sm-8">
                                    <input id="unit_price"
                                        class="form-control  @error('unit_price') is-invalid @enderror" type="number"
                                        name="unit_price" value="{{ old('unit_price') }}" placeholder="Enter Unit Price"
                                        required>
                                    @error('unit_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                    



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editdelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Edit Delivery</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('update-hemodialysis-delivery')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="delivery_id" id="delivery_id">

                    
                            <div class="form-group row" style="margin-bottom:-3px;" id="existing_hemodialysis">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Item:</label>
                                <div class="col-sm-8">
                                        <select class="form-control select_delivery_edit @error('name') is-invalid @enderror" name="name"
                                        id="edit_name" onchange="populateFieldsEdit()">
                                        <option value="" selected disabled>-- Choose Hemodialysis Name --</option>
                                        @foreach($hemodialysis as $dialysis)
                                        <option value="{{$dialysis->id }}" data-amount="{{$dialysis->amount}}" data-category="{{$dialysis->category_id}}" 
                                        >{{$dialysis->test}}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Category:</label>
                                <div class="col-sm-8">
                                    <select class="form-control select_category_edit  @error('category') is-invalid @enderror" name="category"
                                        id="edit_category" required>
                                        <option selected disabled>-- Choose Category --</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                
                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Brand:</label>
                                <div class="col-sm-8">
                                    <input id="brand"
                                        class="form-control  @error('brand') is-invalid @enderror" type="text"
                                        name="brand" value="{{ old('brand') }}"
                                        placeholder="Enter Brand" required>
                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Lot #:</label>
                                <div class="col-sm-8">
                                    <input id="lot_number"
                                        class="form-control  @error('lot_number') is-invalid @enderror"
                                        type="number" name="lot_number"
                                        value="{{ old('lot_number') }}" placeholder="Enter Lot #"
                                        required>
                                    @error('lot_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Expiry Date:</label>
                                <div class="col-sm-8">
                                    <input id="expire_date"
                                        class="form-control  @error('expire_date') is-invalid @enderror" type="number"
                                        name="expire_date" value="{{ old('expire_date') }}"
                                        placeholder="Select Date of Expiry" required>
                                    @error('expire_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Quantity:</label>
                                <div class="col-sm-8">
                                    <input id="quantity" class="form-control  @error('quantity') is-invalid @enderror"
                                        type="number" name="quantity" value="{{ old('quantity') }}"
                                        placeholder="Enter Delivered Qty." required>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                    

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Unit Price:</label>
                                <div class="col-sm-8">
                                    <input id="edit_unit_price"
                                        class="form-control  @error('unit_price') is-invalid @enderror" type="number"
                                        name="unit_price" value="{{ old('unit_price') }}" placeholder="Enter Unit Price"
                                        required>
                                    @error('unit_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                    



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="removedelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('destroy-hemodialysis-delivery') }}">
                        @method('DELETE')
                        @csrf
                        <center>
                        <input type="hidden"  name="remove_delivery" id="delivery_id">
                         <h2 class="lead">Are you sure you want to remove this?</h2>
                         <small class=""><i>This will not recover anymore after you delete this record.</i></small><br><br>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Remove</button>
                         </center>

                        </form>
                    </div>
                 
                 
                </div>
            </div>
        </div>

       

        <script>
            function showHideHemodialysis() {
                var selectedValue = $('#select_hemodialysis').val();

           
                if (selectedValue == '2') {
                    $('#existing_hemodialysis').show();
                    $('#new_hemodialysis').hide();
                } else {
                    $('#new_hemodialysis').show();
                    $('#existing_hemodialysis').hide();
                    document.getElementById("unit_price").value = "";
                }
            }

            function populateFields() {
  var selectedValue = document.getElementById("existing_name").value;
  var options = document.getElementById("existing_name").options;
  var selectedOption;
  for (var i = 0; i < options.length; i++) {
    if (options[i].value == selectedValue) {
      selectedOption = options[i];
      break;
    }
  }
  var amount = selectedOption.getAttribute("data-amount");
  var category = selectedOption.getAttribute("data-category");


  document.getElementById("unit_price").value = amount;
  document.getElementById("category").value = category;
 
}

function populateFieldsEdit() {
  var selectedValue_edit = document.getElementById("edit_name").value;
  var options_edit = document.getElementById("edit_name").options;
  var selectedOption_edit;
  for (var i = 0; i < options_edit.length; i++) {
    if (options_edit[i].value == selectedValue_edit) {
      selectedOption_edit = options_edit[i];
      break;
    }
  }
  var amount_edit = selectedOption_edit.getAttribute("data-amount");
  var category_edit = selectedOption_edit.getAttribute("data-category");


  document.getElementById("edit_unit_price").value = amount_edit;
  document.getElementById("edit_category").value = category_edit;
}

        </script>
        @endsection