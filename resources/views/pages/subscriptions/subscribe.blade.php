@extends('layouts/layoutMaster')

@section('title', 'Souscription')

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
            <a href="{{ route("subscription.index") }}" class="btn btn-icon btn-label-primary">
                <i class="ti ti-chevron-left fs-xlarge"></i>
            </a>
        </div>
        <div class="col">
            <div
                class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-between mb-6 text-center text-sm-start gap-2">
                <div class="mb-2 mb-sm-0">
                    <h4 class="mb-1 text-capitalize">
                        {{$subscription->customer->name}}
                    </h4>
                    <p class="mb-0">
                        {{$subscription->customer->email}}
                    </p>
                </div>
                @if($subscription->status=="pending")
                    <div class="d-flex gap-4">
                        <a href="{{ route("subscription.edit",["action"=>"validate","subscription"=>$subscription->id]) }}"
                           class="btn btn-label-success">Valider</a>
                        <a href="{{ route("subscription.edit",["action"=>"reject","subscription"=>$subscription->id]) }}"
                           class="btn btn-label-danger">Annuler</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Customer-detail Sidebar -->
        <div class="col-xl-7 col-lg-6 col-md-5 order-1 order-md-0">
            <!-- Customer-detail Card -->
            <div class="card mb-6">
                <div class="card-header">
                    <h4 style="margin-bottom: 0;">Produit d'assistance {{ $subscription->insurancePolicy->name }}</h4>
                    <span
                        class="text-primary">Tarif {{ $subscription->destination_option == "mono" ? "mono-destination":"multi-destination" }}</span>
                    <div class="mt-2">
                        {!!  status(match ($subscription->status) {
                       "validate" => \Illuminate\Support\Carbon::now()->lte($subscription->date_end) ? "En cours" : "Expirer",
                       "pending" => "En attente",
                       "cancel" => "Annuler",
                       "reject" => "Annuler"
                   }, type: match ($subscription->status) {
                       "validate" => \Illuminate\Support\Carbon::now()->lte($subscription->date_end) ? "success" : "danger",
                       "pending" => "secondary",
                       "cancel" => "warning",
                       "reject" => "danger"
                   })!!}
                    </div>
                </div>
               {{-- Produit d'assistance
                Piéce d'identité
                Dossier de santé--}}

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
                        <strong
                            class="d-block ms-2">
                            {{ $subscription->period["value"].' '.match ($subscription->period["type"]){ "year"=> "an(s)","day"=>"jour(s)" ,default =>"mois"} }}
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Période de couverture</span>
                        <strong class="d-block ms-2 text-primary">
                            @if($subscription->status == "validate")
                                {{ $subscription->date_start->format("d/m/Y") . ' - ' . $subscription->date_end->format("d/m/Y") }}
                            @else
                                Indefinie
                            @endif
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Date d'émission</span>
                        <strong class="d-block ms-2">{{ $subscription->emit_date->format("d/m/Y") }}</strong>
                    </div>

                    <div class="mb-2">
                        <span class="d-block">Zone géographique</span>
                        <strong class="d-block ms-2">{{ $subscription->geographicArea->name }}</strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de residence</span>
                        <strong class="d-block ms-2">
                            <img alt="{{ $subscription->residence_id }}" style="width: 20px;margin-right: 8px;"
                                 width="20" src="https://flagcdn.com/w320/{{ $subscription->residence_id }}.png"/>
                            {{ $subscription->residence->name }}
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de départ</span>
                        <strong class="d-block ms-2">
                            <img alt="{{ $subscription->departure_code }}" style="width: 20px;margin-right: 8px;"
                                 width="20" src="https://flagcdn.com/w320/{{ $subscription->departure_code }}.png"/>
                            {{ $subscription->departure->name }}
                        </strong>
                    </div>
                    <div class="mb-2">
                        <span class="d-block">Pays de destination</span>
                        <strong class="d-block ms-2">
                            <img alt="{{ $subscription->destination_code }}" style="width: 20px;margin-right: 8px;"
                                 width="20" src="https://flagcdn.com/w320/{{ $subscription->destination_code }}.png"/>
                            {{ $subscription->destination->name }}
                        </strong>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
            <!-- /Customer-detail Card -->
        </div>

        <div class="col-xl-5 col-lg-6 col-md-5">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 style="margin-bottom: 0;">
                        Photo d'identité
                    </h5>
                    <div class="p-2  mb-4">
                        <div class="bg-body-tertiary">
                            <img style="width: 124px;height: 132px"
                                 src="{{ urlGen(src: route("image.indexUrl", ["path" => $subscription->customer->avatar?->path]), width: 200, height: 200, fit: "contain")  }}"
                                 alt="">
                        </div>
                    </div>
                    <h5 style="margin-bottom: 0;">
                        Piéce d'identité
                    </h5>
                    <div class="ms-2">
                        <div class="mb-2">
                            <span class="d-block">Type de piéce</span>
                            <strong
                                class="d-block ms-2">
                                {{ match ($subscription->customer->document_type){
                                    "travel_document"=>"Titre de voyage",
                                    "visa"=>"Visa",
                                    "cni"=>"Certificat d'identité",
                                    "passport"=>"Passeport"
                                  } }}
                            </strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Numéro de la piéce d'identité</span>
                            <strong
                                class="d-block ms-2 text-uppercase">{{ $subscription->customer->document_num }}</strong>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="bg-body-tertiary">
                            <img
                                src="{{ urlGen(src: route("image.indexUrl", ["path" => $subscription->customer->documentRecto?->path]), width: 300, height: 300, fit: "contain")  }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="card-body  px-lg-12">
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <div class="card-header">
                    <h4 style="margin-bottom: 0;">
                        Dossier de santé
                    </h4>
                </div>

                <fieldset readonly="" class="card-body  px-lg-12">
                    @foreach(array_merge($subscription->customer->medicalIssues->response,$subscription->customer->healthRecord->response) as $item)
                        <div class="mb-4">
                            <h4 class="mb-2">{{ $item["title"] }}</h4>
                            <div class="ms-4">
                                @foreach($item["questions"] as $_item)
                                    @if($_item["type"]=="option")
                                        <div class="mb-2">
                                                <?php $option = $_item["option"]; ?>
                                            <h6 class="mb-1">{{ $option["label"] }}</h6>
                                            <div class="ms-2">
                                                <div class="d-flex gap-2">
                                                    @foreach($option["response"] as $__item)
                                                        <div>
                                                            <input readonly class="form-check-input"
                                                                   type="radio" @checked($__item["value"] == "1")>
                                                            {{ $__item["label"] }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2 ms-2">
                                                    @foreach($option["response"] as $__item)
                                                        <div>
                                                            @if($__item["value"] == "1")
                                                                @foreach($__item["result"] ?? [] as $___item)
                                                                    @if($__item["type"] == "option")
                                                                        <div>
                                                                            <input readonly class="form-check-input"
                                                                                   type="checkbox" @checked($___item["value"] == "1")>
                                                                            <span @class(["text-primary"=>$___item["value"] == "1"])>{{ $___item["label"] }}</span>
                                                                        </div>
                                                                    @else
                                                                        <span>{{ $___item["label"] }}: </span>
                                                                        <strong
                                                                            class="text-primary">{{ $___item["value"] }}</strong>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    @elseif($_item["type"]=="multiple")
                                        <div class="mb-2">
                                                <?php $multiple = $_item["multiple"]; ?>
                                            <h6 class="mb-1">{{ $multiple["label"] }}</h6>
                                            @foreach($multiple["response"] as $__item)
                                                <div class="py-1">
                                                    <input class="form-check-input" readonly
                                                           type="checkbox" @checked($__item["value"] == "1")>
                                                    {{ $__item["label"] }}
                                                </div>
                                            @endforeach

                                        </div>
                                    @else
                                        <div class="mb-2">
                                                <?php $text = $_item["text"]; ?>
                                            <h6 class="mb-1">{{ $text["label"] }}</h6>
                                            <span>{{ $text["value"] ?? "" }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </fieldset>
                <div class="card-footer"></div>
            </div>

        </div>
    </div>
@endsection
