@php use Illuminate\Support\Facades\URL; @endphp
@extends('layouts/layoutMaster')

@section('title', 'eCommerce Product Add - Apps')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/tagify/tagify.scss',
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/tagify/tagify.js',
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite([
      'resources/assets/js/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-tagify.js',
    ])
@endsection
@section('content')
    <form class="px-lg-4" action="{{ route("password.update",["user"=>$user->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ URL::previous() }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Mise à jour</h4>
                        <p class="mb-0">
                            Modifier le mot de passe
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- First column-->
            <div class="col-12">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-body">
                        <div class="row mb-4 gap-2 gap-lg-0">
                            <div class="col-lg-6">
                                <label class="form-label" for="password">Nouveau mot de passe</label>
                                <input
                                    type="password"
                                    required
                                    id="password"
                                    placeholder=""
                                    name="password"
                                    value="{{old('password')}}"
                                    @class(["form-control","is-invalid"=>$errors->has('password')])
                                    aria-label="new_password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="password_confirmation">Confirmez le mot de passe</label>
                                <input
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    id="password_confirmation"
                                    placeholder=""
                                    name="password_confirmation"
                                    value="{{old('password_confirmation')}}"
                                    @class(["form-control","is-invalid"=>$errors->has('password_confirmation')])
                                    aria-label="password_confirmation">
                                @error('password_confirmation')
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
    </form>

@endsection
