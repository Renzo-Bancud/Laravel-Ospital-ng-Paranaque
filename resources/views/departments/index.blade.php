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
                  <h4 class="card-title card-title-dash">Manage Departments</h4>
                  <p class="card-subtitle card-subtitle-dash">List of created departments</p>
                </div>
                <div>

                  <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addDept" class="btn btn-primary btn-lg text-white mb-0 me-0">
                    <span class="iconify fs-5" data-icon="ic:twotone-add-home-work"></span>&nbsp;Add department</a>
                </div>
              </div>
              <div class="mt-1">
                <table class="table select-table" id="data-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th style="width:500px;">Description</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($departments as $department)

                    <tr>
                      <td>{{$department->name}}</td>
                      <td>
                        {{ Str::limit($department->description, 50) }}...
                      </td>
                      <td>

                        <div class="d-flex">

                          <!-- <a href="{{route('departments.show',$department->id)}}" class="btn  btn-secondary fs-5 text-white p-2"><span class="iconify" data-icon="fluent-emoji-flat:eyes"></span></a> -->
                          <!-- <a href=""  {{route('departments.edit',$department->id)}} -->
                          <a href="javascript:;"
                          data-bs-toggle="modal" data-bs-target="#editDept"
                          data-id="{{ $department->id  }}"
                          data-department="{{ $department->dep_id  }}"
                          data-description="{{ $department->description }}"
                          class="btn  btn-success fs-5 text-white p-2"><span class="iconify" data-icon="tabler:edit"></span></a>

                          <form action="{{route('departments.destroy',$department->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn  btn-danger fs-5 text-white p-2"><span class="iconify" data-icon="iwwa:trash"></span></button>
                          </form>

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



    <div class="modal fade" id="addDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><b>Add Department</b></h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{route('departments.store')}}">
              @csrf


              <div class="form-group row mb-1">
                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Department:</label>
                <div class="col-sm-8">
                  <select class="form-control @error('department') is-invalid @enderror" name="department" id="department">
                    <option selected disabled>-- Choose Department --</option>
                    <option value="1">Laboratory</option>
                    <option value="2">Pharmacy</option>
                    <option value="3">Radiology</option>
                    <option value="4">Dialysis</option>
                  </select>



                  @error('department')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>


              <div class="form-group row mb-1">
                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Description:</label>
                <div class="col-sm-8">
                  <textarea class="form-control  @error('description') is-invalid @enderror h-100" name="description" id="description" style="min-height:200px;"></textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>



          </div>
          <div class="modal-footer p-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="modal fade" id="editDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><b>Edit Department</b></h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('update-department') }}">
              @csrf
              
              <input type="hidden" name="dept_id" id="dept_id">
          
              <div class="form-group row mb-1">
                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Department:</label>
                <div class="col-sm-8">
                  <select class="form-control @error('department') is-invalid @enderror" name="department" id="department">
                    <option selected disabled>-- Choose Department --</option>
                    <option value="1">Laboratory</option>
                    <option value="2">Pharmacy</option>
                    <option value="3">Radiology</option>
                    <option value="4">Dialysis</option>
                  </select>
                  @error('department')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>


              <div class="form-group row mb-1">
                <label for="inputRequest" class="col-sm-4 col-form-label" style="position:relative;top:-10px;">Description:</label>
                <div class="col-sm-8">
                  <textarea class="form-control  @error('description') is-invalid @enderror h-100" name="description" id="description" style="min-height:200px;"></textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>



          </div>
          <div class="modal-footer p-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    @endsection