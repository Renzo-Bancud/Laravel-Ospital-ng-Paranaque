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
                                    <h4 class="card-title card-title-dash">Manage Hemodialysis</h4>
                                
                                </div>
                                <div>
                                    <a href="{{ route('hemodialysis-category') }}"
                                        class="btn btn-dafault btn-lg mb-0 me-0">
                                        <span class="iconify fs-20" data-icon="carbon:category"></span>&nbsp;hemodialysis
                                        categories</a>



                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addDialysis"
                                        class="btn btn-primary btn-lg text-white mb-0 me-0">
                                        <span class="iconify fs-20 text-white"
                                            data-icon="material-symbols:labs-outline-rounded"></span>&nbsp;Add</a>
                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                

                                        @if(count($hemodialysis) > 0)
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Date Created</th>
                                            <th>Actions</th>
                                        </tr>
                                        @else

                                        @endempty


                                        
                                    </thead>
                                    <tbody>
                                        @forelse($hemodialysis as $dialysis)
                                        <tr>
                                            <td>{{$dialysis->test}}</td>
                                            <td>{{$dialysis->category_name }}</td>
                                            <td>{{$dialysis->amount}}</td>
                                            <td>{{$dialysis->created_at}}</td>

                                            <td>
                                                <div class="d-flex">

                                        
                                                    <a href="javascript:;"
                                                        data-bs-toggle="modal" data-bs-target="#edit_ticket"
                                                        data-id = "{{$dialysis->id}}"
                                                        data-test = "{{$dialysis->test}}"
                                                        data-category = "{{$dialysis->category_id}}"
                                                        data-amount = "{{$dialysis->amount}}"
                                                        class="btn  btn-primary fs-5 text-white p-2"><span
                                                        class="iconify" data-icon="tabler:edit"></span></a>
                                                    
                                                    <a href="javascript:void()" data-bs-toggle="modal"
                                                        data-bs-target="#removeticket" data-id="{{ $dialysis->id }}"
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



        <div class="modal fade" id="addDialysis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Add hemodialysis</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('hemodialysis.store')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Test Name:</label>
                                <div class="col-sm-8">
                                    <input id="name" class="form-control  @error('name') is-invalid @enderror"
                                        type="text" name="name" value="{{ old('name') }}"
                                        placeholder="Enter Test Name" required>
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
                                    style="position:relative;top:-10px;">Amount:</label>
                                <div class="col-sm-8">
                                    <input id="amount"
                                        class="form-control  @error('amount') is-invalid @enderror" type="number"
                                        name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" required>
                                    @error('amount')
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


        <div class="modal fade" id="edit_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Edit hemodialysis</b></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('update-hemodialysis') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="hd_id" id="ticket_id">

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Test Name:</label>
                                <div class="col-sm-8">
                                    <input id="test" class="form-control  @error('name') is-invalid @enderror"
                                        type="text" name="name" value="{{ old('name') }}"
                                        placeholder="Enter Test Name" required>
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
                                    style="position:relative;top:-10px;">Amount:</label>
                                <div class="col-sm-8">
                                    <input id="amount"
                                        class="form-control  @error('amount') is-invalid @enderror" type="number"
                                        name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" required>
                                    @error('amount')
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



        <div class="modal fade" id="removeticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body p-3">
                        <form method="POST" action="{{ route('destroy-hemodialysis') }}">
                        @method('DELETE')
                        @csrf
                        <center>
                        <input type="hidden"  name="remove_hd" id="remove_item">
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


        @endsection

        
      
        
   