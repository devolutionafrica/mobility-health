@extends('layouts/layoutMaster')

@section('title', 'Edition')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
       'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite([
      'resources/js/table/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-file-upload.js',
    ])
@endsection
@section('content')

    <form class="px-lg-4" enctype="multipart/form-data"
          action="{{ route("subscription.update",["action"=>$action,"subscription"=>$subscription->id]) }}"
          method="post">
        @csrf
        @method("PUT")

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="{{ route("subscription.show",["subscription"=>$subscription->id]) }}" class="btn btn-icon btn-label-primary">
                        <i class="ti ti-chevron-left fs-xlarge"></i>
                    </a>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">
                         {{ $action == "validate" ? "Validation":"Annulation" }} de souscription
                        </h4>
                    </div>
                </div>
            </div>

            <div class="d-flex align-content-center flex-wrap gap-4">
                <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
            </div>

        </div>

        <div class="row">

            <!-- Second column -->
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 style="margin-bottom: 0;">Produit d'assistance {{ $subscription->insurancePolicy->name }}</h5>
                        <span
                            class="text-primary">Tarification {{ $subscription->destination_option == "mono" ? "mono-destination":"multi-destination" }}</span>
                        <div class="mb-2">
                            <span class="d-block">Référence</span>
                            <strong class="d-block ms-2 text-uppercase text-black"># {{ $subscription->id }}</strong>
                        </div>
                        <div class="mb-2 mt-4">
                            <span class="d-block">Durée de la couverture</span>
                            <strong
                                class="d-block ms-2">
                                {{ $subscription->period["value"].' '.match ($subscription->period["type"]){ "year"=> "an(s)","day"=>"jour(s)" ,default =>"mois"} }}
                            </strong>

                        </div>
                        <div class="mb-2">
                            <span class="d-block">Estimation de la période de couverture</span>
                            <strong class="d-block ms-2">{{ $subscription->emit_date->format("d/m/Y") }} -  {{ match ($subscription->period["type"]){ "year"=> $subscription->emit_date->addYears(intval($subscription->period["value"]))->format("d/m/Y"),"day"=>$subscription->emit_date->addDays(intval($subscription->period["value"]))->format("d/m/Y") ,default =>$subscription->emit_date->addMonths(intval($subscription->period["value"]))->format("d/m/Y")} }}</strong>
                        </div>
                        <div class="mb-2">
                            <span class="d-block">Debut de la couverture</span>
                            <strong class="d-block ms-2">{{ $subscription->emit_date->format("d/m/Y") }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @if($action=="validate")
                            <div class="mb-4">
                                <label class="form-label" for="date_start">Changer la date de début de la couverture</label>
                                <input
                                    required type="date"
                                    @class(["form-control","is-invalid"=>$errors->has('date_start')])
                                    id="date_start"
                                    placeholder=""
                                    value="{{old('date_start',$subscription->emit_date->format("Y-m-d"))}}"
                                    name="date_start"
                                    aria-label="date_start">
                                @error('date_start')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @else
                            <div class="mb-4">
                                <label class="form-label" for="status_message">Motif</label>
                                <textarea
                                    rows="4"
                                    required type="date"
                                    @class(["form-control","is-invalid"=>$errors->has('date_start')])
                                    id="status_message"
                                    placeholder=""
                                    name="status_message"
                                    aria-label="status_message">{{old('status_message')}}</textarea>
                                @error('status_message')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
