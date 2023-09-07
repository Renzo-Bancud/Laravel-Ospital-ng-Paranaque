@extends('layouts.dashboard')

@section('content')

<!-- begin:: Content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="card card-rounded" style="border:1px black dashed;">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Manage Laboratory Categories</h4>
                       
                                </div>
                                <div>


                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addcategory"
                                        class="btn btn-dark btn-lg mb-0 me-0 text-white">
                                        <span class="iconify fs-20" data-icon="carbon:category"></span>&nbsp;Add
                                        category</a>

                                    <a href="#" onclick="window.history.back();"
                                        class="btn btn-info btn-lg mb-0 me-0 text-right hide-back"><span
                                            class="iconify fs-20" data-icon="ion:arrow-undo"></span>&nbsp;Go Back</a>

                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                        <tr>
                                            <td>{{$category->name}}</td>



                                            <td>
                                                <div class="d-flex">
                                                    <a href="javascript:void()" data-bs-toggle="modal"
                                                        data-bs-target="#editlabcategory" data-id="{{ $category->id }}"
                                                        data-name="{{ $category->name }}"
                                                        
                                                        class="btn  btn-primary fs-5 text-white p-2">
                                                        <span class="iconify" data-icon="tabler:edit"></span></a>

                                                        <a href="javascript:void()" data-bs-toggle="modal"
                                                        data-bs-target="#removelabcategory" data-id="{{ $category->id }}"
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


                </div>
            </div>
        </div>

        <!-- begin:: Content -->

        <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Add Lab Category</b>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{  route('laboratory-category-store')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Category Name:</label>
                                <div class="col-sm-8">
                                    <input id="category_name"
                                        class="form-control  @error('category_name') is-invalid @enderror" type="text"
                                        name="category_name" value="{{ old('category_name') }}"
                                        placeholder="Enter Category Name">
                                    @error('category_name')
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


        <div class="modal fade" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title"><b>Edit Laboratory Category</b>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{  route('update-lab-category')}}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <input type="hidden" name="mcid" id="mcid">

                            <div class="form-group row" style="margin-bottom:-3px;">
                                <label for="inputRequest" class="col-sm-4 col-form-label"
                                    style="position:relative;top:-10px;">Category Name:</label>
                                <div class="col-sm-8">
                                    <input id="category_name_edit" required
                                        class="form-control  @error('category_name') is-invalid @enderror" type="text"
                                        name="category_name" value="{{ old('category_name') }}"
                                        placeholder="Enter Category Name">
                                    @error('category_name')
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

        <div class="modal fade" id="removecategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body p-3">
                        <form method="POST" action="{{route('destroy-lab-category')}}">
                        @method('DELETE')
                        @csrf
                        <center>
                        <input type="hidden"  name="remove_category" id="remove_category">
                         <h2 class="lead">Are you sure you want to remove this?</h2>
                         <small class=""><i>This will not recover anymore after you delete this record.</i></small><br><br>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Remove</button>
                         </center>

                        </form>
                    </div>
                 
                 
                </div>
            </div>
        </div>


        @endsection