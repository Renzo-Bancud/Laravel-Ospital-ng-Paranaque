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
                  <h4 class="card-title card-title-dash">Approve Requests</h4>
                  
                </div>
              </div>
              <div class="mt-1">

                <table class="table select-table" id="data-table">
                  <thead>
                    <tr>
                      <th>Ticket Number</th>
                      <th>Name</th>
                      <th>Birth Date</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Address</th>
                      <th>Request Status</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($patients as $patient)
                    <tr>
                      <td>
                        <p>{{$patient->patient_ticket}}</p>
                      </td>
                      <td>
                        <p>{{$patient->first_name.' '.$patient->last_name}}</p>
                      </td>
                      <td>
                        <p>{{$patient->birth_date}}</p>
                      </td>
                      <td>
                        <p>{{$patient->age}}</p>
                      </td>
                      <td>
                        <p>{{$patient->gender}}</p>
                      </td>
                      <td>
                        <p>{{$patient->address}}</p>
                      </td>
                      <td>
                        <p>{{ $patient->request_status == null ? 'Pending' : ($patient->request_status == 1 ? 'For Approval' : ($patient->request_status == 2 ? 'Disapproved' : 'Approve')) }}</p>
                      </td>
                      <td>
                        <p>{{$patient->updated_at}}</p>
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


    <div class="modal fade" id="forapproval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header border-0 p-0">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close mt-2" style="position:relative;left:-15px;" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-2">
            <form method="POST" action="{{ route('forapproval_request') }}">
              @csrf

              <input id="pid" type="hidden" name="pid">
              <input id="ticket" type="hidden" name="ticket">
           

              <h2 class="lead text-center">Send request to PPP office?</h2>
              <div class="d-flex justify-content-center mt-3 mb-3">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal">No</button>&nbsp;
                <button type="submit" class="btn btn-primary btn-sm">Yes</button>
              </div>

            </form>

          </div>

        </div>
      </div>
    </div>

    @endsection

    @section('scripts')

    @endsection