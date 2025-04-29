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
            <a href="{{ \Illuminate\Support\Facades\URL::previous() }}" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1 text-capitalize">
                        {{$subscription->customer->name}}
                    </h4>
                    <p class="mb-0">
                        {{$subscription->customer->email}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-7 col-lg-8 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-6">
                <div class="card-header">
                   <h4 style="margin-bottom: 0;">Produit d'assistance {{ $subscription->insurancePolicy->name }}</h4>
                   <span class="text-primary">Tarification {{ $subscription->destination_option == "mono" ? "mono-destination":"multi-destination" }}</span>
                   <div class="mt-2">
                     {!!  status(match ($subscription->status) {
                    "validate" => Carbon::now()->lte($subscription->date_end) ? "En cours" : "Expirée",
                    "pending" => "En attente",
                    "cancel" => "Annuler",
                    "reject" => "rejeter"
                }, type: match ($subscription->status) {
                    "validate" =>Carbon::now()->lte($subscription->date_end) ? "success" : "danger",
                    "pending" => "secondary",
                    "cancel" => "warning",
                    "reject" => "danger"
                })!!}
                   </div>
                </div>
                <div class="card-body  px-lg-12">
                    <div class="mb-2">
                        <span class="d-block">Référence</span>
                        <strong class="d-block ms-2 text-uppercase text-black"># {{ $subscription->id }}</strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Montant payé</span>
                        <strong class="d-block ms-2">{{ number_format($subscription->price,0,""," ") }}F CFA</strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Durée de la couverture</span>
                        <strong class="d-block ms-2">{{ $subscription->period["value"].' '.$subscription->period["type"] }}</strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Période de couverture</span>
                        <strong class="d-block ms-2 text-success">
                            @if($subscription->status == "validate")
                                {{ $subscription->date_start->format("d/m/Y") . ' - ' . $subscription->date_end->format("d/m/Y") }}
                            @else
                                Indefinie
                            @endif
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Date d'emission</span>
                        <strong class="d-block ms-2">{{ $subscription->emit_date->format("d/m/Y") }}</strong>
                    </div>

                    <div class="mb-2">
                        <span class="d-block">Zone géographique</span>
                        <strong class="d-block ms-2">{{ $subscription->geographicArea->name }}</strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de residence</span>
                        <strong class="d-block ms-2">
                            <img alt="{{ $subscription->residence_id }}" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/{{ $subscription->residence_id }}.png"/>
                            {{ $subscription->residence->name }}
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de départ</span>
                        <strong class="d-block ms-2">
                            <img alt="{{ $subscription->departure_code }}" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/{{ $subscription->departure_code }}.png"/>
                            {{ $subscription->departure->name }}
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de destination</span>
                        <strong class="d-block ms-2">
                            <img alt="{{ $subscription->destination_code }}" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/{{ $subscription->destination_code }}.png"/>
                            {{ $subscription->destination->name }}
                        </strong>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
            <!-- /Customer-detail Card -->
        </div>

    </div>
@endsection
