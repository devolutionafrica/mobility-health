@extends('layouts/layoutMaster')

@section('title', 'Edition zone géographique')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/dropzone/dropzone.scss',
      'resources/assets/vendor/libs/quill/typography.scss',
      'resources/assets/vendor/libs/quill/katex.scss',
      'resources/assets/vendor/libs/quill/editor.scss',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/dropzone/dropzone.js',
        'resources/assets/vendor/libs/quill/katex.js',
        'resources/assets/vendor/libs/quill/quill.js',
        'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
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
    <form method="post" id="delete-form" action="{{ route("geographic_area.delete",["geographicArea"=>$geographicArea->id]) }}">
        @csrf
        @method("DELETE")
    </form>
    <form class="px-lg-4" action="{{ route('geographic_area.update',['geographicArea'=>$geographicArea->id]) }}"
          method="post">
        @csrf
        @method('PUT')
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
                        <h4 class="mb-1">Editer</h4>
                        <p class="mb-0">
                            Mise à jour de la zone géographique
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                        <button type="button" data-target="delete-form" class="btn btn-danger delete-item" >Supprimer</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <!-- First column-->
            <div class="col-12 col-lg-7">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-xl-7">
                                <label class="form-label" for="title">Nom de cette zone</label>
                                <input
                                    type="text" required
                                    class="form-control"
                                    id="title"
                                    placeholder="Afr.Ouest - Centre"
                                    name="name"
                                    value="{{old('title',$geographicArea->name)}}"
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
                                    <label class="form-label" for="country_id">
                                        Liste des pays de la zone géographique
                                    </label>
                                    <div class="select2-primary">
                                        <select multiple id="country_id" name="countries[]" class="select2 form-select">
                                            @foreach(\App\Models\Country::query()->get() as $item)
                                                <option
                                                    @selected(in_array($item->id,old("countries",$geographicArea->countries->pluck('id')->toArray())))
                                                    value="{{$item->id}}">{{ $item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country_id')
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
