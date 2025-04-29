@php use Illuminate\Support\Facades\URL; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Nouveau groupe')

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
    <form class="px-lg-4" action="{{ route("questionGroup.store") }}" method="post">
        @csrf
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route("question.create") }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Nouveau </h4>
                        <p class="mb-0">
                            Enrégistrer un groupe
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                        <button type="submit" class="btn btn-label-primary" name="btn" value="continue">Enrégistrer et
                            continuer
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label" for="page-index">Type de question</label>
                                <select id="page-index"
                                        name="question_type"
                                        class="select2 form-select">
                                    @foreach([\App\Models\Enums\QuestionType::Complementary,\App\Models\Enums\QuestionType::Register] as $item)
                                        <option
                                            @selected($loop->index == 2)
                                            value="{{$item->value}}">{{ ucfirst($item->value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- First column-->
            <div class="col-12">
                <!-- Product Information -->
                <div class="card mb-6">
                    {{--<div class="card-header">
                        <h5 class="card-tile mb-0">kkfd</h5>
                    </div>--}}
                    <div class="card-body">
                        <div class="row mb-4 gap-2">
                            <div class="col-12">
                                <label class="form-label" for="title">Titre</label>
                                <input type="text" required
                                       class="form-control"
                                       id="title"
                                       placeholder=""
                                       name="title"
                                       value="{{old('title')}}"
                                       @class(["form-control","is-invalid"=>$errors->has('title')])
                                       aria-label="title">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label" for="page-index">Page</label>
                                <select id="page-index"
                                        name="page"
                                        class="select2 form-select">
                                    @for($i=1;$i<=4;$i++)
                                        <option
                                            @selected($i == 1)
                                            value="{{$i}}">Page {{ $i  }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
