@php use Illuminate\Support\Facades\URL; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Nouvelle question médicale')

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
    <form class="px-lg-4" action="{{ route("question.store") }}" method="post">
        @csrf
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route("question.index") }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Nouveau</h4>
                        <p class="mb-0">
                            Enrégistrer une question médicale
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
            <div class="col-xl-7">
                <div class="card">
                    @php
                        $_type=\Illuminate\Support\Facades\Request::query("type","text")
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            @foreach(["text","multiple","option"] as $item)
                                <div class="col-4 mb-md-0 mb-5">
                                    <a href="{{ URL::current().'?type='.$item }}"
                                       class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="dfdfsr4thzhw">
                                        <span class="custom-option-body">
                                          <i class="ti ti-file-text"></i>
                                          <span class="custom-option-title text-uppercase">{{$item}}</span>
                                          <small>Champ de saisie</small>
                                        </span>
                                            <input @checked($_type==$item) class="form-check-input" type="radio"
                                                   name="type" value="{{$item}}" id="{{$item}}"/>
                                        </label>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- First column-->
            <div class="col-8">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">Question de type {{ $_type }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-xl-8">
                                <label class="form-label" for="question_name">Question</label>
                                <input type="text" required
                                       class="form-control"
                                       id="question_name"
                                       placeholder=""
                                       name="question[label]"
                                       value="{{old('question[label]')}}"
                                       @class(["form-control","is-invalid"=>$errors->has('question[label]')])
                                       aria-label="question[label]">
                                @error('question[label]')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @if($_type=="multiple")
                            <div class="col-md-12 mb-6">
                                <label for="response_{{$_type}}" class="form-label">Option de reponse</label>
                                <input id="response_{{$_type}}" class="form-control tagifyBasic"
                                       name="question[response]" value=""/>
                            </div>
                        @endif
                        @if($_type=="option")
                            @for($i=0;$i<2;$i++)
                                <div class="border p-4 rounded my-4">
                                    <div class="row mb-4">
                                        <div class="col-xl-4">
                                            <label class="form-label" for="question_name">Question</label>
                                            <input type="text" required
                                                   class="form-control"
                                                   id="question_name"
                                                   placeholder="Oui"
                                                   name="{{ 'question[response]['.$i.'][label]' }}"
                                                   value="{{old('question[response]['.$i.'][label]',$i == 0 ?'Oui':'Non')}}"
                                                @class(["form-control","is-invalid"=>$errors->has('question['.$i.'][label]')])>
                                        </div>
                                    </div>
                                    <div class="row gap-2 align-items-center">
                                        <div class="col-md-2">
                                            <label for="response_{{$_type}}" class="form-label">Option de
                                                reponse</label>
                                            <select name="{{ 'question[response]['.$i.'][type]' }}"
                                                    class=" select2d form-select">
                                                <option value="text">Text</option>
                                                <option value="option">Option</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="response_{{$_type}}" class="form-label">Option de
                                                reponse</label>
                                            <input name="{{ 'question[response]['.$i.'][response]' }}"
                                                   id="response_{{$_type}}" class="form-control tagifyBasic"
                                                   value="Nom,Prénoms"/>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Second column -->
            <div class="col-12 col-lg-4">

                <!-- /Second column -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="card-tile mb-0">
                            <div class="row">
                                <div class="col">
                                    <h5>Groupe de question</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('questionGroup.create') }}"  class="btn btn-label-primary">Nouveau</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach(\App\Models\QuestionGroup::query()->get() as $item)
                                <div class="col-12 pb-1 mb-1 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="form-check">
                                                <label class="form-check-label d-flex align-items-center gap-2" for="{{$item->id}}">
                                                    <input class="form-check-input" type="radio"
                                                           name="question_group_id"
                                                           value="{{$item->id}}"
                                                           @checked($loop->index==0)
                                                           id="{{$item->id}}"/>
                                                    <span class="">
                                                      <span class="fw-semibold d-block">{{$item->title}}</span>
                                                       <span class="d-inline-flex align-items-center gap-2">
                                                           <small class="btn-label-secondary px-2">{{ $item->question_type }}</small>
                                                           <small class="text-primary">Page {{$item->page}}</small>
                                                       </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route("questionGroup.edit",["questionGroup"=>$item->id]) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
