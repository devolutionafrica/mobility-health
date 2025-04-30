@extends('layouts/layoutMaster')

@section('title', "Souscriptions")

<!-- Vendor Styles -->
@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/@form-validation/form-validation.scss',
      'resources/assets/vendor/libs/animate-css/animate.scss',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/moment/moment.js',
      'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js',
      'resources/assets/vendor/libs/cleavejs/cleave.js',
      'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/js/table/table-manager.js'])
@endsection

@section('content')

    {{--<div class="row g-6 mb-6">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$totalUser}}</h4>
                                <p class="text-success mb-0">(100%)</p>
                            </div>
                            <small class="mb-0">Total Users</small>
                        </div>
                        <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="ti ti-user ti-26px"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Verified Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$verified}}</h4>
                                <p class="text-success mb-0">(+95%)</p>
                            </div>
                            <small class="mb-0">Recent analytics </small>
                        </div>
                        <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
              <i class="ti ti-user-check ti-26px"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Duplicate Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$userDuplicates}}</h4>
                                <p class="text-success mb-0">(0%)</p>
                            </div>
                            <small class="mb-0">Recent analytics</small>
                        </div>
                        <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="ti ti-users ti-26px"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Verification Pending</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">{{$notVerified}}</h4>
                                <p class="text-danger mb-0">(+6%)</p>
                            </div>
                            <small class="mb-0">Recent analytics</small>
                        </div>
                        <div class="avatar">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="ti ti-user-search ti-26px"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                Souscriptions
            </h5>
        </div>
        <div class="card-datatable table-responsive">

            <table class="mh-datatable table"
                   data-location="{{\Illuminate\Support\Facades\URL::current()}}"
                   data-config="{{ json_encode($table["columns"]) }}">
                <thead class="border-top">

                <tr>
                    @foreach($table["fields"] as $col => $size)
                        <th style="max-width: {{ $size }}">{{$col}}</th>
                    @endforeach
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
