@extends('layouts/layoutMaster')

@section('title', 'Nouvelle tarification')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/dropzone/dropzone.scss',
      'resources/assets/vendor/libs/quill/typography.scss',
      'resources/assets/vendor/libs/quill/katex.scss',
      'resources/assets/vendor/libs/quill/editor.scss'
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/dropzone/dropzone.js',
        'resources/assets/vendor/libs/quill/katex.js',
        'resources/assets/vendor/libs/quill/quill.js'
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite([
      'resources/assets/js/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-file-upload.js',
      'resources/js/table/forms-editors.js',
    ])
@endsection

@section('content')
    <form class="px-lg-4" enctype="multipart/form-data" action="{{ route('package.store') }}" method="post">
        @csrf
        <input type="hidden" name="insurance_policy_id" value="{{ $insurancePolicyId }}">
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route('insurance_policies.show',["insurancePolicy"=>$insurancePolicyId]) }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Nouveau</h4>
                        <p class="mb-0">
                            Enrégistrer une tarification
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                        <button type="submit" class="btn btn-label-primary" name="btn" value="continue">
                            Enrégistrer et continuer
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-12 col-lg-12">
                <!-- /Second column -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="form-check form-check-inline mt-4">
                                <input class="form-check-input" checked type="radio" name="type" id="multi" value="multi" />
                                <label class="form-check-label" for="multi">Multi-destination</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="mono" value="mono" />
                                <label class="form-check-label" for="mono">Mono-destination</label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-xl-4">
                                <label class="form-label" for="geographic_area_id">Zone géographique</label>
                                <select id="geographic_area_id"
                                        name="geographic_area_id"
                                        class="select2 form-select">
                                    @foreach(\App\Models\GeographicArea::query()->get() as $item)
                                        <option
                                            @selected(old("geographic_area_id",'') == $item)
                                            value="{{$item->id}}">{{ __($item->name)  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="price">Montant</label>
                            <input required type="number"
                                   @class(["form-control","is-invalid"=>$errors->has('price')])
                                   id="price"
                                   placeholder="0,00" min="0"
                                   value="{{old('price')}}"
                                   name="price" aria-label="price">
                            @error('price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="row mb-6">
                            <div class="col">
                                <label class="form-label" for="validity_period_type">Unité périodique</label>
                                <select id="validity_period_type"
                                        name="validity_period_type"
                                        class="select2 form-select">
                                    @foreach(["day","month","year"] as $item)
                                        <option
                                            @selected(old("validity_period_type",'month') == $item)
                                            value="{{$item}}">{{ __($item)  }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <label class="form-label" for="validity_period_value">Période</label>
                                <select id="validity_period_value"
                                        data-search="false"
                                        name="validity_period_value"
                                        class="select2 form-select">
                                    @for($i=1;$i<31;$i++)
                                        <option
                                            @selected(old("validity_period_value",'') == $i)
                                            value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <label class="switch switch-primary">
                                <input type="checkbox" name="status" class="switch-input" checked />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                      <i class="ti ti-check"></i>
                                    </span>
                                    <span class="switch-off">
                                      <i class="ti ti-x"></i>
                                    </span>
                                  </span>
                                <span class="switch-label">Statut</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
