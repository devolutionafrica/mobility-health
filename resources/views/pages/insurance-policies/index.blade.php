@php use Illuminate\Support\Facades\URL; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Formules')

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
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <div
                class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1">
                        Formules
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ route("insurance_policies.create") }}" class="btn btn-primary">
                <i class="ti ti-plus"></i>
                <span class="d-inline-block ms-2">Nouveau</span>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($insurancePolicies as $insurancePolicy)
            <div class="col-lg-3 order-1 order-md-0">
                <div class="card mb-6 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="customer-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <div class="" style="width: 100%; height:224px;">
                                    <img class="img-fluid mb-4 w-100 h-100"
                                         src="{{ urlGen(src:route("image.indexUrl",["path"=>$insurancePolicy->miniature->path]),width: 300,height: 300,fit: "contain") }}"
                                         alt="{{ $insurancePolicy->name }}"/>
                                </div>
                                <div class="customer-info px-3 text-start mb-2">
                                    <h5 class="mb-0 py-2">
                                        {{ $insurancePolicy->name }}
                                    </h5>
                                    <p>
                                        {{ $insurancePolicy->summary }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="info-container p-2 border-top">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route("insurance_policies.show",["insurancePolicy"=>$insurancePolicy->id]) }}"
                                   class="btn btn-text-primary w-100 text-uppercase">Détail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Customer-detail Card -->
            </div>
        @endforeach

    </div>
@endsection
