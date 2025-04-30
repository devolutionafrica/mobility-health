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
    <form method="post" id="delete-form" action="{{ route("user.delete",["user"=>$user->id]) }}">
        @csrf
        @method("DELETE")
    </form>
    <form class="px-lg-4" enctype="multipart/form-data"
          action="{{ route("user.update",["user"=>$user->id,"type"=>$type]) }}"
          method="post">
        @csrf
        @method("PUT")
        <!-- Add Product -->
        @php
            $personality=\Illuminate\Support\Facades\Request::query("personality",$user->personality)
        @endphp
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="{{ route("user.index",["type"=>$type]) }}" class="btn btn-icon btn-label-primary">
                        <i class="ti ti-chevron-left fs-xlarge"></i>
                    </a>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Edition</h4>
                        <p class="mb-0">
                            Mise à jour du profil
                            @if($type == \App\Models\Enums\UserType::HealthPartner)
                                partenaire de santé
                            @elseif($type == \App\Models\Enums\UserType::ReferentDoctor)
                                médecin référent
                            @else
                                administrateur
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex align-content-center flex-wrap gap-4">
                {{--<div class="d-flex gap-4">
                    <button class="btn btn-label-secondary">Discard</button>
                    <button class="btn btn-label-primary">Save draft</button>
                </div>--}}
                <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                <button type="button" data-target="delete-form" class="btn btn-danger delete-item" name="btn"
                        value="once">Supprimer
                </button>
            </div>

        </div>


        <div class="row">

            <!-- First column-->
            <div class="col-12 col-lg-8">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-7 col-xl-4">
                                <div class="border border-2 rounded p-2">
                                    <div class="h-px-150 w-100 pb-2 d-flex justify-content-center">
                                        <img
                                            src="{{ $user->avatar !=null  ? urlGen(src: route("image.indexUrl",["path"=>$user->avatar->path]),fit: "contain") :"/logo/user-circle.png"}}"
                                            class="object-fit-cover rounded overflow-hidden"
                                            style="max-width: 200px;max-height: 100%" id="image-preview" alt="image">
                                    </div>
                                    <div class="border-top px-2">
                                        <div class="row  align-items-center ">
                                            <small @class(["d-inline-block mt-1","text-danger"=>$errors->has('img')])>
                                                L'image doit peser jusqu'à 2 Mo
                                            </small>
                                            @error('img')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                            <div class="col overflow-hidden d-none" style="position: relative;">
                                                <input accept="image/*" id="img-upload" name="img" type="file"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($type===\App\Models\Enums\UserType::HealthPartner)
                            <div class="row mb-4">
                                <div class="col-md mb-md-0 mb-5">
                                    <a href="{{ route("user.create",["type"=>$type->value,"personality"=>"physical"]) }}"
                                       class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="dfdfsr4thzhw">
                                        <span class="custom-option-body">
                                          <i class="ti ti-user"></i>
                                          <span class="custom-option-title">Indépendant</span>
                                          <small>Être humain, individu avec droits et obligations.</small>
                                        </span>
                                            <input name="personality" class="form-check-input" type="radio"
                                                   value="physical" id="physical" @checked($personality=="physical")/>
                                        </label>
                                    </a>
                                </div>
                                <a href="{{ route("user.create",["type"=>$type->value,"personality"=>"legal"]) }}"
                                   class="col-md">
                                    <div
                                        class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="dfdfsdfsvefs">
                                    <span class="custom-option-body">
                                          <i class="ti ti-briefcase"></i>
                                          <span class="custom-option-title"> Enterprise </span>
                                          <small>Entité légale avec droits et obligations propres</small>
                                        </span>
                                            <input name="personality" class="form-check-input" type="radio"
                                                   value="legal" id="legal" @checked($personality!="physical")/>
                                        </label>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if($type!==\App\Models\Enums\UserType::HealthPartner && $personality !="legal")
                            <label for="address" class="form-label">Genre</label>
                            <div class="row mb-4">
                                <div class="col-6 col-lg-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content pb-2" for="male">
                                            <input
                                                @checked($user->gender == "male")
                                                name="gender"
                                                class="form-check-input"
                                                type="radio"
                                                value="male"
                                                id="male"/>
                                            <span class="custom-option-header">Masculin</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content pb-2" for="female">
                                            <input
                                                @checked($user->gender == "female")
                                                name="gender" class="form-check-input" type="radio" value="female"
                                                id="female"/>
                                            <span class="custom-option-header">Féminin</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($type===\App\Models\Enums\UserType::HealthPartner && $personality =="legal")
                            <div class="row mb-4">
                                <div class="col">
                                    <label class="form-label" for="lastname">Nom de l'entreprise</label>
                                    <input
                                        type="text" required
                                        class="form-control"
                                        id="lastname"
                                        placeholder=""
                                        name="lastname"
                                        value="{{old('lastname',$user->lastname)}}"
                                        @class(["form-control","is-invalid"=>$errors->has('lastname')])
                                        aria-label="lastname">
                                    @error('lastname')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <input type="hidden"
                                           value=""
                                           id="firstname"
                                           name="firstname">
                                </div>
                            </div>
                        @else
                            <div class="row mb-4">
                                <div class="col-12 col-lg">
                                    <label class="form-label" for="lastname">Nom</label>
                                    <input
                                        type="text" required
                                        class="form-control"
                                        id="lastname"
                                        placeholder=""
                                        name="lastname"
                                        value="{{old('lastname',$user->lastname)}}"
                                        @class(["form-control","is-invalid"=>$errors->has('lastname')])
                                        aria-label="lastname">
                                    @error('lastname')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg">
                                    <label class="form-label" for="firstname">Prénom</label>
                                    <input type="text"
                                           value="{{old('firstname',$user->firstname)}}"
                                           required
                                           @class(["form-control","is-invalid"=>$errors->has('firstname')])
                                           id="firstname"
                                           placeholder=""
                                           name="firstname"
                                           aria-label="firstname">
                                    @error('firstname')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="mb-4">
                            <div class="row">

                                <div class="col-12 col-md-5">
                                    <label class="form-label" for="phone_number">Numéro de téléphone</label>
                                    <input
                                        type="tel"
                                        required
                                        @class(["form-control","is-invalid"=>$errors->has('phone_number')])
                                        id="phone_number"
                                        placeholder=""
                                        value="{{old('phone_number',$user->phone_number)}}"
                                        name="phone_number"
                                        aria-label="phone_number">
                                    @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                @if($type==\App\Models\Enums\UserType::HealthPartner || $type==\App\Models\Enums\UserType::ReferentDoctor)
                                    <div class="col-12 col-md-7">
                                        <label class="form-label" for="country">
                                            {{ $type==\App\Models\Enums\UserType::HealthPartner && $personality =="legal" ? "Pays":"Nationalité" }}
                                        </label>
                                        <select id="country" name="country_id" class="select2-icons form-select">
                                            @foreach(\App\Models\Country::query()->get() as $item)
                                                <option
                                                    @selected(old("country_id",$user->country_id) ==$item->id)
                                                    data-icon="/flag/flag_{{$item->id}}.png"
                                                    value="{{$item->id}}">{{ $type==\App\Models\Enums\UserType::HealthPartner && $personality =="legal" ? $item->name : $item->nationality}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($type!==\App\Models\Enums\UserType::Admin && $type!==\App\Models\Enums\UserType::Manager)
                            <div class="mb-4">
                                <label for="address" class="form-label">Adresse</label>
                                <textarea class="form-control" name="address" id="address"
                                          rows="3">{{ old("address",$user->address) }}</textarea>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Second column -->

            <!-- Second column -->
            <div class="col-12 col-lg-4">
                <!-- Pricing Card -->
                @if($type===\App\Models\Enums\UserType::Admin || $type===\App\Models\Enums\UserType::Manager)
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Role</h5>
                        </div>
                        <div class="card-body">
                            <!-- Base Price -->
                            <div class="mb-4">
                                <select id="vendor" name="role" class="select2 form-select">
                                    <option
                                        value="admin" @selected(old("role",$user->role) ==\App\Models\Enums\UserType::Admin )>
                                        Administrateur
                                    </option>
                                    <option
                                        value="manager" @selected(old("role",$user->role) ==\App\Models\Enums\UserType::Manager )>
                                        Gestionnaire
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- /Pricing Card -->
                    </div>
                @else
                    <input type="hidden" name="role" value="{{$type->value}}">
                @endif

                @if($type===\App\Models\Enums\UserType::ReferentDoctor || $type===\App\Models\Enums\UserType::HealthPartner)
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Spécialité</h5>
                        </div>
                        <div class="card-body">
                            <!-- Base Price -->

                            <div class="mb-6">
                                <select id="referent_doctor_specialty" name="speciality_id" class="select2 form-select">
                                    @foreach(\App\Models\Speciality::query()->get() as $item)
                                        <option
                                            @selected(old("speciality_id",$user->speciality_id) == $item->id) value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('speciality_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /Pricing Card -->
                    </div>
                @endif
                <!-- /Second column -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">Authentification</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input
                                required type="email"
                                @class(["form-control","is-invalid"=>$errors->has('email')])
                                id="email"
                                placeholder=""
                                value="{{old('email',$user->email)}}"
                                name="email"
                                aria-label="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="row mb-6 gap-2">
                            <div class="col-12">
                                <a href="{{ route("password.edit",["user"=>$user->id]) }}" type="submit"
                                   class="btn btn-label-warning w-100">
                                    Modifier le mot de passe
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($type!==\App\Models\Enums\UserType::Admin && $type!==\App\Models\Enums\UserType::Manager)
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title mb-0">Géolocalisation</h5>
                </div>
                <div class="card-body">
                    <!-- Base Price -->
                    <div class="mb-6">
                        <div class="row">
                            <div class="col">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="latitude"
                                    placeholder="Latitude"
                                    name="location[lat]"
                                    value="{{old('location.lat',$user->location["lat"] ?? "")}}"
                                    @class(["form-control","is-invalid"=>$errors->has('location.lat')])
                                    aria-label="latitude">
                            </div>
                            <div class="col">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="longitude"
                                    placeholder="Longitude"
                                    name="location[lon]"
                                    value="{{old('location.lon',$user->location["lon"] ?? "")}}"
                                    @class(["form-control","is-invalid"=>$errors->has('location.lon')])
                                    aria-label="longitude">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="leaflet-map" id="dragMap"></div>
                        </div>
                    </div>
                </div>
                <!-- /Pricing Card -->
            </div>
        @endif
    </form>
@endsection
