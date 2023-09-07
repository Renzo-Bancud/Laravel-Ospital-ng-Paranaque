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
                                    <h4 class="card-title card-title-dash">Medicine Inventories</h4>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="mt-1">
                                <table class="table select-table" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>Medicine</th>
                                            <th>Category</th>
                                            <th>IN</th>
                                            <th>OUT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($medicines as $medicine)
                                        <tr>
                                            <td>{{$medicine->pharma_id == null ? 'No Input Name' : $medicine->medicine }}</td>
                                            <td>{{$medicine->category_name }}</td>
                                            <td>{{$medicine->quantity}}</td>
                                            <td>{{ $medicine->total_qty ? : 0 }}</td>  
                                             <!-- if $medicine->total_qty is null, the ternary operator will return 0 -->
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



        @endsection