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
                                    <h4 class="card-title card-title-dash">Manage Medicine Deliveries</h4>
                                </div>
                                <div>


                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addmed"
                                        class="btn btn-primary btn-lg text-white mb-0 me-0">
                                        <span class="iconify fs-20 text-white"
                                            data-icon="material-symbols:local-pharmacy-outline"></span>&nbsp;Add</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>

                                    @if(count($medicines) > 0)

                                    <tr>
                                            <th>Medicine</th>
                                            <th>Category</th>
                                            <th>Brand #</th>
                                            <th>Registration #</th>
                                            <th>Quantity</th>
                                            <th>PPP Price</th>
                                            <th>Total</th>
                                            <th>Manufacturer</th>
                                            <th>Expired Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    @else

                                    @endempty

                                     
                                    </thead>
                                    <tbody>
                                        @forelse($medicines as $medicine)
                                        <tr>
                                            <td>{{$medicine->pharma_id == null ? 'No Input Name' : $medicine->medicine }}</td>
                                            <td>{{$medicine->category_name }}</td>
                                            <td>{{$medicine->brand_number}}</td>
                                            <td>{{$medicine->registration_number}}</td>
                                            <td>{{$medicine->quantity}}</td>
                                            <td>{{$medicine->sale_price}}</td>
                                            <td>{{ number_format($medicine->sale_price * $medicine->quantity,2)}}</td>
                                            <td>{{$medicine->company}}</td>
                                            <td>{{$medicine->expire_date}}</td>

                                            <td>
                                                <div class="d-flex">

                                                 

                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#editmed" data-medid="{{$medicine->id}}"
                                                        data-medname="{{$medicine->pharma_id}}"
                                                        data-catid="{{$medicine->category_id }}"
                                                        data-brand="{{$medicine->brand_number}}"
                                                        data-reg="{{$medicine->registration_number}}"
                                                        data-purchaseprice="{{$medicine->purchase_price}}"
                                                        data-saleprice="{{$medicine->sale_price}}"
                                                        data-qty="{{$medicine->quantity}}"
                                                        data-company="{{$medicine->company}}"
                                                        data-expiry="{{$medicine->expire_date}}"
                                                        class="btn  btn-primary fs-5 text-white p-2"><span
                                                            class="iconify" data-icon="tabler:edit"></span></a>
                                                    
                                                    <a href="javascript:void()" data-bs-toggle="modal"
                                                        data-bs-target="#removemed" data-id="{{ $medicine->id }}"
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



        <div class="modal fade" id="addmed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form method="POST" action="{{route('medicines.store')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                        
                            
                            <div class="form-group row" style="margin-bottom:-3px;" id="existing_med">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Generic Name:</label>
                                <div class="col-sm-8">
                                        <select class="form-control select_pharmacy @error('name') is-invalid @enderror" name="name"
                                        id="existing_name" onchange="populateFields()">
                                        <option value="" selected disabled>-- Choose Generic Name --</option>
                                        @foreach($pharmacies as $pharmacy)
                                        <option value="{{$pharmacy->id }}" data-amount="{{$pharmacy->amount}}" 
                                        data-category="{{$pharmacy->category_id}}">{{$pharmacy->medicine}}</option>
                                        @endforeach
                                    </select>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                              
                        
                           
                            <!-- <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Category:</label>
                                <div class="col-sm-8">
                                    <input id="category"
                                        class="form-control  @error('category') is-invalid @enderror" type="text"
                                        name="category" value="{{ old('category') }}"
                                        placeholder="Item Category" required readonly>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> -->

                            <div class="form-group row" style="margin-bottom:-3px;" id="existing_med">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Category:</label>
                                <div class="col-sm-8">
                                        <select class="form-control @error('name') is-invalid @enderror" name="category"
                                        id="category" readonly>
                                        <option value="" selected disabled>-- Item Category --</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id }}">{{$category->name}}</option>
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
                                    style="position:relative;top:-10px;">Brand Lot #:</label>
                                <div class="col-sm-8">
                                    <input id="brand_number"
                                        class="form-control  @error('brand_number') is-invalid @enderror" type="number"
                                        name="brand_number" value="{{ old('brand_number') }}"
                                        placeholder="Enter Brand Lot #" required>
                                    @error('brand_number')
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
                                    style="position:relative;top:-10px;">Registration #:</label>
                                <div class="col-sm-8">
                                    <input id="registration_number"
                                        class="form-control  @error('registration_number') is-invalid @enderror"
                                        type="number" name="registration_number"
                                        value="{{ old('registration_number') }}" placeholder="Enter Registration #"
                                        required>
                                    @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Manufacturer:</label>
                                <div class="col-sm-8">
                                    <input id="company" class="form-control  @error('company') is-invalid @enderror"
                                        type="text" name="company" value="{{ old('company') }}"
                                        placeholder="Enter Company Manufacturer" required>
                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Cost:</label>
                                <div class="col-sm-8">
                                    <input id="purchase_price"
                                        class="form-control  @error('purchase_price') is-invalid @enderror"
                                        type="number" name="purchase_price" value="{{ old('purchase_price') }}"
                                        placeholder="Item Price" required readonly>
                                    @error('purchase_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">PPP Price:</label>
                                <div class="col-sm-8">
                                    <input id="sale_price"
                                        class="form-control  @error('sale_price') is-invalid @enderror" type="number"
                                        name="sale_price" value="{{ old('sale_price') }}" placeholder="PPP Price"
                                        required readonly>
                                    @error('sale_price')
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



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editmed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form method="POST" action="{{route('update-medicine')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="med_id" id="med_id">

                          

                            <div class="form-group row" style="margin-bottom:-3px;" id="existing_med">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Generic Name:</label>
                                <div class="col-sm-8">
                                        <select class="form-control select_delivery_med @error('name') is-invalid @enderror" name="name"
                                        id="edit_name" onchange="populateFieldsEdit()">
                                        <option value="" selected disabled>-- Choose Pharmacy Name --</option>
                                        @foreach($pharmacies as $pharmacy)
                                        <option value="{{$pharmacy->id }}" data-amount="{{$pharmacy->amount}}" 
                                        data-category="{{$pharmacy->category_id}}">{{$pharmacy->medicine}}</option>
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
                                    <select class="form-control @error('category') is-invalid @enderror" name="category"
                                        id="edit_category" required readonly>
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
                                    style="position:relative;top:-10px;">Brand Lot #:</label>
                                <div class="col-sm-8">
                                    <input id="brand_number"
                                        class="form-control  @error('brand_number') is-invalid @enderror" type="number"
                                        name="brand_number" value="{{ old('brand_number') }}"
                                        placeholder="Enter Brand Lot #" required>
                                    @error('brand_number')
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
                                    style="position:relative;top:-10px;">Registration #:</label>
                                <div class="col-sm-8">
                                    <input id="registration_number"
                                        class="form-control  @error('registration_number') is-invalid @enderror"
                                        type="number" name="registration_number"
                                        value="{{ old('registration_number') }}" placeholder="Enter Registration #"
                                        required>
                                    @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Manufacturer:</label>
                                <div class="col-sm-8">
                                    <input id="company" class="form-control  @error('company') is-invalid @enderror"
                                        type="text" name="company" value="{{ old('company') }}"
                                        placeholder="Enter Company Manufacturer" required>
                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Cost:</label>
                                <div class="col-sm-8">
                                    <input id="edit_purchase_price"
                                        class="form-control  @error('purchase_price') is-invalid @enderror"
                                        type="number" name="purchase_price" value="{{ old('purchase_price') }}"
                                        placeholder="Enter Item Price" required readonly>
                                    @error('purchase_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">PPP Price:</label>
                                <div class="col-sm-8">
                                    <input id="edit_sale_price"
                                        class="form-control  @error('sale_price') is-invalid @enderror" type="number"
                                        name="sale_price" value="{{ old('sale_price') }}" placeholder="Enter PPP Price"
                                        required readonly>
                                    @error('sale_price')
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



                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removemed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('destroy-medicine') }}">
                        @method('DELETE')
                        @csrf
                        <center>
                        <input type="hidden"  name="remove_med" id="remove_med">
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
            function showHidePharmacy() {
                var selectedValue = $('#select_pharmacy').val();

           
                if (selectedValue == '2') {
                    $('#existing_med').show();
                    $('#new_med').hide();
                } else {
                    $('#new_med').show();
                    $('#existing_med').hide();
                    document.getElementById("category").value = "";
                    document.getElementById("sale_price").value = "";
                    document.getElementById("purchase_price").value = "";
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

  document.getElementById("sale_price").value = amount;
  document.getElementById("purchase_price").value = amount;
  document.getElementById("category").value = category;
  document.getElementById("name").value = "";

}

function populateFieldsEdit() {
  var edit_selectedValue = document.getElementById("edit_name").value;
  var edit_options = document.getElementById("edit_name").options;
  var edit_selectedOption;
  for (var i = 0; i < edit_options.length; i++) {
    if (edit_options[i].value == edit_selectedValue) {
        edit_selectedOption = edit_options[i];
      break;
    }
  }
  var edit_amount = edit_selectedOption.getAttribute("data-amount");
  var edit_category = edit_selectedOption.getAttribute("data-category");

  document.getElementById("edit_sale_price").value = edit_amount;
  document.getElementById("edit_purchase_price").value = edit_amount;
  document.getElementById("edit_category").value = edit_category;
 

}

        </script>
        @endsection