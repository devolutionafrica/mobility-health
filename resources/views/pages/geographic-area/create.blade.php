@extends('layouts/layoutMaster')

@section('title', 'Nouvelle zone géographique')

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
    <form class="px-lg-4" enctype="multipart/form-data" action="{{ route('geographic_area.store') }}" method="post">
        @csrf
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route('geographic_area.index') }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Nouveau</h4>
                        <p class="mb-0">
                            Enrégistrer une zone géographique
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
            <!-- First column-->
            <div class="col-12">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">
                            Liste des pays de la zone géographique
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-xl-6">
                                <label class="form-label" for="title">Nom de cette zone</label>
                                <input type="text" required
                                       class="form-control"
                                       id="title"
                                       placeholder="Afr.Ouest - Centre"
                                       name="name"
                                       value="{{old('title')}}"
                                       @class(["form-control","is-invalid"=>$errors->has('title')])
                                       aria-label="title">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label" for="countries">Pays</label>
                                    <div class="select2-primary">
                                        <select multiple id="countries" name="countries[]" class="select2 form-select">
                                            @foreach(\App\Models\Country::query()->get() as $item)
                                                <option
                                                    @selected(in_array($item->id,old("countries",[])))
                                                    value="{{$item->id}}">{{ $item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('countries')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Second column -->
        </div>
    </form>

@endsection
