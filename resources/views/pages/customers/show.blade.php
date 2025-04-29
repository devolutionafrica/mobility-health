@extends('layouts/layoutMaster')

@section('title', 'Profil client')

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
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="{{ route("customer.index",["type"=>$type]) }}" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1 text-capitalize">
                        {{$customer->name}}
                    </h4>
                    <p class="mb-0">
                        {{$customer->email}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-6">
                <div class="card-body pt-12">
                    <div class="customer-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4"
                                 style="width: 124px;height: 124px;"
                                 src="{{ $customer->avatar == null ? "/storage/fake/user.png" : urlGen(src: route("image.indexUrl", ["path" => $customer->avatar?->path]), width: 200, height: 200, fit: "contain")}}"
                                 height="120" width="120" alt="User avatar" />
                            <div class="customer-info text-center mb-6">
                                <h5 class="mb-0 text-uppercase">{{$customer->name}}</h5>
                                <span>{{$customer->email}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-container">
                        <h5 class="pb-2 border-bottom text-capitalize mt-6 mb-4">Informations</h5>
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="h6 me-1">Nom:</span>
                                <span>{{$customer->lastname}}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Prénom:</span>
                                <span>{{$customer->firstname}}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Date de naissance:</span>
                                <span>{{$customer->birth_date->format("d/m/Y")}} ( {{\Illuminate\Support\Carbon::now()->diff($customer->birth_date)->years}} ans)</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Email:</span>
                                <span>{{$customer->email}}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Numéro principal:</span>
                                <span>{!! is_array($customer->phone_number) ? '<strong>(' . ($customer->phone_number["code"] ?? "+225") . ')</strong> ' . $customer->phone_number["number"] : $customer->phone_number !!}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Numéro whatsapp:</span>
                                <span>{!! is_array($customer->phone_number) ? '<strong>(' . ($customer->phone_number["code"] ?? "+225") . ')</strong> ' . $customer->phone_number["number"] : $customer->phone_number !!}</span>
                            </li>

                            <li class="mb-2">
                                <span class="h6 me-1">Nationalité:</span>
                                <span>
                                    <img width="16"  src="https://flagcdn.com/w320/{{ $customer->nationality_id }}.png" alt="{{ $customer->nationality_id }}">
                                    <span>{{ $customer->country->name }}</span>

                                </span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Pays de résidence:</span>
                                <span>
                                     <img width="16"  src="https://flagcdn.com/w320/{{ $customer->country_of_residence_id }}.png" alt="{{ $customer->country_of_residence_id }}">
                                   <span>{{ $customer->residence->name }}</span>
                                </span>
                            </li>
                           {{-- <li class="mb-2">
                                <span class="h6 me-1">Statut du compte:</span>
                                <span class="badge bg-label-success">Active</span>
                            </li>--}}
                          {{--  <li class="mb-2">
                                <span class="h6 me-1">Type de document fournir:</span>
                                <span>{{ $customer->document_type }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Numéro du document:</span>
                                <span>{{ $customer->document_num }}</span>
                            </li>--}}
                        </ul>
                       {{-- <div class="d-flex justify-content-center">
                            <a href="javascript:;" class="btn btn-primary w-100" data-bs-target="#editUser" data-bs-toggle="modal">Edit Details</a>

                        </div>--}}
                    </div>
                </div>
            </div>
            <!-- /Customer-detail Card -->
        </div>
        <!--/ Customer Sidebar -->


        <!-- Customer Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

            <!-- / Customer cards -->
           {{-- <div class="row text-nowrap">
                <div class="col-md-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <div class="avatar">
                                    <div class="avatar-initial rounded bg-label-primary">
                                        <i class='ti ti-currency-dollar ti-lg'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5 class="card-title mb-2">Total souscription</h5>
                                <div class="d-flex align-items-baseline gap-1">
                                    <h5 class="text-primary mb-0">07</h5>
                                   --}}{{-- <p class="mb-0"> Credit Left</p>--}}{{--
                                </div>
                                --}}{{--<p class="mb-0 text-truncate">Account balance for next purchase</p>--}}{{--
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-icon mb-2">
                                <div class="avatar">
                                    <div class="avatar-initial rounded bg-label-success">
                                        <i class='ti ti-gift ti-lg'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5 class="card-title mb-2">Loyalty Program</h5>
                                <span class="badge bg-label-success mb-2">Platinum member</span>
                                <p class="mb-0">3000 points to next tier</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}


            <!-- / customer cards -->


            <!-- Invoice table -->
            <div class="card mb-6">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">
                       Historique des souscriptions
                    </h5>
                </div>
                <div class="card-datatable table-responsive mb-4">
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
                {{--<div class="table-responsive mb-4">
                    <table class="table datatables-customer-order border-top">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Montant</th>
                            <th class="text-md-center">Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>--}}
            </div>
            <!-- /Invoice table -->
        </div>
        <!--/ Customer Content -->
    </div>
@endsection
