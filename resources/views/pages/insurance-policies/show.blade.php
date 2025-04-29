@php use Illuminate\Support\Facades\URL; @endphp
@extends('layouts/layoutMaster')

@section('title', $insurancePolicy->name)

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
    @php
    $page = \Illuminate\Support\Facades\Request::query('page','package')
    @endphp
    <div class="row">
        <div class="col-auto">
            <a href="{{ route("insurance_policies.index") }}" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class=" mb-sm-0">
                    <h4 class="mb-1">
                        {{ $insurancePolicy->name }}
                    </h4>
                </div>
                <div class="">
                    <a href="{{ route("insurance_policies.edit", ["insurancePolicy" => $insurancePolicy->id]) }}"
                       class="btn btn-secondary">
                      Editer
                    </a>
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
                            <img class="img-fluid rounded-sm mb-4"
                                 style="max-width: 100%;"
                                 src="{{ urlGen(src:route("image.indexUrl",["path"=>$insurancePolicy->miniature->path]),width: 360,height: 360,fit: "contain") }}"
                                  alt="{{$insurancePolicy->name}}" />

                        </div>
                    </div>
                    <div class="info-container px-1">
                        <h5 class="text-capitalize mt-2">
                            {{ $insurancePolicy->name }}
                        </h5>
                        <p>
                            {{ $insurancePolicy->summary }}
                        </p>
                    </div>
                    <div class="my-4 row flex-column gap-2">
                        <a href="{{ route("insurance_policies.show", ["insurancePolicy" => $insurancePolicy->id]) }}"
                            @class(['d-block text-dark text-center fw-semibold border rounded py-3 px-4','btn-label-primary'=>$page!="description"])>
                            Tarification
                        </a>
                        <a href="{{ route("insurance_policies.show", ["insurancePolicy" => $insurancePolicy->id,'page'=>'description']) }}"
                            @class(['d-block text-dark text-center fw-semibold border rounded py-3 px-4','btn-label-primary'=>$page=="description"])>
                            Description complète
                        </a>
                    </div>
                    @if($insurancePolicy->fileAttach->isNotEmpty())
                        <div class="info-container">
                            <h5 class="text-capitalize mt-6">
                                Piéces jointes
                            </h5>
                            <div class="">
                                @foreach($insurancePolicy->fileAttach as $file)
                                    <div class="row py-3 px-1 border-bottom">
                                        <div class="col-auto">
                                            <i class="ti ti-file"></i>
                                        </div>
                                        <div class="col">
                                            <a href="/storage/{{ $file->path }}" target="_blank">{{ $file->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @endif

                </div>
            </div>
            <!-- /Customer-detail Card -->
        </div>
        <!--/ Customer Sidebar -->


        <!-- Customer Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            @if($page!="description")
                <div class="card mb-6">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            Tarifications
                        </h5>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="mh-datatable table"
                               data-location="{{\Illuminate\Support\Facades\URL::current()}}"
                               data-create="{{ route("package.create",["insurancePolicy"=>$insurancePolicy->id]) }}"
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
            @else
                <div class="row text-nowrap">
                    <div class="col-md-12 mb-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-info">
                                    <h5 class="card-title mb-2 border-bottom">
                                        Description
                                    </h5>
                                    <div class="w-100 text-wrap">
                                        {!! $insurancePolicy->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!--/ Customer Content -->
    </div>
@endsection
