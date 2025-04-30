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
    @php
        $customer=$subscription->customer;
        $tag=\Illuminate\Support\Facades\Request::query("tag","subscribe");
        if(!in_array($tag,["subscribe","health-record","document","bill"])){
          $tag="subscribe";
        }
    @endphp
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

        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-6">
                <div class="card-body pt-12">
                    <div class="customer-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4"
                                 style="width: 124px;height: 124px;"
                                 src="{{ $customer->avatar == null ? "/storage/fake/user.png" : urlGen(src: route("image.indexUrl", ["path" => $customer->avatar?->path]), width: 200, height: 200, fit: "contain")}}"
                                 height="120" width="120" alt="User avatar"/>
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
                                <strong class="text-capitalize">{{$customer->lastname}}</strong>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Prénom:</span>
                                <strong class="text-capitalize">{{$customer->firstname}}</strong>
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
                                    <img width="16" src="https://flagcdn.com/w320/{{ $customer->nationality_id }}.png"
                                         alt="{{ $customer->nationality_id }}">
                                    <span>{{ $customer->country->name }}</span>

                                </span>
                            </li>
                            <li class="mb-2">
                                <span class="h6 me-1">Pays de résidence:</span>
                                <span>
                                     <img width="16"
                                          src="https://flagcdn.com/w320/{{ $customer->country_of_residence_id }}.png"
                                          alt="{{ $customer->country_of_residence_id }}">
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
            <!-- /Plan Card -->
        </div>
        <!--/ User Sidebar -->


        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 order-0 order-md-1">
            <!-- User Pills -->
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
                    <li class="nav-item"><a @class(["nav-link","active"=> $tag == "subscribe"])
                                            href="{{ \Illuminate\Support\Facades\URL::current().'?tag=subscribe' }}"><i
                                class="ti ti-user-check ti-sm me-1_5"></i>Produit d'assistance</a></li>
                    <li class="nav-item"><a @class(["nav-link","active"=> $tag == "health-record"])
                                            href="{{\Illuminate\Support\Facades\URL::current().'?tag=health-record' }}"><i
                                class="ti ti-lock ti-sm me-1_5"></i>Dossier de santé</a></li>
                    <li class="nav-item"><a @class(["nav-link","active"=> $tag == "document"])
                                            href="{{\Illuminate\Support\Facades\URL::current().'?tag=document' }}"><i
                                class="ti ti-bookmark ti-sm me-1_5"></i>Piéce d'identité</a></li>
                    <li class="nav-item"><a @class(["nav-link","active"=> $tag == "bill"])
                                            href="{{\Illuminate\Support\Facades\URL::current().'?tag=bill' }}"><i
                                class="ti ti-library ti-sm me-1_5"></i>Facture</a></li>
                </ul>
            </div>
            <!--/ User Pills -->
            @if($tag=="health-record")
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
            @elseif($tag=="bill")
                <div class="card mb-6">
                    <div class="card-header">
                        <h4 style="margin-bottom: 0;">Facture</h4>
                    </div>

                    <div class="card-body  px-lg-12">
                        <div class="mb-2">
                            <span class="d-block">Produit d'assistance</span>
                            <strong class="d-block ms-2 text-uppercase">{{ $subscription->insurancePolicy->name }}</strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Tarification</span>
                            <strong class="d-block ms-2 text-capitalize">{{ $subscription->destination_option == "mono" ? "mono-destination":"multi-destination" }}</strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Montant</span>
                            <strong class="d-block ms-2">{{ number_format($subscription->price,0,""," ") }}F CFA <span class="text-success">payé</span> </strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Moyen de paiement</span>
                            <span class="d-block ms-2">{{ $subscription->payment_method }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Durée de la couverture</span>
                            <strong
                                class="d-block ms-2">
                                {{ $subscription->period["value"].' '.match ($subscription->period["type"]){ "year"=> "an(s)","day"=>"jour(s)" ,default =>"mois"} }}
                            </strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Date de paiement</span>
                            <strong class="d-block ms-2">{{ $subscription->created_at->format("d/m/Y") }}</strong>
                        </div>
                    </div>
                </div>
            @elseif($tag=="document")
                <div class="card mb-6">
                    <div class="card-header">
                        {{--<h5 style="margin-bottom: 0;">
                            Photo d'identité
                        </h5>
                        <div class="p-2  mb-4">
                            <div class="bg-body-tertiary">
                                <img style="width: 124px;height: 132px"
                                     src="{{ urlGen(src: route("image.indexUrl", ["path" => $subscription->customer->avatar?->path]), width: 200, height: 200, fit: "contain")  }}"
                                     alt="">
                            </div>
                        </div>--}}
                        <h5 style="margin-bottom: 0;">
                            Piéce d'identité
                        </h5>
                    </div>
                    <div class="card-body  px-lg-12">
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
                    <div class="card-footer"></div>
                </div>
            @else
                <div class="card mb-6">
                    <div class="card-header">
                        <h4 style="margin-bottom: 0;">
                            Produit d'assistance {{ $subscription->insurancePolicy->name }}
                        </h4>
                        <span
                            class="text-primary">
                            Tarif {{ $subscription->destination_option == "mono" ? "mono-destination":"multi-destination" }}
                        </span>
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
                        @if($subscription->status != "validate")
                            <div class="alert mt-1 alert-solid-danger d-flex align-items-center" role="alert">
                          <span class="alert-icon rounded">
                            <i class="ti ti-ban"></i>
                          </span>
                                {{ $subscription->status_message }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body  px-lg-12">
                        <div class="mb-2">
                            <span class="d-block">Référence</span>
                            <strong class="d-block ms-2 text-uppercase text-warning"># {{ $subscription->id }}</strong>
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
                    <div class="card-footer">
                        <hr>
                        <h5>Fiche Produit</h5>
                        <p>
                            {!! $subscription->insurancePolicy->description !!}
                        </p>
                    </div>
                </div>
            @endif

        </div>
        <!--/ User Content -->
    </div>


@endsection
